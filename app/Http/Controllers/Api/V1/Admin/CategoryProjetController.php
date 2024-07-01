<?php

namespace App\Http\Controllers\Api\V1\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CategoryProjet;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\CategoryProjetResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreCategoryProjetRequest;
use App\Http\Requests\UpdateCategoryProjetRequest;

class CategoryProjetController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('categoryProjet_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categoryProjets = CategoryProjet::with('user')->paginate(10);
        return CategoryProjetResource::collection($categoryProjets);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryProjetRequest $request)
    {
        abort_if(Gate::denies('categoryProjet_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categoryProjet = CategoryProjet::create($request->validated() + ['user_id' => Auth::user()->id,'slug'=>Str::slug($request->name)]);
        return new CategoryProjetResource($categoryProjet->load('user'));
    }


    /**
     * Display the specified resource.
     */
    public function show(CategoryProjet $categoryProjet)
    {
        abort_if(Gate::denies('categoryProjet_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new CategoryProjetResource($categoryProjet->load('user'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryProjetRequest $request, CategoryProjet $categoryProjet)
    {
        abort_if(Gate::denies('categoryProjet_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categoryProjet->update($request->validated() + ['user_id' => Auth::user()->id, 'slug' => Str::slug($request->name)]);
        return response()->json(['message' => "Information mises à jour"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryProjet $categoryProjet)
    {
        abort_if(Gate::denies('categoryProjet_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($categoryProjet->exists()) {
            $categoryProjet->delete();
            return response()->json(['message' => "Ressource supprimé avec succes"]);
        } else {
            return response()->json(['message' => "Cette Categorie de projet n'existe pas"]);
        }
    }

      /**
     * Liste des category projets.
     */
    public function categoryprojet()
    {
        $category = CategoryProjet::all();
        return CategoryProjetResource::collection($category);
    }

    


}
