<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateRequest;
use App\Http\Requests\StoreAboutRequest;
use App\Http\Requests\UpdateAboutRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\AboutResource;
use Symfony\Component\HttpFoundation\Response;

class AboutApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PaginateRequest $request)
    {
        abort_if(Gate::denies('about_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $isPaginate = $request->isPaginate;
        $paginate = $isPaginate ?? 10;
        $about = About::with(['user'])->paginate($paginate);
        return AboutResource::collection($about);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAboutRequest $request)
    {
        abort_if(Gate::denies('about_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $about = About::create($request->validated() + ['user_id' => Auth::user()->id]);
        return new AboutResource($about->load(['user']));
    }

    /**
     * Display the specified resource.
     */
    public function show(About $about)
    {
        abort_if(Gate::denies('about_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new AboutResource($about->load(['user']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAboutRequest $request, About $about)
    {
        abort_if(Gate::denies('about_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $about->update($request->validated() + ['user_id' => Auth::user()->id]);

        return response()->json(['message' => "Information mises à jour"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(About $about)
    {
        abort_if(Gate::denies('acteur_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($about) {
            $about->delete();
            return response()->json(['message' => "La ressource a ete supprime avec success"]);
        } else {
            return response()->json(['message' => "ressource n'existe pas"]);
        }
    }

    public function about(){

        $about = About::orderBy('created_at', 'desc')->first();

        return new AboutResource($about);
    }
}
