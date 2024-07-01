<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\Document;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CategoryDocument;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\DocumentResource;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use Symfony\Component\HttpFoundation\Response;

class DocumentController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(PaginateRequest $request)
    {
        abort_if(Gate::denies('document_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $isPaginate = $request->isPaginate;
        $paginate = $isPaginate ?? 20;

        $documents = Document::with(['media','user','category','tags'])->paginate($paginate);

        return new DocumentResource($documents);
    }


    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        abort_if(Gate::denies('document_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new DocumentResource($document->load(['media','user','category','tags']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDocumentRequest $request)
    {


        abort_if(Gate::denies('document_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $document = Document::create($request->validated() + ['user_id' => Auth::user()->id, 'slug' => Str::slug($request->name)]);

        if (is_array($request->tag)) {
            $document->attachTags($request->tag);
        }

        if ($request->hasFile('image')) {

            $document->addMediaFromRequest('image')->toMediaCollection('documents-files');
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

            $document->size = $size;
            $document->save();

            $document->addMediaFromRequest('file')->toMediaCollection('documents-files');
        }


        return new DocumentResource($document->load(['media','user','category','tags']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDocumentRequest $request, Document $document)
    {
        abort_if(Gate::denies('document_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $document->update($request->validated() + ['user_id' => Auth::user()->id, 'slug' => Str::slug($request->name)]);

        if (is_array($request->tag)) {
            $document->attachTags($request->tag);
        }

        if ($request->hasFile('image')) {
            $media1 = $document->getFirstMedia('documents-images');
            if ($media1) {
                $media1->delete();
            }

            $document->addMediaFromRequest('image')->toMediaCollection('documents-images');
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

            $document->size = $size;
            $document->save();
            $media = $document->getFirstMedia('documents-files');
            if ($media) {
                $media->delete();
            }

            $document->addMediaFromRequest('file')->toMediaCollection('documents-files');
        }
        return response()->json(['message' => "Informations mises à jour"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        abort_if(Gate::denies('document_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($document) {
            $document->delete();
            return response()->json(['message' => "Ressource supprimé avec succes"]);
        } else {
            return response()->json(['message' => "Ce document n'existe pas"]);
        }

    }

    public function download( Document $document )
    {

        $document->downloads_count = (int)$document->downloads_count + 1;
        $document->save();
        dd($document);
        return response()->json(['message' => "download count +1"]);
    }

    public function read( Document $document  )
    {
        $document->views_count = (int)$document->views_count + 1;
        $document->save();
        return response()->json(['message' => "read count +1"]);
    }

    /**
     * Liste des documents.
     */
    public function documentliste(){
        $document = Document::where('status','isPublished')->whereHas('category', function($query){
            $query->where('type','classique');
        })
        ->get();

        return DocumentResource::collection($document->load('media','tags','category'));

    }


}
