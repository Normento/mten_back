<?php

namespace App\Http\Controllers\Api\V1\Admin;

use Illuminate\Http\Request;
use App\Models\CategoryActualite;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\CategoryActualiteResource;
use App\Http\Requests\StoreCategoryActualiteRequest;
use App\Http\Requests\UpdateCategoryActualiteRequest;

class CategoryActualiteApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('categoryActualite_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $category = CategoryActualite::with('user')->paginate(10);

        return CategoryActualiteResource::collection($category);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryActualiteRequest $request)
    {
        abort_if(Gate::denies('categoryActualite_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $category = CategoryActualite::create($request->validated() + ['user_id' => Auth::user()->id]);

        return new CategoryActualiteResource($category->load('user'));
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryActualite $categoryActualite)
    {
        abort_if(Gate::denies('categoryActualite_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CategoryActualiteResource($categoryActualite->load('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryActualiteRequest $request, CategoryActualite $categoryActualite)
    {
        abort_if(Gate::denies('categoryActualite_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categoryActualite->update($request->validated() + ['user_id' => Auth::user()->id]);

        return response()->json(['message' => "Information mises à jour"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryActualite $categoryActualite)
    {
        abort_if(Gate::denies('categoryActualite_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($categoryActualite) {
            $categoryActualite->delete();
            return response()->json(['message' => "Category supprime avec success"]);
        } else {
            return response()->json(['message' => "Category n'existe pas"]);
        }
    }
}
