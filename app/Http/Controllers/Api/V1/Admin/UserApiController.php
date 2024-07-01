<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\MailObject;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Notifications\NotificationService;
use Symfony\Component\HttpFoundation\Response;

class UserApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PaginateRequest $request)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $isPaginate = $request->isPaginate;
        $paginate = $isPaginate ?? 20;

        $users = User::where('id', '!=', Auth::user()->id)->with('media', 'roles')->paginate($paginate);

        return new UserResource($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $password = $this->generatePassword();
        $user = User::create($request->validated() + ['password' => bcrypt($password)]);
        $user->roles()->sync($request->input('roles'));
        if ($request->hasFile("image")) {
            $user->addMediaFromRequest('image')->toMediaCollection('users_images');
            /*  $user->addMedia($request->file('image'))
                ->toMediaCollection('image'); */
        }

        $userMail[] = $user->email;
        (new NotificationService)->toEmails($userMail)->sendMail(
            new MailObject(
                subject: 'Création de compte',
                title: 'Création de compte',
                // intro: 'Création de compte',
                corpus: $user->firstname,
                // outro: " Mten",
                template: 'emails.admin',
                data: [
                    "nom" => $user->firstname . ' ' . $user->lastname,
                    "email" => $user->email,
                    "password" => $password,
                ]


            )
        );
        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

         return new UserResource($user->load('roles', 'media'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->update($request->validated());

        if ($request->password) {
            $password = $request->password;
            $user->password = bcrypt($password);
            $user->save();
        }
        if ($request->input('roles')) {
            $user->roles()->sync($request->input('roles'));
        }

        if($request->input('password')){
            $user->update(['password' => bcrypt($request->input('password'))]);

        }

        if ($request->hasFile("image")) {
            $media = $user->getFirstMedia('users-images');
            if ($media) {
                $media->delete();
            }
            $user->addMediaFromRequest('image')->toMediaCollection('users_images');
            /*  $user->addMedia($request->file('image'))
                ->toMediaCollection('image'); */
        }

        return response()->json(['message' => "Information mises à jour"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($user) {
            $user->delete();
        } else {
            return response()->json(['message' => "Ce user n'existe pas"]);
        }
    }

    public function generatePassword()
    {
        $length = 8;
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'; // Caractères autorisés
        $password = '';

        // Boucle pour générer le mot de passe
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, strlen($characters) - 1)]; // Ajoute un caractère aléatoire à chaque itération
        }

        return $password;
    }

    /**
     * Bloquer et débloquer le compte d'un utilisateur.
     */
    public function toggleblockAccount(Request $request, User $user): JsonResponse
    {

        $user->can_login = !$user->can_login;

        $message = $user->can_login ? 'Le compte utilisateur a été débloqué avec succès.' : 'Le compte utilisateur a été bloqué avec succès';

        $user->save();

        return response()->json(['message' => $message], 200);
    }
}
