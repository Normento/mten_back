<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Notifications\MailObject;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\ContactResource;
use App\Http\Requests\StoreContactRequest;
use App\Notifications\NotificationService;
use App\Http\Requests\UpdateContactRequest;
use Symfony\Component\HttpFoundation\Response;

class ContactApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PaginateRequest $request)
    {
        abort_if(Gate::denies('contact_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $isPaginate = $request->isPaginate;
        $paginate = $isPaginate ?? 20;
        $contact = Contact::paginate($paginate);
        return new ContactResource($contact);
    }

    /**
     * formulaire de contact.
     */
    public function store(StoreContactRequest $request)
    {
        $contact = Contact::create($request->validated());

        $admins = User::whereHas('roles', function ($query) {
            $query->where('role_id', 1);
        })->get()->pluck('email')->toArray();

        (new NotificationService)->toEmails($admins)->sendMail(
            new MailObject(
                subject: 'Nouveau message',
                title: 'Nouveau message',
                intro: 'Bonjour',
                corpus: "Vous avez un nouveau message de . ' ' . $request->firtsname . ' ' . $request->firtsname . ' ' .",
                outro: 'Merci',
                template: 'email.default',
                /* data: [
                "user" => $restorData
              ], */

            )
        );

        return new ContactResource($contact);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        abort_if(Gate::denies('contact_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new ContactResource($contact);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        abort_if(Gate::denies('contact_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $contact->update($request->validated() + ['user_id' => Auth::user()->id]);
        return response()->json(['message' => "Information mises à jour"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        abort_if(Gate::denies('contact_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($contact) {
            $contact->delete();
            return response()->json(['message' => "Contact supprime avec success"]);
        } else {
            return response()->json(['message' => "Contact n'existe pas"]);
        }
    }
}
