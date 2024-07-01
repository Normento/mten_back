<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\EtatDesLieux;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateRequest;
use App\Http\Requests\StoreEntiteRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\EtatDesLieuxResource;
use App\Http\Requests\StoreEtatDesLieuxRequest;
use App\Http\Requests\UpdateEtatDesLieuxRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;


class EtatDesLieuxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PaginateRequest $request)
    {
        abort_if(Gate::denies('etatDesLieux_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $isPaginate = $request->isPaginate;
        $paginate = $isPaginate ?? 20;
        $etatsDesLieux = EtatDesLieux::with(['user', 'media'])->paginate($paginate);
        return new EtatDesLieuxResource($etatsDesLieux);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEtatDesLieuxRequest $request)
    {
        abort_if(Gate::denies('etatDesLieux_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $etats_des_lieux = EtatDesLieux::create($request->validated() + ['user_id' => Auth::user()->id, 'slug' => Str::slug($request->title)]);

        if ($request->hasFile('image')) {
            $etats_des_lieux->addMediaFromRequest('image')->toMediaCollection('etatDesLieux-images');
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
            $etats_des_lieux->size = $size;
            $etats_des_lieux->save();

            $etats_des_lieux->addMediaFromRequest('file')->toMediaCollection('etatDesLieux-files');
        }
        return new EtatDesLieuxResource($etats_des_lieux->load(['user','media']));
    }

    /**
     * Display the specified resource.
     */
    public function show(EtatDesLieux $etats_des_lieux)
    {
        abort_if(Gate::denies('etatDesLieux_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new EtatDesLieuxResource($etats_des_lieux->load(['user', 'media']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEtatDesLieuxRequest $request, EtatDesLieux $etats_des_lieux)
    {
        abort_if(Gate::denies('etatDesLieux_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $etats_des_lieux->update($request->validated() + ['user_id' => Auth::user()->id, 'slug' => Str::slug($request->title)]);

        if ($request->hasFile('image')) {
            $media1 = $etats_des_lieux->getFirstMedia('etatDesLieux-images');
            if ($media1) {
                $media1->delete();
            }

            $etats_des_lieux->addMediaFromRequest('image')->toMediaCollection('etatDesLieux-images');
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
            $etats_des_lieux->size = $size;
            $etats_des_lieux->save();
            $media2 = $etats_des_lieux->getFirstMedia('etatDesLieux-files');
            if ($media2) {
                $media2->delete();
            }

            $etats_des_lieux->addMediaFromRequest('file')->toMediaCollection('etatDesLieux-files');
        }
        return response()->json(['message' => "Information mises à jour"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EtatDesLieux $etats_des_lieux)
    {
        abort_if(Gate::denies('etatDesLieux_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($etats_des_lieux) {
            $etats_des_lieux->delete();
            return response()->json(['message' => "Etat des lieux a ete supprime avec success"]);
        } else {
            return response()->json(['message' => "Etat des lieux n'existe pas"]);
        }
    }

    public function download( EtatDesLieux $etat )
    {
        $etat->downloads_count = (int)$etat->downloads_count + 1;
        $etat->save();
        return response()->json(['message' => "download count +1"]);
    }

    public function read( EtatDesLieux $etat  )
    {
        $etat->views_count = (int)$etat->views_count + 1;
        $etat->save();
        return response()->json(['message' => "read count +1"]);
    }

    /**
     * Liste etats des lieux.
     */
    public function displayListeEtatsDesLieux()
    {
        $etats_des_lieux = EtatDesLieux::with(['media'])->get();
        return new EtatDesLieuxResource($etats_des_lieux);
    }

    /**
     * Details etats des lieux.
     */
    public function displayEtatDesLieuxDetails(EtatDesLieux $etats_des_lieux)
    {
        return new EtatDesLieuxResource($etats_des_lieux->load(['media']));
    }
}
