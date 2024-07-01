<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\Reforme;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\ReformeResource;
use App\Http\Requests\StoreReformeRequest;
use App\Http\Requests\UpdateReformeRequest;
use Symfony\Component\HttpFoundation\Response;

class ReformeApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PaginateRequest $request)
    {
        abort_if(Gate::denies('reforme_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $isPaginate = $request->isPaginate;
        $paginate = $isPaginate ?? 20;
        $reformes = Reforme::with(['user', 'media', 'tags'])->paginate($paginate);
        return new ReformeResource($reformes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReformeRequest $request)
    {
        abort_if(Gate::denies('reforme_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $reforme = Reforme::create($request->validated() + ['user_id' => Auth::user()->id, 'slug'=> Str::slug($request->title)]);

        if (is_array($request->tag)) {
            $reforme->attachTags($request->tag);
        }

        if ($request->hasFile('image')) {

            $reforme->addMediaFromRequest('image')->toMediaCollection('reformes-images');
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $fileSize = $file->getSize();

            if ($fileSize < 1024 * 1024) {
                // Taille en KB avec deux décimales
                $size = number_format($fileSize / 1024, 2) . ' KB';
            } else {
                // Taille en MB avec deux décimales
                $size = number_format($fileSize / 1024 / 1024, 2) . ' MB';
            }

            $reforme->size = $size;
            $reforme->save();
            $reforme->addMediaFromRequest('file')->toMediaCollection('reformes-files');
        }
        return new ReformeResource($reforme->load(['media', 'tags']));
    }

    /**
     * Display the specified resource.
     */
    public function show(Reforme $reforme)
    {
        abort_if(Gate::denies('reforme_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new ReformeResource($reforme->load((['user', 'media', 'tags'])));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReformeRequest $request, Reforme $reforme)
    {
        abort_if(Gate::denies('reforme_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $reforme->update($request->validated() + ['user_id' => Auth::user()->id, 'slug'=> Str::slug($request->title)]);

        if (is_array($request->tag)) {
            $reforme->attachTags($request->tag);
        }

        if ($request->hasFile('image')) {
            $media = $reforme->getFirstMedia('reformes-images');
            if ($media) {
                $media->delete();
            }


            $reforme->addMediaFromRequest('image')->toMediaCollection('reformes-images');
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $fileSize = $file->getSize();

            if ($fileSize < 1024 * 1024) {
                // Taille en KB avec deux décimales
                $size = number_format($fileSize / 1024, 2) . ' KB';
            } else {
                // Taille en MB avec deux décimales
                $size = number_format($fileSize / 1024 / 1024, 2) . ' MB';
            }

            $reforme->size = $size;
            $reforme->save();
            $media2 = $reforme->getFirstMedia('reformes-files');
            if ($media2) {
                $media2->delete();
            }

            $reforme->addMediaFromRequest('file')->toMediaCollection('reformes-files');
        }
        return response()->json(['message' => "Information mises à jour"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reforme $reforme)
    {
        abort_if(Gate::denies('reforme_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($reforme) {
            $reforme->delete();
            return response()->json(['message' => "reforme a ete supprime avec success"]);
        } else {
            return response()->json(['message' => "reforme n'existe pas"]);
        }
    }

    public function download( Reforme $reforme )
    {
        $reforme->downloads_count = (int)$reforme->downloads_count + 1;
        $reforme->save();
        return response()->json(['message' => "download count +1"]);
    }

    public function read( Reforme $reforme  )
    {
        $reforme->views_count = (int)$reforme->views_count + 1;
        $reforme->save();
        return response()->json(['message' => "read count +1"]);
    }

    /**
     * Liste reforme.
     */
    public function displayListeReforme(){
        $reforme = Reforme::getLatestReforme();
        return new ReformeResource($reforme->load(['media','tags']));
    }


    /**
     * Details reforme.
     */
    public function displayReformeDetails(Reforme $reforme)
    {
        return new ReformeResource($reforme->load(['media','tags']));
    }

}
