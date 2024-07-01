<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\Projet;
use Illuminate\Http\Request;
use App\Models\CategoryProjet;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\ProjetResource;
use App\Http\Requests\StoreProjetRequest;
use App\Http\Requests\UpdateProjetRequest;
use Symfony\Component\HttpFoundation\Response;

class ProjetsApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PaginateRequest $request)
    {
        abort_if(Gate::denies('projet_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $paginate = $request->has('isPaginate') ? $request->input('isPaginate') : 10;
        $projets = Projet::with(['media', 'user', 'category', 'tags'])->paginate($paginate);
        return new ProjetResource($projets);
    }


    /**
     * Store a newly created resource in storage .
     */
    public function store(StoreProjetRequest $request)
    {
        abort_if(Gate::denies('projet_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $projet = Projet::create($request->validated() + ['user_id' => Auth::user()->id]);
        if ($request->hasFile('image')) {
            $projet->addMediaFromRequest('image')->toMediaCollection('projet-image');
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $fileSize = $file->getSize();

            if ($fileSize < 1024 * 1024) {
                // Taille en KB avec deux décimales
                $size = number_format($fileSize / 1024, 2) . ' KB';
            } else {
                // Taille en MB avec deux décimales
                $size = number_format($fileSize / 1024 / 1024, 2) . ' MB';
            }
            $projet->size = $size;
            $projet->save();
            $projet->addMediaFromRequest('file')->toMediaCollection('projets-files');
        }
        return new ProjetResource($projet->load(['media', 'user', 'category']));
    }

    /**
     * Display the specified resource.
     */
    public function show(Projet $projet)
    {
        abort_if(Gate::denies('projet_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new ProjetResource($projet->load(['media', 'user', 'category']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjetRequest $request, Projet $projet)
    {
        abort_if(Gate::denies('projet_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $projet->update($request->validated() + ['user_id' => Auth::user()->id]);

        if ($request->hasFile('image')) {
            $media = $projet->getFirstMedia('projets-images');
            if ($media) {
                $media->delete();
            }
            $projet->addMediaFromRequest('image')->toMediaCollection('projets-images');
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $fileSize = $file->getSize();



            if ($fileSize < 1024 * 1024) {
                // Taille en KB avec deux décimales
                $size = number_format($fileSize / 1024, 2) . ' KB';
            } else {
                // Taille en MB avec deux décimales
                $size = number_format($fileSize / 1024 / 1024, 2) . ' MB';
            }
            //dd($size);

            $projet->size = $size;
            $projet->save();
            $media2 = $projet->getFirstMedia('projets-files');
            if ($media2) {
                $media2->delete();
            }


            $projet->addMediaFromRequest('file')->toMediaCollection('projets-files');
        }

        return response()->json(['message' => "Information mises à jour"]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Projet $projet)
    {
        abort_if(Gate::denies('projet_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($projet) {
            $projet->delete();
            return response()->json(['message' => "Ressource supprimé avec succes"]);
        } else {
            return response()->json(['message' => "Ce projet n'existe pas"]);
        }
    }


    /**
     * Liste des projet recent home page.
     */
    public function projetrecent()
    {
        $projets = Projet::latest('created_at')->limit(3)->with('category')->get();

        return ProjetResource::collection($projets->load(['media', 'tags']));
    }

    /**
     * Liste des projet par category.
     */
    public function categoryprojet(CategoryProjet $category)
    {
        $projet = Projet::where('category_projet_id', $category->id)->get();
        return ProjetResource::collection($projet->load('media', 'tags'));
    }

    public function displayProjetDetails(Projet $projet)
    {

        return new ProjetResource($projet->load('media', 'tags'));
    }
}
