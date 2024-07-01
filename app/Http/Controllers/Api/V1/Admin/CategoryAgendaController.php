<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\CategoryAgenda;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\CategoryAgendaResource;
use App\Http\Requests\StoreCategoryAgenda;
use App\Http\Requests\UpdateCategoryAgenda;



class CategoryAgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('categoryAgenda_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $category = CategoryAgenda::with('user')->paginate(10);
        return CategoryAgendaResource::collection($category); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryAgenda $request)
    {
        abort_if(Gate::denies('categoryAgenda_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $category = CategoryAgenda::create($request->validated() + ['user_id' => Auth::user()->id]);

        return new CategoryAgendaResource($category->load('user'));
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryAgenda $categoryAgenda)
    {
        abort_if(Gate::denies('categoryAgenda_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CategoryAgendaResource($categoryAgenda->load('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryAgenda $request, CategoryAgenda $categoryAgenda)
    {
        abort_if(Gate::denies('categoryAgenda_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categoryAgenda->update($request->validated() + ['user_id' => Auth::user()->id]);

        return response()->json(['message' => "Information mises à jour"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryAgenda $categoryAgenda)
    {
        abort_if(Gate::denies('categoryAgenda_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($categoryAgenda) {
            $categoryAgenda->delete();
            return response()->json(['message' => "Category supprime avec success"]);
        } else {
            return response()->json(['message' => "Category n'existe pas"]);
        }
    }
}
