<?php

namespace App\Http\Controllers\Api\V1\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CategoryDocument;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\CategoryDocumentResource;
use App\Http\Requests\StoreCategoryDocumentRequest;
use App\Http\Requests\UpdateCategoryDocumentRequest;

class CategoryDocumentController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('categoryDocument_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categoryDocuments = CategoryDocument::with('user')->paginate(10);

        return CategoryDocumentResource::collection($categoryDocuments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryDocumentRequest $request)
    {
        abort_if(Gate::denies('categoryDocument_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categoryDocument = CategoryDocument::create($request->validated() + ['user_id' => Auth::user()->id, 'slug' => Str::slug($request->name)]);

        return new CategoryDocumentResource($categoryDocument->load('user'));
    }


    /**
     * Display the specified resource.
     */
    public function show(CategoryDocument $categoryDocument)
    {
        abort_if(Gate::denies('categoryDocument_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CategoryDocumentResource($categoryDocument->load(('user')));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryDocumentRequest $request, CategoryDocument $categoryDocument)
    {
        abort_if(Gate::denies('categoryDocument_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categoryDocument->update($request->validated() + ['user_id' => Auth::user()->id, 'slug' => Str::slug($request->name)]);
        return response()->json(['message' => "Information mises à jour"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryDocument $categoryDocument)
    {
        abort_if(Gate::denies('categoryDocument_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($categoryDocument->exists()) {
            $categoryDocument->delete();
            return response()->json(['message' => "Ressource supprimé avec succes"]);
        } else {
            return response()->json(['message' => "Cette Categorie de document n'existe pas"]);
        }
    }

    /**
     * Liste des category cadre juridique et institutionel.
     */
    public function getdocumentjuridiquescategory(){

        $document = CategoryDocument::where('type', 'juridique')
            ->get();

        return response()->json([
            'data' => $document
        ]);

    }

    /**
     * Liste des documents d'une category de cadre juridique.
     */
    public function getdocumentjuridiques(CategoryDocument $document){

        return response()->json([
            'data' => $document->load('document','document.media')
        ]);

    }
}
