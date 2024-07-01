<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\MailObject;
use App\Notifications\NotificationService;
use Symfony\Component\HttpFoundation\Response; // Ajout pour utiliser la classe Response

class AuthApiController extends Controller
{
    public function login(LoginRequest $request)
    {
        try {

            if (!Auth::attempt($request->only(['email', 'password']))) { // Correction: ajout de la parenthèse manquante
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }


            $user = User::where('email', $request->email)->first();

            // Si l'utilisateur est bloqué
            if ($user->can_login !== 1) {
                return response()->json(['message' => 'Votre compte est bloqué. Veuillez contacter l\'administrateur.'], 403);
            }

            if ($user->two_factor_enabled) {

                $verificationCode = mt_rand(100000, 999999);
                $user->two_factor_code = $verificationCode;
                $user->two_factor_expires_at = now()->addMinutes(10);
                $user->save();
                $userMail[] = $user->email;
                // envoyer le code à l'utilisateur par mail

                (new NotificationService)->toEmails($userMail)->sendMail(
                    new MailObject(
                        subject: 'Code d"authentification de votre compte',
                        title: 'Code d"authentification de votre compte',
                        // intro: 'Voici votre code de réinitialisation',
                        corpus: $verificationCode,
                        outro: "Merci de nous aidez à sécuriser votre compte",
                        template: 'emails.twofactorcode',
                        data: [
                            "code" => $verificationCode,
                            'nom' => $user->nom
                        ],

                    )
                );

                return response()->json(['message' => 'Code de vérification envoyé dans votre e-mail.', 'otp' => true], 200);
            }

            $user->update(['last_login' => now()]);
            return response()->json([
                'otp' => false,
                'status' => true,
                'message' => 'User Logged In Successfully',
                'user' => $user->load('roles', 'roles.permissions', 'media'),
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }
}
