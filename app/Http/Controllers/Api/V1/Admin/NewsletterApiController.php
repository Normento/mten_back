<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\Newsletter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateRequest;
use App\Http\Requests\StoreNewsletterRequest;
use App\Http\Resources\NewsletterResource;

class NewsletterApiController extends Controller
{
    /**
     * Abonnement a la newsletter.
     */
    public function store(StoreNewsletterRequest $request)
    {
        $token = Str::random(60);

        Newsletter::create($request->validated() + ['token'=> $token]);

        return response()->json(['message' => 'Votre adresse e-mail a été enregistrée avec succès.'], 200);
    }

    /**
     * Désabonnement a la newsletter.
     */
    public function unsubscribe(Request $request, $token)
    {

        $newsletter = Newsletter::where('token', $token)->first();

        if (!$newsletter) {
            return response()->json(['message' => 'Jeton non valide.'], 404);
        }

        $newsletter->update(['status' => false]);

        return response()->json(['message' => 'Vous avez été désabonné de la newsletter avec succès.'], 200);

    }

    /**
     * Listes des abonnements newsletter.
     */
    public function index(PaginateRequest $request){

        $isPaginate = $request->isPaginate;
        $paginate = $isPaginate ?? 20;

        $newsletter = Newsletter::paginate($paginate);

        return NewsletterResource::collection($newsletter);
    }
}
