<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\Direction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateRequest;
use App\Http\Requests\StoreDirectionRequest;
use App\Http\Requests\UpdateDirectionRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\DirectionResource;
use App\Models\CategoryDirection;
use Symfony\Component\HttpFoundation\Response;

class DirectionApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PaginateRequest $request)
    {
        abort_if(Gate::denies('direction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $isPaginate = $request->isPaginate;
        $paginate = $isPaginate ?? 20;

        $direction = Direction::with(['user'])->paginate($paginate);

        return new DirectionResource($direction);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDirectionRequest $request)
    {
        abort_if(Gate::denies('direction_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $direction = Direction::create($request->validated() + ['user_id' => Auth::user()->id]);

        return new DirectionResource($direction->load(['user']));
    }

    /**
     * Display the specified resource.
     */
    public function show(Direction $direction)
    {
        abort_if(Gate::denies('direction_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DirectionResource($direction->load(['user']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDirectionRequest $request, Direction $direction)
    {
        abort_if(Gate::denies('direction_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $direction->update($request->validated() + ['user_id' => Auth::user()->id]);

        return response()->json(['message' => "Information mises à jour"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Direction $direction)
    {
        abort_if(Gate::denies('direction_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($direction) {
            $direction->delete();
            return response()->json(['message' => "Direction supprime avec success"]);
        } else {
            return response()->json(['message' => "Direction n'existe pas"]);
        }
    }

    /**
     * Liste des directions.
     */
    public function findliste()
    {
        $category = CategoryDirection::all();
        return DirectionResource::collection($category->load('directions'));
    }

    public function directiondetail( Direction $direction)
    {
        return new DirectionResource($direction);
    }

    public function organigrame()
    {
        $organigrame = Direction::all();
        return response()->json([
            'data' => $organigrame,
        ],200);
    }


}
