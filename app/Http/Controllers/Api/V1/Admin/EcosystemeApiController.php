<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Requests\StoreEcosystemeRequest;
use App\Models\Ecosysteme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateRequest;
use App\Http\Requests\UpdateEcosystemeRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\EcosystemeResource;
use Symfony\Component\HttpFoundation\Response;

class EcosystemeApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PaginateRequest $request)
    {
        abort_if(Gate::denies('ecosysteme_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $isPaginate = $request->isPaginate;
        $paginate = $isPaginate ?? 20;
        $ecosysteme = Ecosysteme::with(['user', 'category', 'tags'])->paginate($paginate);
        return new EcosystemeResource($ecosysteme);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEcosystemeRequest $request)
    {
        abort_if(Gate::denies('ecosysteme_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $ecosysteme = Ecosysteme::create($request->validated() + ['user_id' => Auth::user()->id]);
        return new EcosystemeResource($ecosysteme->load(['user', 'tags']));
    }

    /**
     * Display the specified resource.
     */
    public function show(Ecosysteme $ecosysteme)
    {
        abort_if(Gate::denies('ecosysteme_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new EcosystemeResource($ecosysteme->load(['user', 'tags']));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEcosystemeRequest $request, Ecosysteme $ecosysteme)
    {
        abort_if(Gate::denies('ecosysteme_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $ecosysteme->update($request->validated() + ['user_id' => Auth::user()->id]);
        return response()->json(['message' => "Information mises à jour"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ecosysteme $ecosysteme)
    {
        abort_if(Gate::denies('ecosysteme_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($ecosysteme) {
            $ecosysteme->delete();
            return response()->json(['message' => "ecosysteme supprime avec success"]);
        } else {
            return response()->json(['message' => "ecosysteme n'existe pas"]);
        }
    }

    public function findlatest()
    {
        $ecosysteme = Ecosysteme::latest('created_at')->first();
        return new EcosystemeResource($ecosysteme);
    }
}
