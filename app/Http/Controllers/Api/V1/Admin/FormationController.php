<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateRequest;
use App\Http\Requests\StoreFormationRequest;
use App\Http\Requests\UpdateFormationRequest;
use App\Models\Formation;
use App\Http\Resources\FormationResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PaginateRequest $request)
    {
        abort_if(Gate::denies('formation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $isPaginate = $request->isPaginate;
        $paginate = $isPaginate ?? 20;
        $formations = Formation::with(['media','user','category','tags'])->paginate($paginate);
        return new FormationResource($formations);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFormationRequest $request)
    {
        abort_if(Gate::denies('formation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $formation = Formation::create($request->validated() + ["user_id" => Auth::user()->id, 'slug' => Str::slug($request->title)]) ;

        if (is_array($request->tag)) {
            $formation->attachTags($request->tag);
        }

        if ($request->hasFile('image')) {

            $formation->addMediaFromRequest('image')->toMediaCollection('formations-images');
        }

        return new FormationResource($formation->load(['media','user','category','tags']));
    }

    /**
     * Display the specified resource.
     */
    public function show(Formation $formation)
    {
        abort_if(Gate::denies('formation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new FormationResource($formation->load(['media','user','category','tags']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFormationRequest $request, Formation $formation)
    {
        abort_if(Gate::denies('formation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $formation->update($request->validated() + ['user_id' => Auth::user()->id, 'slug' => Str::slug($request->title)]);

        if (is_array($request->tag)) {
            $formation->attachTags($request->tag);
        }

        if ($request->hasFile('image')) {
           $media = $formation->getFirstMedia('formations-images');
            if ($media) {
                $media->delete();
            }

            $formation->addMediaFromRequest('image')->toMediaCollection('formations-images');
        }
        return response()->json(['message' => "Information mises à jour"]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formation $formation)
    {
        abort_if(Gate::denies('formation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($formation) {
            $formation->delete();
            return response()->json(['message' => "Ressource supprimé avec succes"]);
        } else {
            return response()->json(['message' => "Cette formation n'existe pas"]);
        }
    }


    /**
     * Listes des formations.
     */
    public function displayListesFormation()
    {
        $formations = Formation::with(['media','category','tags'])->get();
        return new FormationResource($formations);
    }

    /**
     * Details formations.
     */
    public function displayFormationDetail(Formation $formation)
    {
        return new FormationResource($formation->load(['media','category','tags']));
    }
}
