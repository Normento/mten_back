<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\Ministre;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateRequest;
use App\Http\Requests\StoreMinistreRequest;
use App\Http\Requests\UpdateMinistreRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\MinistreResource;
use Symfony\Component\HttpFoundation\Response;

class MinistreApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PaginateRequest $request)
    {
        abort_if(Gate::denies('ministre_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $isPaginate = $request->isPaginate;
        $paginate = $isPaginate ?? 20;
        $ministre = Ministre::with(['user', 'media'])->paginate($paginate);
        return new MinistreResource($ministre);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMinistreRequest $request)
    {

        abort_if(Gate::denies('ministre_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $findMinistre = Ministre::where(['on_poste' => 1])->first();

        if ($request->on_poste == 1 && $findMinistre) {
            return response()->json(['message' => "Vous ne pouvez pas mettre ce ministre en fonction il y a un ministre en fonction"]);
        }
        $ministre = Ministre::create($request->validated() + ['user_id' => Auth::user()->id]);

        if ($request->hasFile('image')) {

            $ministre->addMediaFromRequest('image')->toMediaCollection('ministres-images');
        }

        return new MinistreResource($ministre->load(['user', 'media']));
    }

    /**
     * Display the specified resource.
     */
    public function show(Ministre $ministre)
    {
        abort_if(Gate::denies('ministre_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new MinistreResource($ministre->load(['user']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMinistreRequest $request, Ministre $ministre)
    {
        abort_if(Gate::denies('ministre_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $ministre->update($request->validated() + ['user_id' => Auth::user()->id]);

        if ($request->hasFile('image')) {
            $media = $ministre->getFirstMedia('ministres-images');
            if ($media) {
                $media->delete();
            }

            $ministre->addMediaFromRequest('image')->toMediaCollection('ministres-images');
        }
        return response()->json(['message' => "Information mises à jour"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ministre $ministre)
    {
        abort_if(Gate::denies('ministre_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($ministre) {
            $ministre->delete();
            return response()->json(['message' => "ministre supprime avec success"]);
        } else {
            return response()->json(['message' => "ministre n'existe pas"]);
        }
    }
    /**
     * Archive du ministère
     */
    public function archives()
    {
        $ministre = Ministre::all();
        return MinistreResource::collection($ministre->load(['media']));
    }
    /**
     * mot-biographie-ministre
     */
    public function ministre()
    {
        $ministre =  Ministre::where('on_poste', 1)->first();
        return new  MinistreResource($ministre->load(['media']));
    }
}
