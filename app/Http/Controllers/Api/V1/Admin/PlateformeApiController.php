<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\Plateforme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\PlateformeResource;
use App\Http\Requests\StorePlateformeRequest;
use App\Http\Requests\UpdatePlateformeRequest;
use Symfony\Component\HttpFoundation\Response;

class PlateformeApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PaginateRequest $request)
    {
        abort_if(Gate::denies('plateforme_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $isPaginate = $request->isPaginate;
        $paginate = $isPaginate ?? 10;
        $plateform = Plateforme::with(['user','media'])->paginate($paginate);
        return new PlateformeResource($plateform);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlateformeRequest $request)
    {
        abort_if(Gate::denies('plateforme_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $plateform = Plateforme::create($request->validated() + ['user_id' => Auth::user()->id]);

        if (is_array($request->tag)) {
            $plateform->attachTags($request->tag);
        }

        if ($request->hasFile('logo')) {
            $plateform->addMediaFromRequest('logo')->toMediaCollection('plateformes-logos');
        }
        return new PlateformeResource($plateform->load(['media']));
    }

    /**
     * Display the specified resource.
     */
    public function show(Plateforme $plateforme)
    {
        abort_if(Gate::denies('plateforme_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new PlateformeResource($plateforme->load((['user', 'media'])));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlateformeRequest $request, Plateforme $plateforme)
    {
        abort_if(Gate::denies('plateforme_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $plateforme->update($request->validated() + ['user_id' => Auth::user()->id]);

        if (is_array($request->tag)) {
            $plateforme->attachTags($request->tag);
        }

        if ($request->hasFile('logo')) {
           $plateforme->getFirstMedia('plateformes-logos')->delete();
            $plateforme->addMediaFromRequest('logo')->toMediaCollection('plateformes-logos');
        }
        return response()->json(['message' => "Information mises à jour"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plateforme $plateforme)
    {
        abort_if(Gate::denies('plateforme_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($plateforme) {
            $plateforme->delete();
            return response()->json(['message' => "plateforme a ete supprime avec success"]);
        } else {
            return response()->json(['message' => "plateforme n'existe pas"]);
        }
    }

    public function displayList(){
        $plateformes = Plateforme::all();
        return PlateformeResource::collection($plateformes->load(['media']));
    }

}
