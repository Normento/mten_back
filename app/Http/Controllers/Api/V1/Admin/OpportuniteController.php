<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateRequest;
use App\Http\Requests\StoreOpportuniteRequest;
use App\Http\Requests\UpdateOpportuniteRequest;
use App\Http\Resources\OpportunityResource;
use App\Models\Opportunite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class OpportuniteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PaginateRequest $request)
    {
        abort_if(Gate::denies('opportunity_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $isPaginate = $request->isPaginate;
        $paginate = $isPaginate ?? 20;
        $opportunites = Opportunite::with(['media','user','category','tags'])->paginate($paginate);
        return new OpportunityResource($opportunites);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOpportuniteRequest $request)
    {
        abort_if(Gate::denies('opportunity_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $opportunite = Opportunite::create($request->validated() + ["user_id" => Auth::user()->id, 'slug' => Str::slug($request->title)]) ;

        if (is_array($request->tag)) {
            $opportunite->attachTags($request->tag);
        }

        if ($request->hasFile('file')) {
            $fileSize = $request->file('file')->getSize();
            if ($fileSize < 1024 * 1024) {
                // Taille en KB avec deux décimales
                $size = number_format($fileSize / 1024, 2) . ' KB';
            } else {
                // Taille en MB avec deux décimales
                $size = number_format($fileSize / 1024 / 1024, 2) . ' MB';
            }
            $opportunite->size = $size;
            $opportunite->save();
            $opportunite->addMediaFromRequest('file')->toMediaCollection('opportunites-files');
        }
        return new OpportunityResource($opportunite->load(['media','user','category','tags']));
    }

    /**
     * Display the specified resource.
     */
    public function show(Opportunite $opportunite)
    {
        abort_if(Gate::denies('opportunity_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new OpportunityResource($opportunite->load(['media','user','category','tags']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOpportuniteRequest $request, Opportunite $opportunite)
    {
        abort_if(Gate::denies('opportunity_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $opportunite->update($request->validated() + ['user_id' => Auth::user()->id, 'slug' => Str::slug($request->title)]);

        if (is_array($request->tag)) {
            $opportunite->attachTags($request->tag);
        }

        if ($request->hasFile('file')) {

            $fileSize = $request->file('file')->getSize();
            if ($fileSize < 1024 * 1024) {
                // Taille en KB avec deux décimales
                $size = number_format($fileSize / 1024, 2) . ' KB';
            } else {
                // Taille en MB avec deux décimales
                $size = number_format($fileSize / 1024 / 1024, 2) . ' MB';
            }
            $opportunite->size = $size;
            $opportunite->save();
            $media = $opportunite->getFirstMedia('opportunites-files');
            if ($media) {
                $media->delete();
            }

            $opportunite->addMediaFromRequest('file')->toMediaCollection('opportunites-files');
        }
        return response()->json(['message' => "Information mises à jour"]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Opportunite $opportunite)
    {
        abort_if(Gate::denies('opportunity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($opportunite) {
            $opportunite->delete();
            return response()->json(['message' => "Ressource supprimé avec succes"]);
        } else {
            return response()->json(['message' => "Cette opportunitée n'existe pas"]);
        }
    }


    public function displayListesOpportunities(){
        $opportunites = Opportunite::displayListesOpportunities();
        return new OpportunityResource($opportunites->load(['media','category','tags']));
    }

    public function displayOpportuniteDetails(Opportunite $opportunite){
        return new OpportunityResource($opportunite->load(['media','category','tags']));
    }

}
