<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\Acteur;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CategoryActeur;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\ActeurResource;
use App\Http\Requests\StoreActeurRequest;
use App\Http\Requests\UpdateActeurRequest;
use Symfony\Component\HttpFoundation\Response;

class ActeursApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PaginateRequest $request)
    {
        abort_if(Gate::denies('acteur_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $isPaginate = $request->isPaginate;
        $paginate = $isPaginate ?? 20;
        $acteur = Acteur::with(['user', 'media'])->paginate($paginate);
        return ActeurResource::collection($acteur); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreActeurRequest $request) 
    {

        abort_if(Gate::denies('acteur_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $acteur = Acteur::create($request->validated() + ['user_id' => Auth::user()->id, 'slug' => Str::slug($request->name)]);
        if ($request->hasFile('image')) {
            $acteur->addMediaFromRequest('image')->toMediaCollection('acteurs-images');
        }
        return new ActeurResource($acteur->load(['user', 'media']));
    }

    /**
     * Display the specified resource.
     */
    public function show(Acteur $acteur)
    {
        abort_if(Gate::denies('acteur_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new ActeurResource($acteur->load(['user', 'media']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateActeurRequest $request, Acteur $acteur)
    {
        abort_if(Gate::denies('acteur_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $acteur->update($request->validated() + ['user_id' => Auth::user()->id, 'slug' => Str::slug($request->name)]);

        if ($request->hasFile('image')) {
            $media = $acteur->getFirstMedia('acteurs-images');
            if ($media) {
                $media->delete();
            }
            $acteur->addMediaFromRequest('image')->toMediaCollection('acteurs-images');
        }

        return response()->json(['message' => "Information mises à jour"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Acteur $acteur)
    {
        abort_if(Gate::denies('acteur_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($acteur) {
            $acteur->delete();
            return response()->json(['message' => "L'acteur a ete supprime avec success"]);
        } else {
            return response()->json(['message' => "L'acteur n'existe pas"]);
        }
    }


    /**
     *  Actor  list.
     */
    public function findlatest()
    {
        $acteur = Acteur::all();
        return ActeurResource::collection($acteur->load(['media']));
    }

    /**
     *  Display acteur detail
     */
    public function acteurDetail( Acteur $acteur)
    {
        return new ActeurResource($acteur->load(['media']));
    }
}
