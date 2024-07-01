<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\Actualite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\ActualiteResource;
use App\Http\Requests\StoreActualiteRequest;
use App\Http\Requests\UpdateActualiteRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class ActualitesApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PaginateRequest $request)
    {
        abort_if(Gate::denies('actualite_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $isPaginate = $request->isPaginate;
        $paginate = $isPaginate ?? 20;
        $actualite = Actualite::with(['category', 'user', 'media','tags'])->paginate($paginate);
        return new ActualiteResource($actualite);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreActualiteRequest $request)
    {
        abort_if(Gate::denies('actualite_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $actualite = Actualite::create($request->validated() + ['user_id' => Auth::user()->id, 'slug' => Str::slug($request->title)]);

        if (is_array($request->tag)) {
            $actualite->attachTags($request->tag);
        }

        if ($request->hasFile('image')) {
            $actualite->addMediaFromRequest('image')->toMediaCollection('actualites-images');
        }
        return new ActualiteResource($actualite->load(['category', 'user', 'media','tags']));
    }

    /**
     * Display the specified resource.
     */
    public function show(Actualite $actualite)
    {
        abort_if(Gate::denies('actualite_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new ActualiteResource($actualite->load((['category', 'user', 'media','tags'])));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateActualiteRequest $request, Actualite $actualite)
    {

        abort_if(Gate::denies('actualite_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $actualite->update($request->validated() + ['user_id' => Auth::user()->id, 'slug' => Str::slug($request->title)]);

        if (is_array($request->tag)) {
            $actualite->attachTags($request->tag);
        }

        if ($request->hasFile('image')) {
            $media = $actualite->getFirstMedia('actualites-images');
            if ($media) {
                $media->delete();
            }
            $actualite->addMediaFromRequest('image')->toMediaCollection('actualites-images');
        }
        return response()->json(['message' => "Information mises à jour"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Actualite $actualite)
    {
        abort_if(Gate::denies('actualite_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($actualite) {
            $actualite->delete();
            return response()->json(['message' => "L'actualite a ete supprime avec success"]);
        } else {
            return response()->json(['message' => "L'actualite n'existe pas"]);
        }
    }



    /**
     * Liste de toutes les actualité.
     */
    public function findListes()
    {
        $actualite = Actualite::all();
        return new ActualiteResource($actualite->load(['category', 'media','tags']));
    }

    /**
     * Liste de trois actualité sur la home.
     */
    public function findThreeLatest()
    {
        $actualite = Actualite::getThreeLatest();
        return new ActualiteResource($actualite->load(['media','tags']));
    }

    /**
     * Liste de deux actualité sur le slide home.
     */
    public function findTwoLatest()
    {
        $actualite = Actualite::getTwoLatest();
        return new ActualiteResource($actualite->load(['media','tags']));
    }

    /**
     * display an actuality details.
     */
    public function actualiteDetail(Actualite $actualite)
    {
        return new ActualiteResource($actualite->load(['category','media','tags']));
    }
}
