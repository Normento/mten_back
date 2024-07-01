<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AppConfiguration;
use App\Models\ResetCodePassword;
use App\Notifications\MailObject;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Password;
use App\Notifications\NotificationService;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\StoreCodeCheckRequest;
use App\Http\Requests\StorePasswordResetRequest;
use App\Http\Requests\UpdatePasswordUserRequest;
use App\Http\Requests\StoreForgotPasswordRequest;

class PasswordApiController extends Controller
{
    /**
     * envoyer l'e-mail de réinitialisation de mot de passe.
     */
    // public function sendResetLinkEmail(PasswordRequest $request)
    // {
    //     $status = Password::sendResetLink(
    //         $request->only('email')
    //     );

    //     return $status === Password::RESET_LINK_SENT
    //         ? response()->json(['message' => 'Reset link sent to your email'], 200)
    //         : response()->json(['error' => 'Unable to send reset link'], 400);
    // }


    /**
     * réinitialiser le mot de passe.
     */
    // public function reset(PasswordResetRequest $request)
    // {

    //     $status = Password::reset(
    //         $request->only('email', 'password', 'password_confirmation', 'token'),
    //         function ($user, $password) {
    //             $user->forceFill([
    //                 'password' => bcrypt($password)
    //             ])->save();
    //         }
    //     );

    //     return $status === Password::PASSWORD_RESET
    //         ? response()->json(['message' => 'Password has been reset'], 200)
    //         : response()->json(['error' => 'Unable to reset password'], 400);
    // }


    public function forgotpassword(StoreForgotPasswordRequest $request)
    {

        $config = AppConfiguration::where(['code' => 'changement.mot.passe'])->first();
        if (!$config->value) {
            return $this->handleError("Non Autorisé. Attention!", ['error' => "Vous n'êtes pas autorisé à changer de mot de passe"], 401);;
        }
        $user = User::where('email', $request->email)->first();

        $data =  $request->all();

        // Supprimer tout le code précédent que l'utilisateur a envoyé
        ResetCodePassword::where('email', $request->email)->delete();

        // Generate random code
        $data['code'] = mt_rand(100000, 999999);

        // creer un nouveau code
        $codeData = ResetCodePassword::create($data);
        $userMail[] = $user->email;
        // envoyer le code à l'utilisateur par mail
        (new NotificationService)->toEmails($userMail)->sendMail(new MailObject(
            subject: 'Code de réinitialisation de votre mot de passe',
            title: 'Code rénitialisation',
            // intro: 'Voici votre code de réinitialisation',
            corpus: $codeData->code,
            outro: "Merci de nous aidez à sécuser votre compte",
            template: 'emails.resetpasswordcode',
            data: [
                "code" => $codeData->code,
                'nom' => $user->nom
            ],

        ));
        return response(['message' => trans('passwords.sent')], 200);
    }

    public function checkcode(StoreCodeCheckRequest $request)
    {

        //  rechercher le code
        $passwordReset = ResetCodePassword::firstWhere('code', $request->code);

        // verifier si le code n'est pas expirer: 10min
        if ($passwordReset->created_at > now()->addMinutes(10)) {
            $passwordReset->delete();
            return response(['message' => trans('passwords.code_is_expire')], 422);
        }

        return response([
            'code' => $passwordReset->code,
            'message' => trans('passwords.code_is_valid')
        ], 200);
    }

    public function changepassword(StorePasswordResetRequest $request)
    {
        // rechercher le code
        $passwordReset = ResetCodePassword::firstWhere('code', $request->code);
        if (isset($passwordReset)) {
            // verifier si le code n'est pas expirer: 10min
            if ($passwordReset->created_at > now()->addMinutes(10)) {

                $passwordReset->delete();
                return response(['message' => trans('passwords.code_is_expire')], 422);
            }

            // rechercher l'email de l'utilisateur
            $user = User::firstWhere('email', $passwordReset->email);


            $convertToArray =   $user->toArray();
            // supprimer l'actuelle code de confirmation
            $passwordReset->delete();

            // changer le user password
            $password = Hash::make($request->password);
            $user->update(['password' => $password]);
            $restorData = $user->fill($convertToArray);


            $emailAdmin = $restorData->email;
            $admins = User::whereHas('roles', function ($query) use ($emailAdmin) {
                $query->where('role_id', 1)->where('email', '!=', $emailAdmin);
            })->get()->pluck('email')->toArray();
            (new NotificationService)->toEmails($admins)->sendMail(new MailObject(
                subject: 'Alerte de réinitialisation de mot de pass',
                title: 'Mot de passe modifier',
                intro: 'Bonjour',
                corpus: "L'utilisateur" . ' ' . $restorData->nom . ' ' . $restorData->prenom . ' ' . " à réinitalisé sont mot de passe",
                outro: 'Merci',
                template: 'emails.default',
                /* data: [
                "user" => $restorData
              ], */

            ));

            return response(['message' => 'password has been successfully reset'], 200);
        } else {
            return response(['message' => trans('passwords.code_is_invalid')], 500);
        }
    }

    /**
     * Update user password.
     */
    public function updateUserpassword(UpdatePasswordUserRequest $request){
        $user = Auth::user();

        if (Hash::check($request->oldpassword, $user->password)) {
            $user->update([
                "password" => hash::make($request->password)
            ]);

            return response(['message' => "Information mis à jour"], 200);

        }else{
            return response(['message' => 'Le mot de passe ne correspond pas']);
        }
    }
}
