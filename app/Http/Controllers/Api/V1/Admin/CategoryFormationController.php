<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryFormationRequest;
use App\Http\Requests\UpdateCategoryFormationRequest;
use App\Models\CategoryFormation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\CategoryFormationResource;

class CategoryFormationController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('categoryFormation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $category = CategoryFormation::with('user')->paginate(10);

        return CategoryFormationResource::collection($category);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryFormationRequest $request)
    {
        abort_if(Gate::denies('categoryFormation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $category = CategoryFormation::create($request->validated() + ['user_id' => Auth::user()->id]);
        return new CategoryFormationResource($category->load('user'));
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryFormation $categoryFormation)
    {
        abort_if(Gate::denies('categoryFormation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CategoryFormationResource($categoryFormation->load('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryFormationRequest $request, CategoryFormation $categoryFormation)
    {
        abort_if(Gate::denies('categoryFormation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categoryFormation->update($request->validated() + ['user_id' => Auth::user()->id]);

        return response()->json(['message' => "Information mises à jour"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryFormation $categoryFormation)
    {
        abort_if(Gate::denies('categoryFormation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($categoryFormation) {
            $categoryFormation->delete();
            return response()->json(['message' => "Category supprime avec success"]);
        } else {
            return response()->json(['message' => "Category n'existe pas"]);
        }
    }
}
