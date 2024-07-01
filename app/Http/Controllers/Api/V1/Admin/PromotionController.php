<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateRequest;
use App\Http\Requests\StorePromotionRequest;
use App\Http\Requests\UpdatePromotionRequest;
use App\Models\Promotion;
use App\Http\Resources\PromotionResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
class PromotionController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index(PaginateRequest $request)
    {
        abort_if(Gate::denies('promotion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $isPaginate = $request->isPaginate;
        $paginate = $isPaginate ?? 10;
        $promotions = Promotion::with(['media','user'])->paginate($paginate);
        return new PromotionResource($promotions);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePromotionRequest $request)
    {
        abort_if(Gate::denies('promotion_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $promotion = Promotion::create($request->validated() + ['user_id' => Auth::user()->id, 'slug' => Str::slug($request->title)]);
        if ($request->hasFile('image')) {
            $promotion->addMediaFromRequest('image')->toMediaCollection('promotions-images');
        }
        return new PromotionResource($promotion->load(['media','user']));
    }

    /**
     * Display the specified resource.
     */
    public function show(Promotion $promotion)
    {
        abort_if(Gate::denies('promotion_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new PromotionResource($promotion->load(['media','user']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePromotionRequest $request, Promotion $promotion)
    {
        abort_if(Gate::denies('promotion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $promotion->update($request->validated() + ['user_id' => Auth::user()->id, 'slug' => Str::slug($request->title)]);
        if ($request->hasFile('image')) {
            $media = $promotion->getFirstMedia('promotions-images');
            if ($media) {
                $media->delete();
            }
            $promotion->addMediaFromRequest('image')->toMediaCollection('promotions-images');
        }
        return response()->json(['message' => "Information mises à jour"]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promotion $promotion)
    {
        abort_if(Gate::denies('promotion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($promotion) {
            $promotion->delete();
            return response()->json(['message' => "Ressource supprimé avec succes"]);
        } else {
            return response()->json(['message' => "Cette promotion n'existe pas"]);
        }
    }


    /**
     * Listes Promotion economie numerique.
     */
    public function displayListesPromotion()
    {
        $promotions = Promotion::with(['media'])->get();
        return new PromotionResource($promotions);
    }

    /**
     * Details promotion economie numerique.
     */
    public function displayPromotionDetail(Promotion $promotion)
    {
        return new PromotionResource($promotion->load(['media']));
    }
}
