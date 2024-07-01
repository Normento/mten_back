<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreCodeCheckRequest;
use App\Http\Requests\VerificationCodeRequest;
use App\Http\Requests\VerifyTwoFactorCodeRequest;

class TwoFactorAuthApiController extends Controller
{

    /**
     * Enable or disable tow factor authentification.
     */
    public function toggleTwoFactor(Request $request): JsonResponse
    {
        //dd(auth()->user());

        if (Auth::check()) {
            $user = auth()->user();
            
            $user->two_factor_enabled = !$user->two_factor_enabled;

            $message = $user->two_factor_enabled ? 'Two-factor authentication activated' : 'Two-factor authentication deactivated';

            $user->save();

            return response()->json(['message' => $message], 200);
        }

        return response()->json(['message' => 'User not authenticated'], 401);


    }

    /**
     * Verify two factor code.
     */
    public function checkcode(VerifyTwoFactorCodeRequest $request)
    {
        try {
            $user = User::where('two_factor_code', $request->code)->first();
            
            if ($user) {
                //dd($user->two_factor_code);
                if ($user->two_factor_code == $request->code) {
                    if ($user->two_factor_expires_at > now()) {
                        //dd('code ok');
                        $user->two_factor_code = null;
                        $user->save();

                        return response()->json([
                            'status' => true,
                            'message' => 'User Logged In Successfully',
                            'user' => $user->load('roles', 'media'),
                            'token' => $user->createToken("API TOKEN")->plainTextToken
                        ], 200);
                    } else {
                        return response()->json(['message' => 'Le code à deux facteurs est expiré'], 422);
                    }
                }
            }

            return response()->json(['message' => 'Code à deux facteurs invalide'], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }


}
