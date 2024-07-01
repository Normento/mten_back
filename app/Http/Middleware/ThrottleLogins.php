<?php

namespace App\Http\Middleware;

use App\Models\AppConfiguration;
use App\Models\User;
use App\Notifications\MailObject;
use App\Notifications\NotificationService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Cache\RateLimiter;

class ThrottleLogins
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */


    protected $limiter;
    public function __construct(RateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }
    public function handle(Request $request, Closure $next): Response
    {
        //return $next($request);

        $config = AppConfiguration::where(['code' => 'tentative.connexion'])->first();
        $key = $this->resolveRequestSignature($request);
        if ($this->limiter->tooManyAttempts($key, $config->value)) {
        $emailUser = $request->email;
            $admins = User::whereHas('roles', function ($query) use ($emailUser) {
                $query->where('role_id', 1)->where('email', '!=', $emailUser);
            })->get()->pluck('email')->toArray();

            (new NotificationService)->toEmails($admins)->sendMail(new MailObject(
                subject: 'Alerte de tentative de connexion',
                title: 'Tentative de connexion',
                intro: 'Bonjour',
                corpus: "L'utilisateur " . ' ' . $emailUser . ' ' . " a tenté de se connecter trois fois.",
                outro: 'Merci',
                template: 'email.default',
                /* data: [
                  "user" => $restorData
                ], */

            ));
            return $this->buildResponse($key);
        }

        $response = $next($request);

        if (!$response->isSuccessful()) {
            $this->limiter->hit($key);
        }

        return $response;
    }

    protected function resolveRequestSignature($request)
    {
        return sha1($request->method() . $request->ip());
    }

    protected function buildResponse($key)
    {

        $config = AppConfiguration::where('code', 'delais.verroullage.compte')->first();

        if ($config) {
            //  le délai de verrouillage à partir de la configuration
            $lockoutDuration = intval($config->value);

            // Calculez le temps d'attente en minutes
            $retryAfterMinutes = $lockoutDuration;

            // Construisez le message de réponse JSON
            $message = 'Trop de tentatives de connexion. Veuillez réessayer après ';

            if ($retryAfterMinutes > 1) {
                $message .= $retryAfterMinutes . ' minutes';
            } elseif ($retryAfterMinutes == 1) {
                $message .= '1 minute';
            } else {
                $message .= 'less than a minute';
            }

            return response()->json([
                'message' => $message,
                'retry_after' => $retryAfterMinutes,
            ], Response::HTTP_TOO_MANY_REQUESTS);
        } else {
            return response()->json([
                'error' => 'Configuration not found for lockout duration',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
