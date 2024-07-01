<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateRequest;
use App\Http\Requests\StoreStartupRequest;
use App\Http\Requests\UpdateStartupRequest;
use App\Models\Startup;
use App\Http\Resources\StartupResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class StartupController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(PaginateRequest $request)
    {
        abort_if(Gate::denies('startup_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $isPaginate = $request->isPaginate;
        $paginate = $isPaginate ?? 20;
        $startups = Startup::with(['media','user','category','tags'])->paginate($paginate);
        return new StartupResource($startups);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStartupRequest $request)
    {
        abort_if(Gate::denies('startup_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $startup = Startup::create($request->validated() + ["user_id" => Auth::user()->id, 'slug' => Str::slug($request->name)]) ;

        if (is_array($request->tag)) {
            $startup->attachTags($request->tag);
        }

        if ($request->hasFile('image')) {
            $startup->addMediaFromRequest('image')->toMediaCollection('startups-images');
        }

        return new StartupResource($startup->load(['media','user','category','tags']));
    }

    /**
     * Display the specified resource.
     */
    public function show(Startup $startup)
    {
        abort_if(Gate::denies('startup_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new StartupResource($startup->load(['media','user','category','tags']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStartupRequest $request, Startup $startup)
    {
        abort_if(Gate::denies('startup_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $startup->update($request->validated() + ['user_id' => Auth::user()->id, 'slug' => Str::slug($request->name)]);

        if (is_array($request->tag)) {
            $startup->attachTags($request->tag);
        }

        if ($request->hasFile('image')) {
            $media = $startup->getFirstMedia('startups-images');
            if ($media) {
                $media->delete();
            }

            $startup->addMediaFromRequest('image')->toMediaCollection('startups-images');
        }
        return response()->json(['message' => "Information mises à jour"]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Startup $startup)
    {
        abort_if(Gate::denies('startup_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($startup) {
            $startup->delete();
            return response()->json(['message' => "Ressource supprimé avec succes"]);
        } else {
            return response()->json(['message' => "Cette startup n'existe pas"]);
        }
    }


    /**
     * Listes des startups.
     */
    public function displayListesStartup()
    {
        $startups = Startup::with(['media','category','tags'])->get();
        return new StartupResource($startups);
    }

    /**
     * Details des startups.
     */
    public function displayStartupDetail(Startup $startup)
    {
        return new StartupResource($startup->load(['media','category','tags']));
    }

}
