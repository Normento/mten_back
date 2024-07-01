<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateRequest;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class TagApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PaginateRequest $request)
    {
        abort_if(Gate::denies('tag_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $isPaginate = $request->isPaginate;
        $paginate = $isPaginate ?? 20;
        $tags = Tag::paginate($paginate);
        return new TagResource($tags);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagRequest $request)
    {
        abort_if(Gate::denies('tag_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tag = Tag::create($request->validated());
        return new TagResource($tag);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        abort_if(Gate::denies('tag_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        return new TagResource($tag);
    }

    /**
     * Update the specified resource in storage. Status à utiliser pour le status des questions de session:  'Pending','Approved','Rejected'
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        abort_if(Gate::denies('tag_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tag->update($request->validated());

        return  response()->json(['success' => 'Tag mise à jour']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        abort_if(Gate::denies('tag_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $tag->delete();
        return  response()->json(['success' => 'Tag mise à jour']);
    }
}
