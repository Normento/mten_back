<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryStartupRequest;
use App\Http\Requests\UpdateCategoryStartupRequest;
use App\Models\CategoryStartup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\CategoryStartupResource;

class CategoryStartupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('categoryStartup_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $category = CategoryStartup::with('user')->paginate(10);

        return CategoryStartupResource::collection($category);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryStartupRequest $request)
    {
        abort_if(Gate::denies('categoryStartup_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $category = CategoryStartup::create($request->validated() + ['user_id' => Auth::user()->id]);
        return new CategoryStartupResource($category->load('user'));
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryStartup $categoryStartup)
    {
        abort_if(Gate::denies('categoryStartup_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CategoryStartupResource($categoryStartup->load('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryStartupRequest $request, CategoryStartup $categoryStartup)
    {
        abort_if(Gate::denies('categoryStartup_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categoryStartup->update($request->validated() + ['user_id' => Auth::user()->id]);

        return response()->json(['message' => "Information mises à jour"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryStartup $categoryStartup)
    {
        abort_if(Gate::denies('categoryStartup_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($categoryStartup) {
            $categoryStartup->delete();
            return response()->json(['message' => "Category supprime avec success"]);
        } else {
            return response()->json(['message' => "Category n'existe pas"]);
        }
    }
}
