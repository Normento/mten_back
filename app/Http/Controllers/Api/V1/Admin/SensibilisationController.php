<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateRequest;
use App\Http\Requests\StoreSensibilisationRequest;
use App\Http\Requests\UpdateSensibilisationRequest;
use App\Models\Sensibilisation;
use App\Http\Resources\SensibilisationResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class SensibilisationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PaginateRequest $request)
    {
        abort_if(Gate::denies('sensibilisation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $isPaginate = $request->isPaginate;
        $paginate = $isPaginate ?? 20;
        $sensibilisations = Sensibilisation::with(['media','user'])->paginate($paginate);
        return new SensibilisationResource($sensibilisations);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSensibilisationRequest $request)
    {
        abort_if(Gate::denies('sensibilisation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $sensibilisation = Sensibilisation::create($request->validated() + ['user_id' => Auth::user()->id, 'slug' => Str::slug($request->title)]);
        if ($request->hasFile('image')) {
            $sensibilisation->addMediaFromRequest('image')->toMediaCollection('sensibilisations-images');
        }
        return new SensibilisationResource($sensibilisation->load(['media','user']));
    }

    /**
     * Display the specified resource.
     */
    public function show(Sensibilisation $sensibilisation)
    {
        abort_if(Gate::denies('sensibilisation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new SensibilisationResource($sensibilisation->load(['media','user']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSensibilisationRequest $request, Sensibilisation $sensibilisation)
    {
        abort_if(Gate::denies('sensibilisation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $sensibilisation->update($request->validated() + ['user_id' => Auth::user()->id, 'slug' => Str::slug($request->title)]);
        if ($request->hasFile('image')) {
            $media = $sensibilisation->getFirstMedia('sensibilisations-images');
            if ($media) {
                $media->delete();
            }

            $sensibilisation->addMediaFromRequest('image')->toMediaCollection('sensibilisations-images');
        }
        return response()->json(['message' => "Information mises à jour"]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sensibilisation $sensibilisation)
    {
        abort_if(Gate::denies('sensibilisation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($sensibilisation) {
            $sensibilisation->delete();
            return response()->json(['message' => "Ressource supprimé avec succes"]);
        } else {
            return response()->json(['message' => "Cette sensibilisation n'existe pas"]);
        }
    }


    /**
     * Listes sensibilisation.
     */
    public function displayListesSensibilisation()
    {
        $sensibilisations = Sensibilisation::with(['media'])->get();
        return new SensibilisationResource($sensibilisations);
    }

    /**
     * Details sensibilisation.
     */
    public function displaySensibilisationDetail(Sensibilisation $sensibilisation)
    {
        return new SensibilisationResource($sensibilisation->load(['media']));
    }
}
