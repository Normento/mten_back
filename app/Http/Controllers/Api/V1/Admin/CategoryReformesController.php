<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryReformes;
use App\Http\Requests\UpdateCategoryReformes;
use Illuminate\Http\Request;
use App\Models\CategoryReformes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\CategoryReformesResource;

class CategoryReformesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('categoryReforme_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categoryReforme = CategoryReformes::with('user')->paginate(10);
        return CategoryReformesResource::collection($categoryReforme);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryReformes $request)
    {
        abort_if(Gate::denies('categoryReforme_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categoryReforme = CategoryReformes::create($request->validated() + ['user_id' => Auth::user()->id]);
        return new CategoryReformesResource($categoryReforme->load('user'));
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryReformes $categoryReforme)
    {
        abort_if(Gate::denies('categoryReforme_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new CategoryReformesResource($categoryReforme->load('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryReformes $request, CategoryReformes $categoryReforme)
    {
        abort_if(Gate::denies('categoryReforme_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categoryReforme->update($request->validated() + ['user_id' => Auth::user()->id]);
        return response()->json(['message' => "Information mises à jour"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryReformes $categoryReforme)
    {
        abort_if(Gate::denies('categoryRapport_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($categoryReforme->exists()) {
            $categoryReforme->delete();
            return response()->json(['message' => "Ressource supprimé avec succes"]);
        } else {
            return response()->json(['message' => "Cette Categorie n'existe pas"]);
        }
    }
}
