<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSecteurRequest;
use App\Http\Requests\UpdateSecteurRequest;
use App\Http\Resources\SecteurResource;
use App\Models\Secteur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class SecteursApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('secteur_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $secteurs = Secteur::with(['media','user','category'])->paginate(10);
        return new SecteurResource($secteurs);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSecteurRequest $request)
    {
        abort_if(Gate::denies('secteur_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $secteur = Secteur::create($request->validated() + ['user_id' => Auth::user()->id]);
        if ($request->hasFile('image')) {
            $secteur->addMediaFromRequest('image')->toMediaCollection('secteur-image');
        }
        return new SecteurResource($secteur->load(['media','user']));
    }

    /**
     * Display the specified resource.
     */
    public function show(Secteur $secteur)
    {
        abort_if(Gate::denies('secteur_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new SecteurResource($secteur->load(['media','user']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSecteurRequest $request, Secteur $secteur)
    {
        abort_if(Gate::denies('secteur_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $secteur->update($request->validated() + ['user_id' => Auth::user()->id]);
        if ($request->hasFile('image')) {
            $secteur->addMediaFromRequest('image')->toMediaCollection('secteur-image');
        }
        return response()->json(['message' => "Information mises à jour"]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Secteur $secteur)
    {
        abort_if(Gate::denies('secteur_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($secteur) {
            $secteur->delete();
            return response()->json(['message' => "Ressource supprimé avec succes"]);
        } else {
            return response()->json(['message' => "Ce secteur n'existe pas"]);
        }
    }


}
