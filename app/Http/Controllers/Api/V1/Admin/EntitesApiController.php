<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateRequest;
use App\Http\Requests\StoreEntiteRequest;
use App\Http\Requests\UpdateEntiteRequest;
use App\Http\Resources\EntiteResource;
use App\Models\Entite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class EntitesApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PaginateRequest $request)
    {
        abort_if(Gate::denies('entite_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $isPaginate = $request->isPaginate;
        $paginate = $isPaginate ?? 20;
        $entites = Entite::with(['media','user'])->paginate($paginate);
        return new EntiteResource($entites);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEntiteRequest $request)
    {
        abort_if(Gate::denies('entite_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $entite = Entite::create($request->validated() + ['user_id' => Auth::user()->id, 'slug' => Str::slug($request->name)]);
        if ($request->hasFile('image')) {
            $entite->addMediaFromRequest('image')->toMediaCollection('entites-images');
        }
        return new EntiteResource($entite->load(['media','user']));
    }

    /**
     * Display the specified resource.
     */
    public function show(Entite $entite)
    {
        abort_if(Gate::denies('entite_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new EntiteResource($entite->load(['media','user']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEntiteRequest $request, Entite $entite)
    {
        abort_if(Gate::denies('entite_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $entite->update($request->validated() + ['user_id' => Auth::user()->id, 'slug' => Str::slug($request->name)]);
        if ($request->hasFile('image')) {
            $media = $entite->getFirstMedia('entites-images');
            if ($media) {
                $media->delete();
            }
            $entite->addMediaFromRequest('image')->toMediaCollection('entites-images');
        }
        return response()->json(['message' => "Information mises à jour"]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entite $entite)
    {
        abort_if(Gate::denies('entite_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($entite) {
            $entite->delete();
            return response()->json(['message' => "Ressource supprimé avec succes"]);
        } else {
            return response()->json(['message' => "Cette entité n'existe pas"]);
        }
    }

    /**
     * Liste des entites sous tutelles.
     */
    public function displayListeEntites(){
        $entites = Entite::displayListeEntites();
        return new EntiteResource($entites->load('media'));
    }

    /**
     * Details entites sous tutelles.
     */
    public function displayEntiteDetails(Entite $entite){
        return new EntiteResource($entite->load('media'));
    }

}
