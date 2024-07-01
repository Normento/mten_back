<?php

namespace App\Http\Controllers\Api\V1\Admin;

use Illuminate\Http\Request;
use App\Models\CategoryRapport;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRapport;
use App\Http\Requests\UpdateCategoryRapport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\CategoryRapportResource;

class CategoryRapportApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('categoryRapport_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categoryRapport = CategoryRapport::with('user')->paginate(10);
        return CategoryRapportResource::collection($categoryRapport);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRapport $request)
    {
        abort_if(Gate::denies('categoryRapport_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categoryRapport = CategoryRapport::create($request->validated() + ['user_id' => Auth::user()->id]);
        return new CategoryRapportResource($categoryRapport->load('user'));
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryRapport $categoryRapport)
    {
        abort_if(Gate::denies('categoryRapport_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new CategoryRapportResource($categoryRapport->load('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRapport $request, CategoryRapport $categoryRapport)
    {
        abort_if(Gate::denies('categoryRapport_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categoryRapport->update($request->validated() + ['user_id' => Auth::user()->id]);
        return response()->json(['message' => "Information mises à jour"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryRapport $categoryRapport)
    {
        abort_if(Gate::denies('categoryRapport_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($categoryRapport->exists()) {
            $categoryRapport->delete();
            return response()->json(['message' => "Ressource supprimé avec succes"]);
        } else {
            return response()->json(['message' => "Cette Categorie n'existe pas"]);
        }
    }

   
}
