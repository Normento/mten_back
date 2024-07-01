<?php

namespace App\Http\Controllers\Api\V1\Admin;

use Carbon\Carbon;
use App\Models\Agenda;
use App\Models\Ministre;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\AgendaFiltreRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\PaginateRequest;
use App\Http\Resources\AgendaResource;
use App\Http\Requests\StoreAgendaRequest;
use App\Http\Requests\UpdateAgendaRequest;
use Symfony\Component\HttpFoundation\Response;

class AgendasApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AgendaFiltreRequest $request)
    {
        abort_if(Gate::denies('agenda_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data = [
            'startdate' => $request->startdate,
            'enddate' => $request->enddate,
        ];

        if ($data['startdate'] && $data['enddate']) {
            $format = 'Y-m-d';
            $start = Carbon::createFromFormat($format,$data['startdate'])->format('Y-m-d');
            $end = Carbon::createFromFormat($format,$data['enddate'])->format('Y-m-d');
            $agenda = Agenda::where('start_date', $start)
                ->where('end_date', $end)
                ->with(['user', 'category', 'media', 'tags'])
                ->get();
        }
        $agenda = Agenda::with(['user', 'category', 'media', 'tags'])->get();
        return AgendaResource::collection($agenda);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAgendaRequest $request)
    {
        abort_if(Gate::denies('agenda_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $agenda = Agenda::create($request->validated() + ['user_id' => Auth::user()->id, 'slug' => Str::slug($request->title)]);

        if (is_array($request->tag)) {
            $agenda->attachTags($request->tag);
        }

        if ($request->hasFile('image')) {
            $agenda->addMediaFromRequest('image')->toMediaCollection('agendas-images');
        }
        return new AgendaResource($agenda->load(['user', 'category', 'media', 'tags']));
    }

    /**
     * Display the specified resource.
     */
    public function show(Agenda $agenda)
    {
        abort_if(Gate::denies('agenda_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $image_url = $agenda->getFirstMediaUrl('agendas-images');
        return new AgendaResource($agenda->load(['media', 'tags', 'category']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAgendaRequest $request, Agenda $agenda)
    {
        abort_if(Gate::denies('agenda_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $agenda->update($request->validated() + ['user_id' => Auth::user()->id, 'slug' => Str::slug($request->title)]);

        if (is_array($request->tag)) {
            $agenda->attachTags($request->tag);
        }

        if ($request->hasFile('image')) {
            $media = $agenda->getFirstMedia('agendas-images');
            if ($media) {
                $media->delete();
            }
            $agenda->addMediaFromRequest('image')->toMediaCollection('agendas-images');
        }

        return response()->json(['message' => "Information mises à jour"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agenda $agenda)
    {
        abort_if(Gate::denies('agenda_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($agenda) {
            $agenda->delete();
            return response()->json(['message' => "L'agenda a ete supprime avec success"]);
        } else {
            return response()->json(['message' => "L'agenda n'existe pas"]);
        }
    }




    public function agendaDetail(Agenda $agenda)
    {
        return new AgendaResource($agenda->load((['media', 'tags', 'category'])));
    }

    /**
     * Agenda du ministre.
     */
    public function ministreagenda()
    {

        $ministre = Ministre::where('on_poste', 1)->first();
        //dd($ministre);
        $aganda = Agenda::where('ministre_id', $ministre->id)
            ->where('type', 'ministre')
            ->where('status', 'isPublished')
            ->with(['media', 'tags'])
            ->get();

        return response()->json(['data' => $aganda], 200);
    }

    /**
     * Agenda du ministere.
     */
    public function ministereagendas()
    {
        $agandaMinisteres = Agenda::with(['media', 'category', 'tags'])
            ->where('type', 'ministere')
            ->where('status', 'isPublished')
            ->get();

        return AgendaResource::collection($agandaMinisteres);
    }
}
