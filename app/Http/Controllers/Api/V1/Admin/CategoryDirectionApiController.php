<?php

namespace App\Http\Controllers\Api\V1\Admin;

use Illuminate\Http\Request;
use App\Models\CategoryDirection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CategoryDirectionResource;
use App\Http\Requests\StoreCategoryDirectionRequest;
use App\Http\Requests\UpdateCategoryDirectionRequest;

class CategoryDirectionApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $category = CategoryDirection::with('user')->paginate(10);
        return CategoryDirectionResource::collection($category); 
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryDirectionRequest $request)
    {
        $category = CategoryDirection::create($request->validated() + ['user_id' => Auth::user()->id]);

        return new CategoryDirectionResource($category->load('user'));
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryDirection $categoryDirection)
    {
        return new CategoryDirectionResource($categoryDirection->load('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryDirectionRequest $request, CategoryDirection $categoryDirection)
    {
        $categoryDirection->update($request->validated() + ['user_id' => Auth::user()->id]);

        return response()->json(['message' => "Information mises à jour"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryDirection $categoryDirection)
    {
         if ($categoryDirection) {
            $categoryDirection->delete();
            return response()->json(['message' => "Category supprime avec success"]);
        } else {
            return response()->json(['message' => "Category n'existe pas"]);
        }
    }
}
