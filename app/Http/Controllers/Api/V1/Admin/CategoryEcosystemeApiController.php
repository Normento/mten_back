<?php

namespace App\Http\Controllers\Api\V1\Admin;

use Illuminate\Http\Request;
use App\Models\CategoryEcosysteme;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryEcosystemeRequest;
use App\Http\Requests\UpdateCategoryEcosystemeRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\CategoryEcosystemeResource;

class CategoryEcosystemeApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('categoryEcosysteme_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categoryDocuments = CategoryEcosysteme::with('user')->paginate(10);

        return CategoryEcosystemeResource::collection($categoryDocuments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryEcosystemeRequest $request)
    {
        abort_if(Gate::denies('categoryEcosysteme_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categoryEcosysteme = CategoryEcosysteme::create($request->validated() + ['user_id' => Auth::user()->id]);

        return new CategoryEcosystemeResource($categoryEcosysteme->load('user'));
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryEcosysteme $categoryEcosysteme)
    {
        abort_if(Gate::denies('categoryEcosysteme_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CategoryEcosystemeResource($categoryEcosysteme->load(('user')));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryEcosystemeRequest $request, CategoryEcosysteme $categoryEcosysteme)
    {
        abort_if(Gate::denies('categoryEcosysteme_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categoryEcosysteme->update($request->validated() + ['user_id' => Auth::user()->id]);
        return response()->json(['message' => "Information mises à jour"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryEcosysteme $categoryEcosysteme)
    {
        abort_if(Gate::denies('categoryEcosysteme_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($categoryEcosysteme->exists()) {
            $categoryEcosysteme->delete();
            return response()->json(['message' => "Ressource supprimé avec succes"]);
        } else {
            return response()->json(['message' => "Cette Categorie n'existe pas"]);
        }
    }
}
