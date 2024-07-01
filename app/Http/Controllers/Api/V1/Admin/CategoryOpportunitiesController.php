<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryOpportunityRequest;
use App\Http\Requests\UpdateCategoryOpportunityRequest;
use App\Http\Resources\CategoryOpportunityResource;
use App\Models\CategoryOpportunity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CategoryOpportunitiesController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('categoryOpportunity_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categoryOpportunities = CategoryOpportunity::with('user')->paginate(10);
        return CategoryOpportunityResource::collection($categoryOpportunities);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryOpportunityRequest $request)
    {
        abort_if(Gate::denies('categoryOpportunity_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categoryOpportunity = CategoryOpportunity::create($request->validated() + ['user_id' => Auth::user()->id]);
        return new CategoryOpportunityResource($categoryOpportunity->load('user'));
    }


    /**
     * Display the specified resource.
     */
    public function show(CategoryOpportunity $categoryOpportunity)
    {
        abort_if(Gate::denies('categoryOpportunity_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new CategoryOpportunityResource($categoryOpportunity->load('user'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryOpportunityRequest $request, CategoryOpportunity $categoryOpportunity)
    {
        abort_if(Gate::denies('categoryOpportunity_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categoryOpportunity->update($request->validated() + ['user_id' => Auth::user()->id]);
        return response()->json(['message' => "Information mises à jour"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryOpportunity $categoryOpportunity)
    {
        abort_if(Gate::denies('categoryOpportunity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($categoryOpportunity->exists()) {
            $categoryOpportunity->delete();
            return response()->json(['message' => "Ressource supprimé avec succes"]);
        } else {
            return response()->json(['message' => "Cette Categorie d'opportunité n'existe pas"]);
        }
    }
}
