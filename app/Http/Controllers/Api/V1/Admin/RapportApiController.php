<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\Rapport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateRequest;
use App\Http\Requests\StoreRapportRequest;
use App\Http\Requests\UpdateRapportRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\RapportResource;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class RapportApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PaginateRequest $request)
    {
        abort_if(Gate::denies('rapport_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $isPaginate = $request->isPaginate;
        $paginate = $isPaginate ?? 20;
        $rapport = Rapport::with(['user','category','media', 'tags'])->paginate($paginate);
        return new RapportResource($rapport);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRapportRequest $request)
    {

        abort_if(Gate::denies('rapport_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $rapport = Rapport::create($request->validated() + ['user_id' => Auth::user()->id, 'slug' => Str::slug($request->title)]);

        if (is_array($request->tag)) {
            $rapport->attachTags($request->tag);
        }

        if ($request->hasFile('image')) {
            $rapport->addMediaFromRequest('image')->toMediaCollection('rapports-images');
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
            $rapport->size = $size;
            $rapport->save();

            $rapport->addMediaFromRequest('file')->toMediaCollection('rapports-files');
        }

        return new RapportResource($rapport->load(['user','category','media', 'tags']));
    }

    /**
     * Display the specified resource.
     */
    public function show(Rapport $rapport)
    {
        abort_if(Gate::denies('rapport_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new RapportResource($rapport->load((['category', 'user', 'media', 'tags'])));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRapportRequest $request, Rapport $rapport)
    {
        abort_if(Gate::denies('rapport_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $rapport->update($request->validated() + ['user_id' => Auth::user()->id , 'slug' => Str::slug($request->title)]);

        if (is_array($request->tag)) {
            $rapport->attachTags($request->tag);
        }

        if ($request->hasFile('image')) {
            $media = $rapport->getFirstMedia('rapports-images');
            if ($media) {
                $media->delete();
            }

            $rapport->addMediaFromRequest('image')->toMediaCollection('rapports-images');
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
            $rapport->size = $size;
            $rapport->save();
            $media2 = $rapport->getFirstMedia('rapports-files');
            if ($media2) {
                $media2->delete();
            }


            $rapport->addMediaFromRequest('file')->toMediaCollection('rapports-files');
        }

        return response()->json(['message' => "Information mises à jour"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rapport $rapport)
    {
        abort_if(Gate::denies('rapport_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($rapport) {
            $rapport->delete();
            return response()->json(['message' => "rapport a ete supprime avec success"]);
        } else {
            return response()->json(['message' => "rapport n'existe pas"]);
        }
    }

    public function displayListesRapport(){
        $rapports = Rapport::getListesRapport();
        return new RapportResource($rapports->load(['category','media','tags']));
    }

    public function displayRapportDetail(Rapport $rapport){
        return new RapportResource($rapport->load(['category','media','tags']));
    }
}
