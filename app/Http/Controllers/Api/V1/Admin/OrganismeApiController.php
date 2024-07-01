<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\Organisme;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateRequest;
use App\Http\Requests\StoreOrganismeRequest;
use App\Http\Requests\UpdateOrganismeRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\OrganismeResource;
use Symfony\Component\HttpFoundation\Response;

class OrganismeApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PaginateRequest $request)
    {
        abort_if(Gate::denies('organisme_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $isPaginate = $request->isPaginate;
        $paginate = $isPaginate ?? 20;
        $organisme = Organisme::with(['media','user','tags'])->paginate($paginate);
        return new OrganismeResource($organisme);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrganismeRequest $request)
    {
        abort_if(Gate::denies('organisme_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $organisme = Organisme::create($request->validated() + ["user_id" => Auth::user()->id, 'slug' => Str::slug($request->title)]) ;

        if (is_array($request->tag)) {
            $organisme->attachTags($request->tag);
        }

        if ($request->hasFile('file')) {
            $fileSize = $request->file('file')->getSize();
            if ($fileSize < 1024 * 1024) {
                // Taille en KB avec deux décimales
                $size = number_format($fileSize / 1024, 2) . ' KB';
            } else {
                // Taille en MB avec deux décimales
                $size = number_format($fileSize / 1024 / 1024, 2) . ' MB';
            }
            $organisme->size = $size;
            $organisme->save();
            $organisme->addMediaFromRequest('file')->toMediaCollection('organismes-files');
        }
        if ($request->hasFile('image')) {
            $organisme->addMediaFromRequest('image')->toMediaCollection('organismes-images');
        }
        return new OrganismeResource($organisme->load(['media','user','tags']));
    }

    /**
     * Display the specified resource.
     */
    public function show(Organisme $organisme)
    {
        abort_if(Gate::denies('organisme_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new OrganismeResource($organisme->load(['media','user','tags']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrganismeRequest $request, Organisme $organisme)
    {
        abort_if(Gate::denies('organisme_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $organisme->update($request->validated() + ['user_id' => Auth::user()->id, 'slug' => Str::slug($request->title)]);

        if (is_array($request->tag)) {
            $organisme->attachTags($request->tag);
        }

        if ($request->hasFile('file')) {

            $fileSize = $request->file('file')->getSize();
            if ($fileSize < 1024 * 1024) {
                // Taille en KB avec deux décimales
                $size = number_format($fileSize / 1024, 2) . ' KB';
            } else {
                // Taille en MB avec deux décimales
                $size = number_format($fileSize / 1024 / 1024, 2) . ' MB';
            }
            $organisme->size = $size;
            $organisme->save();
            $media = $organisme->getFirstMedia('organismes-files');
            if ($media) {
                $media->delete();
            }


            $organisme->addMediaFromRequest('file')->toMediaCollection('organismes-files');
        }

         if ($request->hasFile('image')) {
            $media2 = $organisme->getFirstMedia('organismes-images');
            if ($media2) {
                $media2->delete();
            }

            $organisme->addMediaFromRequest('image')->toMediaCollection('organismes-images');
        }
        return response()->json(['message' => "Information mises à jour"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organisme $organisme)
    {
        abort_if(Gate::denies('organisme_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($organisme) {
            $organisme->delete();
            return response()->json(['message' => "Ressource supprimé avec succes"]);
        } else {
            return response()->json(['message' => "Cette opportunitée n'existe pas"]);
        }
    }

    /**
     * Liste organisation et fonctionnement.
     */
    public function displayListe(){
        $organisme = Organisme::all();
        return new OrganismeResource($organisme->load(['media','tags']));
    }
}
