<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\Adresse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\AdresseResource;
use App\Http\Requests\StoreAdresseRequest;
use App\Http\Requests\UpdateAdresseRequest;
use Symfony\Component\HttpFoundation\Response;

class AdresseApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PaginateRequest $request)
    {
        abort_if(Gate::denies('adresse_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $isPaginate = $request->isPaginate;
        $paginate = $isPaginate ?? 10;
        $adresse = Adresse::with('user')->paginate($paginate);
        return new AdresseResource($adresse);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdresseRequest $request)
    {
        abort_if(Gate::denies('adresse_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $adresse = Adresse::create($request->validated() + ['user_id' => Auth::user()->id]);
        return new AdresseResource($adresse);
    }

    /**
     * Display the specified resource.
     */
    public function show(Adresse $adresse)
    {
        abort_if(Gate::denies('adresse_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new AdresseResource($adresse->load('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdresseRequest $request, Adresse $adresse)
    {
        abort_if(Gate::denies('adresse_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $adresse->update($request->validated() + ['user_id' => Auth::user()->id]);
        return response()->json(['message' => "Information mises à jour"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Adresse $adresse)
    {
        abort_if(Gate::denies('adresse_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($adresse) {
            $adresse->delete();
            return response()->json(['message' => "Adresse supprime avec success"]);
        } else {
            return response()->json(['message' => "Adresse n'existe pas"]);
        }
    }

    /**
     * Liste des adresse.
     */
    public function findlatest()
    {
        $adresse = Adresse::getLatestAdresse();
        return response()->json(['data' => $adresse]);
    }
}
