<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchActeurRequest;
use App\Http\Requests\SearchHomeRequest;
use App\Http\Requests\SearchActualiteRequest;
use App\Http\Requests\SearchOpportuniteRequest;
use App\Http\Requests\SearchFormationRequest;
use App\Http\Requests\SearchStartupRequest;
use App\Http\Requests\SearchRapportRequest;
use App\Http\Requests\SearchAgendaRequest;
use App\Http\Requests\SearchDirectionsRequest;
use App\Http\Requests\SearchDocumentRequest;
use App\Http\Requests\SearchEcosystemeRequest;
use App\Http\Requests\SearchEntiteRequest;
use App\Http\Requests\SearchEtatDesLieuxRequest;
use App\Http\Requests\SearchMinistreRequest;
use App\Http\Requests\SearchOrganisationRequest;
use App\Http\Requests\SearchPromotionRequest;
use App\Http\Requests\SearchReformeRequest;
use App\Http\Requests\SearchSensibilisationRequest;
use App\Http\Resources\ActeurResource;
use App\Http\Resources\ActualiteResource;
use App\Http\Resources\AgendaResource;
use App\Http\Resources\DirectionResource;
use App\Http\Resources\DocumentResource;
use App\Http\Resources\EcosystemeResource;
use App\Http\Resources\EntiteResource;
use App\Http\Resources\EtatDesLieuxResource;
use App\Http\Resources\FormationResource;
use App\Http\Resources\MinistreResource;
use App\Http\Resources\OpportunityResource;
use App\Http\Resources\OrganismeResource;
use App\Http\Resources\PromotionResource;
use App\Http\Resources\RapportResource;
use App\Http\Resources\ReformeResource;
use App\Http\Resources\SensibilisationResource;
use App\Http\Resources\StartupResource;
use App\Models\Acteur;
use App\Models\Actualite;
use App\Models\Agenda;
use App\Models\Direction;
use App\Models\Document;
use App\Models\Ecosysteme;
use App\Models\Entite;
use App\Models\EtatDesLieux;
use App\Models\Formation;
use App\Models\Ministre;
use App\Models\Opportunite;
use App\Models\Organisme;
use App\Models\Promotion;
use App\Models\Rapport;
use App\Models\Reforme;
use App\Models\Sensibilisation;
use App\Models\Startup;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SearchApiController extends Controller
{
    /**
    * Home search.
     *
     */
    public function searchHome(SearchHomeRequest $request)
    {
        $query = $request->input('query');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $searchType = $request->input('search_type'); // 'actualites', 'sessions' ou 'both'

        $tags = Tag::where('title', 'LIKE', '%' . $query . '%')->get();

        $actualites = collect();
        $sessions = collect();

        foreach ($tags as $tag) {
            // Charger les actualités associées au tag si le type de recherche inclut les actualités ou les deux
            if ($searchType == 'actualites' || $searchType == 'both') {
                $actualites = $actualites->merge($tag->actualites()->get());
            }

            // Charger les sessions associées au tag si le type de recherche inclut les sessions ou les deux
            if ($searchType == 'sessions' || $searchType == 'both') {
                $sessions = $sessions->merge($tag->sessions()->get());
            }
        }

        if ($startDate && $endDate) {
            $format = 'Y-m-d';
            $startDate = Carbon::createFromFormat($format, $startDate)->startOfDay();
            $endDate = Carbon::createFromFormat($format, $endDate)->endOfDay();

            // Filtrer les actualités par intervalle de dates
            if ($searchType == 'actualites' || $searchType == 'both') {
                $actualites = $actualites->filter(function ($actualite) use ($startDate, $endDate) {
                    return $actualite->created_at->between($startDate, $endDate);
                });
            }

            // Filtrer les sessions par intervalle de dates
            if ($searchType == 'sessions' || $searchType == 'both') {
                $sessions = $sessions->filter(function ($session) use ($startDate, $endDate) {
                    return $session->created_at->between($startDate, $endDate);
                });
            }
        }

        return response()->json(['actualites' => $actualites, 'sessions' => $sessions]);
    }

    /**
    * Retrieve acteurs based on the provided query (title or sigle ).
     *
     */
    public function acteursSearch(SearchActeurRequest $request)
    {
        $query = $request->input('query');
        $sigle = $request->input('sigle');
        $isPaginator = $request->input('isPaginator')?: 10;

        $acteurs = Acteur::query();

        // Filter acteurs by title or sigle if query is provided
        if ($query) {
            $acteurs->where('name', 'LIKE', '%' . $query . '%')->orWhere('sigle', 'LIKE', '%' . $sigle . '%');
        } else {
            // If query is empty, return an empty result set
            $acteurs->whereRaw('1=0');
        }

        return new ActeurResource($acteurs->with('media')->paginate($isPaginator));
    }

    /**
    * Retrieve Reformes based on the provided query (title or and startdate , enddate ).
     *
     */
    public function reformesSearch(SearchReformeRequest $request)
    {
        $query = $request->input('query');
        $date = Carbon::parse( $request->input('date') )->year;
        $isPaginator = $request->input('isPaginator')?: 10;

        $tags = Tag::where('title', 'LIKE', '%'.$query.'%')->get();

        $reformeIds = [];

        // If there are tags found, collect reforme IDs based on tags
        if ($tags->isNotEmpty()) {
            foreach ($tags as $tag) {
                $reformeIds = array_merge($reformeIds, $tag->reformes()
                    ->where('status', 'isPublished')
                    ->whereYear('reformes.created_at', $date)
                    ->pluck('reformes.id')
                    ->toArray());
            }
        }

        // If reformeIds is empty, execute the query based on reform title
        if (empty($reformeIds)) {
            $reformeIds = Reforme::where('title', 'LIKE', '%' . $query . '%')
                ->where('status', 'isPublished')
                ->whereYear('created_at', $date)
                ->pluck('id')
                ->toArray();
        }

        // Paginate the reformes directly from the database
        $reformes = Reforme::whereIn('reformes.id', $reformeIds)->with('media','tags')->paginate($isPaginator);

        // Retourner les réformes sous forme de réponse JSON
        return new ReformeResource($reformes);

    }

    /**
    * Retrieve ministere agenda based on the provided query (title  and or startdate , enddate).
     *
     */
    public function ministereAgendaSearch(SearchAgendaRequest $request)
    {
        $query = $request->input('query');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $isPaginator = $request->input('isPaginator')?: 10;

        $tags = Tag::where('title', 'LIKE', '%' . $query . '%')->get();

        $agendaIds = [];

        // If there are tags found, collect reforme IDs based on tags
        if ($tags->isNotEmpty()) {
            foreach ($tags as $tag) {
                $agendaIds = array_merge($agendaIds, $tag->agendas()
                    ->where('status', 'isPublished')
                    ->where('type', 'ministere')
                    ->pluck('agendas.id')
                    ->toArray());
            }
        }

        // If reformeIds is empty, execute the query based on reform title
        if (empty($agendaIds)) {
            $agendaIds = Agenda::where('title', 'LIKE', '%' . $query . '%')
                ->where('status', 'isPublished')
                ->where('type', 'ministere')
                ->pluck('id')
                ->toArray();
        }

        // Get agendas based on collected IDs
        $agendas = Agenda::whereIn('id', $agendaIds)->with('media','tags');

        // If start and end dates are provided, filter the results
        if ($startDate && $endDate) {
            $format = 'Y-m-d H:i:s';
            $startDate = Carbon::createFromFormat($format, $startDate)->startOfDay();
            $endDate = Carbon::createFromFormat($format, $endDate)->endOfDay();

            $agendas->where(function ($query) use ($startDate, $endDate) {
                $query->whereDate('start_date', '>=', $startDate)
                    ->whereDate('end_date', '<=', $endDate);
            });
        }

        // return response()->json(['ministereAgendas' => $agendas]);
        return new AgendaResource($agendas->paginate($isPaginator));
    }

    /**
    * Retrieve ministre agenda based on the provided query (title  and or startdate , enddate).
     *
     */
    public function ministreAgendaSearch(SearchAgendaRequest $request)
    {
        $query = $request->input('query');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $isPaginator = $request->input('isPaginator')?: 10;

        $tags = Tag::where('title', 'LIKE', '%' . $query . '%')->get();

        $agendaIds = [];

        // If there are tags found, collect reforme IDs based on tags
        if ($tags->isNotEmpty()) {
            foreach ($tags as $tag) {
                $agendaIds = array_merge($agendaIds, $tag->agendas()
                    ->where('status', 'isPublished')
                    ->where('type', 'ministre')
                    ->pluck('agendas.id')
                    ->toArray());
            }
        }

        // If reformeIds is empty, execute the query based on reform title
        if (empty($agendaIds)) {
            $agendaIds = Agenda::where('title', 'LIKE', '%' . $query . '%')
                ->where('status', 'isPublished')
                ->where('type', 'ministre')
                ->pluck('id')
                ->toArray();
        }

        // Get agendas based on collected IDs
        $agendas = Agenda::whereIn('id', $agendaIds)->with('media','tags');

        // If start and end dates are provided, filter the results
        if ($startDate && $endDate) {
            $format = 'Y-m-d H:i:s';
            $startDate = Carbon::createFromFormat($format, $startDate)->startOfDay();
            $endDate = Carbon::createFromFormat($format, $endDate)->endOfDay();

            $agendas->where(function ($query) use ($startDate, $endDate) {
                $query->whereDate('start_date', '>=', $startDate)
                    ->whereDate('end_date', '<=', $endDate);
            });
        }

        // return response()->json(['ministereAgendas' => $agendas]);
        return new AgendaResource($agendas->paginate($isPaginator));
    }

    /**
    * Retrieve actualites based on the provided query (title ).
     *
     */
    public function actualitesSearch(SearchActualiteRequest $request)
    {
        $query = $request->input('query');
        $type = $request->input('type');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $isPaginator = $request->input('isPaginator')?: 10;

        $actualites = Actualite::query();

        // Check if any filtering parameters are provided
        if (!$query && !$type && !$startDate && !$endDate) {
            // return empty result set
            $actualites->whereRaw('1=0');
        }

        if ($query) {
            $actualites->where(function ($actualityQuery) use ($query) {
                $actualityQuery->whereHas('tags', function ($tagQuery) use ($query) {
                        $tagQuery->where('title', 'LIKE', '%' . $query . '%');
                    })
                    ->orWhere('title', 'LIKE', '%' . $query . '%');
            });
        }

        if ($type) {
            $actualites->whereHas('category', function ($queryBuilder) use ($type) {
                $queryBuilder->where('name', 'LIKE', '%' . $type . '%');
            });
        }

        // If start and end dates are provided, filter the results
        if ($startDate && $endDate) {
            $format = 'Y-m-d H:i:s';
            $startDate = Carbon::createFromFormat($format, $startDate)->startOfDay();
            $endDate = Carbon::createFromFormat($format, $endDate)->endOfDay();

            $actualites->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate,$endDate] );
            });
        }

        $actualites = $actualites->where('status', 'isPublished')->with('media','tags')->paginate($isPaginator);

        return new ActualiteResource($actualites);
    }


    /**
    * Retrieve rapports based on the provided query (title ).
     *
     */
    public function rapportsSearch(SearchRapportRequest $request)
    {
        $query = $request->input('query');
        $type = $request->input('type');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $isPaginator = $request->input('isPaginator')?: 10;

        $rapports = Rapport::query();

        // Check if any filtering parameters are provided
        if (!$query && !$type && !$startDate && !$endDate) {
            // return empty result set
            $rapports->whereRaw('1=0');
        }

        if ($query) {
            $rapports->where(function ($rapportQuery) use ($query) {
                $rapportQuery->whereHas('tags', function ($tagQuery) use ($query) {
                        $tagQuery->where('title', 'LIKE', '%' . $query . '%');
                    })
                    ->orWhere('title', 'LIKE', '%' . $query . '%');
            });
        }

        if ($type) {
            $rapports->whereHas('category', function ($queryBuilder) use ($type) {
                $queryBuilder->where('name', 'LIKE', '%' . $type . '%');
            });
        }

        // If start and end dates are provided, filter the results
        if ($startDate && $endDate) {
            $format = 'Y-m-d H:i:s';
            $startDate = Carbon::createFromFormat($format, $startDate)->startOfDay();
            $endDate = Carbon::createFromFormat($format, $endDate)->endOfDay();

            $rapports->where(function ($query) use ($startDate, $endDate) {
                $query->whereDate('start_date', '>=', $startDate)
                    ->whereDate('end_date', '<=', $endDate);
            });
        }

        $rapports = $rapports->where('status', 'isPublished')->with('media','tags')->paginate($isPaginator);

        return new RapportResource($rapports);
    }


    /**
    * Retrieve opportunites based on the provided query (title ).
     *
     */
    public function opportunitesSearch(SearchOpportuniteRequest $request)
    {
        $query = $request->input('query');
        $type = $request->input('type');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $isPaginator = $request->input('isPaginator')?: 10;

        $opportunites = Opportunite::query();

        // Check if any filtering parameters are provided
        if (!$query && !$type && !$startDate && !$endDate) {
            // return empty result set
            $opportunites->whereRaw('1=0');
        }

        if ($query) {
            $opportunites->where(function ($opportuniteQuery) use ($query) {
                $opportuniteQuery->whereHas('tags', function ($tagQuery) use ($query) {
                        $tagQuery->where('title', 'LIKE', '%' . $query . '%');
                    })
                    ->orWhere('title', 'LIKE', '%' . $query . '%');
            });
        }

        if ($type) {
            $opportunites->whereHas('category', function ($queryBuilder) use ($type) {
                $queryBuilder->where('name', 'LIKE', '%' . $type . '%');
            });
        }

        // If start and end dates are provided, filter the results
        if ($startDate && $endDate) {
            $format = 'Y-m-d H:i:s';
            $startDate = Carbon::createFromFormat($format, $startDate)->startOfDay();
            $endDate = Carbon::createFromFormat($format, $endDate)->endOfDay();

            $opportunites->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate,$endDate] );
            });
        }

        $opportunites = $opportunites->with('media','tags')->paginate($isPaginator);

        return new OpportunityResource($opportunites);
    }

    /**
    * Retrieve startup based on the provided query (title ).
     *
     */
    public function startupsSearch(SearchStartupRequest $request)
    {
        $query = $request->input('query');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $isPaginator = $request->input('isPaginator')?: 10;

        $startups = Startup::query();

        // Check if any filtering parameters are provided
        if (!$query && !$startDate && !$endDate) {
            // return empty result set
            $startups->whereRaw('1=0');
        }

        if ($query) {
            $startups->where(function ($startupQuery) use ($query) {
                $startupQuery->whereHas('tags', function ($tagQuery) use ($query) {
                        $tagQuery->where('title', 'LIKE', '%' . $query . '%');
                    })
                    ->orWhere('name', 'LIKE', '%' . $query . '%');
            });
        }


        // If start and end dates are provided, filter the results
        if ($startDate && $endDate) {
            $format = 'Y-m-d H:i:s';
            $startDate = Carbon::createFromFormat($format, $startDate)->startOfDay();
            $endDate = Carbon::createFromFormat($format, $endDate)->endOfDay();

            $startups->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_date', [$startDate,$endDate] );
            });
        }

        $startups = $startups->with('media','tags')->paginate($isPaginator);

        return new StartupResource($startups);
    }

    /**
    * Retrieve formation based on the provided query (title ).
     *
     */
    public function formationsSearch(SearchFormationRequest $request)
    {
        $query = $request->input('query');
        $type = $request->input('type');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $isPaginator = $request->input('isPaginator')?: 10;

        $formations = Formation::query();

        // Check if any filtering parameters are provided
        if (!$query && !$type && !$startDate && !$endDate) {
            // return empty result set
            $formations->whereRaw('1=0');
        }

        if ($query) {
            $formations->where(function ($formationQuery) use ($query) {
                $formationQuery->whereHas('tags', function ($tagQuery) use ($query) {
                        $tagQuery->where('title', 'LIKE', '%' . $query . '%');
                    })
                    ->orWhere('title', 'LIKE', '%' . $query . '%');
            });
        }

        if ($type) {
            $formations->whereHas('category', function ($queryBuilder) use ($type) {
                $queryBuilder->where('name', 'LIKE', '%' . $type . '%');
            });
        }

        // If start and end dates are provided, filter the results
        if ($startDate && $endDate) {
            $format = 'Y-m-d H:i:s';
            $startDate = Carbon::createFromFormat($format, $startDate)->startOfDay();
            $endDate = Carbon::createFromFormat($format, $endDate)->endOfDay();

            $formations->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate,$endDate] );
            });
        }

        $formations = $formations->with('media','tags')->paginate($isPaginator);

        return new FormationResource($formations);
    }

        /**
    * Retrieve etat des lieux based on the provided query (tag ) and start_date, end_date .
     *
     */
    public function etatDesLieuxSearch(SearchEtatDesLieuxRequest $request)
    {
        $query = $request->input('query');
        $date = Carbon::parse( $request->input('date') )->year;
        $isPaginator = $request->input('isPaginator')?: 10;

        $etatDesLieux = EtatDesLieux::query();

        // Check if any filtering parameters are provided
        if (!$query && !$date) {
            // return empty result set
            $etatDesLieux->whereRaw('1=0');
        }

        if ($query) {
            $etatDesLieux->where('title', 'LIKE', '%' . $query . '%');
        }

        if ($date) {
            $etatDesLieux->whereYear('published_at', $date);
        }


        // Paginate the reformes directly from the database
        $etatDesLieux = $etatDesLieux->where('status','isPublished')->with('media')->paginate($isPaginator);

        // Retourner les réformes sous forme de réponse JSON
        return new EtatDesLieuxResource($etatDesLieux);

    }


    /**
    * Retrieve organisations based on the provided query (title ).
     *
     */
    public function organisationsSearch(SearchOrganisationRequest $request)
    {
        $query = $request->input('query');
        $title = $request->input('title');
        $isPaginator = $request->input('isPaginator')?: 10;

        $organisations = Organisme::query();

        // Check if any filtering parameters are provided
        if (!$query && !$title) {
            // return empty result set
            $organisations->whereRaw('1=0');
        }

        if ($query) {
            $organisations->whereHas('tags', function ($tagQuery) use ($query) {
                $tagQuery->where('title', 'LIKE', '%' . $query . '%');
            });
        }

        if ($title) {
            $organisations->where('title', 'LIKE', '%' . $title . '%');
        }

        // Paginate the reformes directly from the database
        $organisations = $organisations->with('media','tags')->paginate($isPaginator);

        // Retourner les réformes sous forme de réponse JSON
        return new OrganismeResource($organisations);
    }


    /**
    * Retrieve entites based on the provided query (title ).
     *
     */
    public function entitesSearch(SearchEntiteRequest $request)
    {
        $query = $request->input('query');
        $sigle = $request->input('sigle');
        $isPaginator = $request->input('isPaginator')?: 10;

        $entites = Entite::query();

        // Check if any filtering parameters are provided
        if (!$query && !$sigle) {
            // return empty result set
            $entites->whereRaw('1=0');
        }

        if ($query) {
            $entites->where('name', 'LIKE', '%' . $query . '%');
        }

        if ($sigle) {
            $entites->where('sigle', 'LIKE', '%' . $sigle . '%');
        }

        // Paginate the reformes directly from the database
        $entites = $entites->with('media')->paginate($isPaginator);

        // Retourner les réformes sous forme de réponse JSON
        return new EntiteResource($entites);
    }


    /**
    * Retrieve documents based on the provided query (title ).
     *
     */
    public function documentsSearch(SearchDocumentRequest $request)
    {
        $query = $request->input('query');
        $type = $request->input('type');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $isPaginator = $request->input('isPaginator')?: 10;

        $documents = Document::query();

        // Check if any filtering parameters are provided
        if (!$query && !$type && !$startDate && !$endDate) {
            // return empty result set
            $documents->whereRaw('1=0');
        }

        if ($query) {
            $documents->where(function ($documentQuery) use ($query) {
                $documentQuery->whereHas('tags', function ($tagQuery) use ($query) {
                        $tagQuery->where('title', 'LIKE', '%' . $query . '%');
                    })
                    ->orWhere('name', 'LIKE', '%' . $query . '%');
            });
        }

        if ($type) {
            $documents->whereHas('category', function ($queryBuilder) use ($type) {
                $queryBuilder->where('name', 'LIKE', '%' . $type . '%');
            });
        }

        // If start and end dates are provided, filter the results
        if ($startDate && $endDate) {
            $format = 'Y-m-d H:i:s';
            $startDate = Carbon::createFromFormat($format, $startDate)->startOfDay();
            $endDate = Carbon::createFromFormat($format, $endDate)->endOfDay();

            $documents->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate,$endDate] );
            });
        }

        $documents = $documents->where('status', 'isPublished')->with('media','tags')->paginate($isPaginator);

        return new DocumentResource($documents);

    }


    /**
    * Retrieve direction based on the provided query (title ).
     *
     */
    public function directionsSearch(SearchDirectionsRequest $request)
    {
        $query = $request->input('query');
        $sigle = $request->input('sigle');
        $isPaginator = $request->input('isPaginator')?: 10;

        $directions = Direction::query();

        // Check if any filtering parameters are provided
        if (!$query && !$sigle) {
            // return empty result set
            $directions->whereRaw('1=0');
        }

        if ($query) {
            $directions->where('name', 'LIKE', '%' . $query . '%');
        }

        if ($sigle) {
            $directions->where('sigle', 'LIKE', '%' . $sigle . '%');
        }

        // Retourner les réformes sous forme de réponse JSON
        return new DirectionResource($directions->paginate($isPaginator));
    }


    /**
    * Retrieve Ministre based on the provided query (title ).
     *
     */
    public function ministresSearch(SearchMinistreRequest $request)
    {
        $query = $request->input('query');
        $isPaginator = $request->input('isPaginator') ?: 10;

        $ministres = Ministre::query();

        // Filter ministre by title if query is provided
        if ($query) {
            $ministres->where('firstname', 'LIKE', '%' . $query . '%')
                    ->orWhere('lastname', 'LIKE', '%' . $query . '%');
        } else {
            // If query is empty, return an empty result set
            $ministres->whereRaw('1=0');
        }

        return new MinistreResource($ministres->with('media')->paginate($isPaginator));

    }


    /**
    * Retrieve ecosysteme based on the provided query (title ).
     *
     */
    public function ecosystemeSearch(SearchEcosystemeRequest $request)
    {
        $query = $request->input('query');
        $isPaginator = $request->input('isPaginator') ?: 10;

        $ecosystemes = Ecosysteme::query();

        // Filter user by title if query is provided
        if ($query) {
            $ecosystemes->where('title', 'LIKE', '%' . $query . '%')
                        ->orWhere('description', 'LIKE', '%' . $query . '%');
        } else {
            // If query is empty, return an empty result set
            $ecosystemes->whereRaw('1=0');
        }

        return new EcosystemeResource($ecosystemes->paginate($isPaginator));
    }


    /**
    * Retrieve sensibilisation based on the provided query (title ).
     *
     */
    public function sensibilisationSearch(SearchSensibilisationRequest $request)
    {
        $query = $request->input('query');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $isPaginator = $request->input('isPaginator')?: 10;

        $sensibilisations = Sensibilisation::query();

        // Check if any filtering parameters are provided
        if (!$query && !$startDate && !$endDate) {
            // return empty result set
            $sensibilisations->whereRaw('1=0');
        }

        if ($query) {
            $sensibilisations->where('title', 'LIKE', '%' . $query . '%')->orWhere('description', 'LIKE', '%' . $query . '%');
        }

         // If start and end dates are provided, filter the results
         if ($startDate && $endDate) {
            $format = 'Y-m-d H:i:s';
            $startDate = Carbon::createFromFormat($format, $startDate)->startOfDay();
            $endDate = Carbon::createFromFormat($format, $endDate)->endOfDay();

            $sensibilisations->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate,$endDate] );
            });
        }

        return new SensibilisationResource($sensibilisations->with('media')->paginate($isPaginator));

    }

    /**
    * Retrieve promotions based on the provided query (title and date intervale ).
     *
     */
    public function promotionSearch(SearchPromotionRequest $request)
    {
        $query = $request->input('query');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $isPaginator = $request->input('isPaginator')?: 10;

        $promotions = Promotion::query();

        // Check if any filtering parameters are provided
        if (!$query && !$startDate && !$endDate) {
            // return empty result set
            $promotions->whereRaw('1=0');
        }

        if ($query) {
            $promotions->where('title', 'LIKE', '%' . $query . '%')->orWhere('description', 'LIKE', '%' . $query . '%');
        }

         // If start and end dates are provided, filter the results
         if ($startDate && $endDate) {
            $format = 'Y-m-d H:i:s';
            $startDate = Carbon::createFromFormat($format, $startDate)->startOfDay();
            $endDate = Carbon::createFromFormat($format, $endDate)->endOfDay();

            $promotions->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate,$endDate] );
            });
        }

        return new PromotionResource($promotions->with('media')->paginate($isPaginator));

    }

}
