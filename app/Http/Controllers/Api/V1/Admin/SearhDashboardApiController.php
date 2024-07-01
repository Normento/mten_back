<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DashboardSearchActeurRequest;
use App\Http\Requests\DashboardSearchActualiteRequest;
use App\Http\Requests\DashboardSearchAgendaRequest;
use App\Http\Requests\DashboardSearchDirectionRequest;
use App\Http\Requests\DashboardSearchDocumentRequest;
use App\Http\Requests\DashboardSearchEcosystemeRequest;
use App\Http\Requests\DashboardSearchEntiteRequest;
use App\Http\Requests\DashboardSearchEtatdeslieuRequest;
use App\Http\Requests\DashboardSearchFormationRequest;
use App\Http\Requests\DashboardSearchMinistreRequest;
use App\Http\Requests\DashboardSearchOpportuniteRequest;
use App\Http\Requests\DashboardSearchOrganisationRequest;
use App\Http\Requests\DashboardSearchPromotionRequest;
use App\Http\Requests\DashboardSearchRapportRequest;
use App\Http\Requests\DashboardSearchReformeRequest;
use App\Http\Requests\DashboardSearchSensibilisationRequest;
use App\Http\Requests\DashboardSearchStartupRequest;
use App\Http\Requests\DashboardSearchUsersRequest;
use App\Http\Requests\DashboardSearchUsersRoleRequest;
use App\Http\Requests\DashboardSearchUsersStatusRequest;
use App\Http\Requests\SearchActeurRequest;
use App\Http\Requests\SearchActualiteRequest;
use App\Http\Requests\SearchAgendaRequest;
use App\Http\Requests\SearchCategoryActualiteRequest;
use App\Http\Requests\SearchCategoryAgendaRequest;
use App\Http\Requests\SearchCategoryDirectionRequest;
use App\Http\Requests\SearchCategoryDocumentRequest;
use App\Http\Requests\SearchCategoryEcosystemeRequest;
use App\Http\Requests\SearchCategoryFormationRequest;
use App\Http\Requests\SearchCategoryOpportunityRequest;
use App\Http\Requests\SearchCategoryProjetRequest;
use App\Http\Requests\SearchCategoryRapportRequest;
use App\Http\Requests\SearchCategoryReformesRequest;
use App\Http\Requests\SearchCategorySecteurRequest;
use App\Http\Requests\SearchCategoryStartupRequest;
use App\Http\Requests\SearchDirectionsRequest;
use App\Http\Requests\SearchDocumentRequest;
use App\Http\Requests\SearchEcosystemeRequest;
use App\Http\Requests\SearchEntiteRequest;
use App\Http\Requests\SearchEtatDesLieuxRequest;
use App\Http\Requests\SearchFormationRequest;
use App\Http\Requests\SearchMinistreRequest;
use App\Http\Requests\SearchOpportuniteRequest;
use App\Http\Requests\SearchOrganisationRequest;
use App\Http\Requests\SearchPermissionsRequest;
use App\Http\Requests\SearchRapportRequest;
use App\Http\Requests\SearchReformeRequest;
use App\Http\Requests\SearchRolesRequest;
use App\Http\Requests\SearchStartupRequest;
use App\Http\Requests\SearchTagsRequest;
use App\Http\Requests\SearchUserRequest;
use App\Http\Resources\ActeurResource;
use App\Http\Resources\ActualiteResource;
use App\Http\Resources\AgendaResource;
use App\Http\Resources\CategoryActualiteResource;
use App\Http\Resources\CategoryAgendaResource;
use App\Http\Resources\CategoryDirectionResource;
use App\Http\Resources\CategoryDocumentResource;
use App\Http\Resources\CategoryEcosystemeResource;
use App\Http\Resources\CategoryFormationResource;
use App\Http\Resources\CategoryOpportunityResource;
use App\Http\Resources\CategoryProjetResource;
use App\Http\Resources\CategoryRapportResource;
use App\Http\Resources\CategoryReformesResource;
use App\Http\Resources\CategoryStartupResource;
use App\Http\Resources\DirectionResource;
use App\Http\Resources\DocumentResource;
use App\Http\Resources\EcosystemeResource;
use App\Http\Resources\EntiteResource;
use App\Http\Resources\EtatDesLieuxResource;
use App\Http\Resources\FormationResource;
use App\Http\Resources\MinistreResource;
use App\Http\Resources\OpportunityResource;
use App\Http\Resources\OrganismeResource;
use App\Http\Resources\PermissionRessource;
use App\Http\Resources\PromotionResource;
use App\Http\Resources\RapportResource;
use App\Http\Resources\ReformeResource;
use App\Http\Resources\RoleResource;
use App\Http\Resources\SensibilisationResource;
use App\Http\Resources\StartupResource;
use App\Http\Resources\TagResource;
use App\Http\Resources\UserResource;
use App\Models\Acteur;
use App\Models\Actualite;
use App\Models\Agenda;
use App\Models\CategoryActualite;
use App\Models\CategoryAgenda;
use App\Models\CategoryDirection;
use App\Models\CategoryDocument;
use App\Models\CategoryEcosysteme;
use App\Models\CategoryFormation;
use App\Models\CategoryOpportunity;
use App\Models\CategoryProjet;
use App\Models\CategoryRapport;
use App\Models\CategoryReformes;
use App\Models\CategoryStartup;
use App\Models\Direction;
use App\Models\Document;
use App\Models\Ecosysteme;
use App\Models\Entite;
use App\Models\EtatDesLieux;
use App\Models\Formation;
use App\Models\Ministre;
use App\Models\Opportunite;
use App\Models\Organisme;
use App\Models\Permission;
use App\Models\Promotion;
use App\Models\Rapport;
use App\Models\Reforme;
use App\Models\Role;
use App\Models\Sensibilisation;
use App\Models\Startup;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class SearhDashboardApiController extends Controller
{

    /**
    * Retrieve Actualites based on the provided query (title ).
     *
     */
    public function actualitesSearch(DashboardSearchActualiteRequest $request)
    {
        $query = $request->input('query');
        $isPaginator = $request->input('isPaginator') ?: 10;

        $actualites = Actualite::query();

        // Filter actualites by title if query is provided
        if ($query) {
            $actualites->where('title', 'LIKE', '%' . $query . '%')->orderBy('created_at', 'desc');
        } else {
            // If query is empty, return an empty result set
            $actualites->whereRaw('1=0');
        }

        return new ActualiteResource($actualites->with('media','category','user','tags')->paginate($isPaginator));
    }

    /**
    * Retrieve Opportunites based on the provided query (title ).
     *
     */
    public function opportunitesSearch(DashboardSearchOpportuniteRequest $request)
    {
        $query = $request->input('query');
        $isPaginator = $request->input('isPaginator') ?: 10;

        $opportunites = Opportunite::query();

        // Filter opportunité by title if query is provided
        if ($query) {
            $opportunites->where('title', 'LIKE', '%' . $query . '%')->orderBy('created_at', 'desc');
        } else {
            // If query is empty, return an empty result set
            $opportunites->whereRaw('1=0');
        }

        return new OpportunityResource($opportunites->with('media','category','user','tags')->paginate($isPaginator));
    }

    /**
    * Retrieve Rapport based on the provided query (title ).
     *
     */
    public function rapportsSearch(DashboardSearchRapportRequest $request)
    {
        $query = $request->input('query');
        $isPaginator = $request->input('isPaginator') ?: 10;

        $rapports = Rapport::query();

        // Filter rapport by title if query is provided
        if ($query) {
            $rapports->where('title', 'LIKE', '%' . $query . '%')->orderBy('created_at', 'desc');
        } else {
            // If query is empty, return an empty result set
            $rapports->whereRaw('1=0');
        }

        return new RapportResource($rapports->with('media','category','user','tags')->paginate($isPaginator));
    }

    /**
    * Retrieve Startup based on the provided query (title ).
     *
     */
    public function startupsSearch(DashboardSearchStartupRequest $request)
    {
        $query = $request->input('query');
        $isPaginator = $request->input('isPaginator') ?: 10;

        $startups = Startup::query();

        // Filter startup by name and description if query is provided
        if ($query) {
            $startups->where('name', 'LIKE', '%' . $query . '%')->orWhere('description', 'LIKE', '%' . $query . '%')->orderBy('created_at', 'desc');
        } else {
            // If query is empty, return an empty result set
            $startups->whereRaw('1=0');
        }

        return new StartupResource($startups->with('media','category','user','tags')->paginate($isPaginator));

    }

    /**
    * Retrieve Formation based on the provided query (title ).
     *
     */
    public function formationsSearch(DashboardSearchFormationRequest $request)
    {
        $query = $request->input('query');
        $isPaginator = $request->input('isPaginator') ?: 10;

        $formations = Formation::query();

        // Filter formation by title if query is provided
        if ($query) {
            $formations->where('title', 'LIKE', '%' . $query . '%')->orderBy('created_at', 'desc');
        } else {
            // If query is empty, return an empty result set
            $formations->whereRaw('1=0');
        }

        return new FormationResource($formations->with('media','category','user','tags')->paginate($isPaginator));
    }

    /**
    * Retrieve Ministere Agenda based on the provided query (title ).
     *
     */
    public function ministereAgendaSearch(DashboardSearchAgendaRequest $request)
    {
        $query = $request->input('query');
        $isPaginator = $request->input('isPaginator') ?: 10;

        $agendas = Agenda::query();

        // Filter aganda ministere by title and type ministere if query is provided
        if ($query) {
            $agendas->where('title', 'LIKE', '%' . $query . '%')->where('type', 'ministere')->orderBy('created_at', 'desc');
        } else {
            // If query is empty, return an empty result set
            $agendas->whereRaw('1=0');
        }

        return new AgendaResource($agendas->with('media','category','user','tags')->paginate($isPaginator));

    }

    /**
    * Retrieve Ministre Agenda based on the provided query (title ).
     *
     */
    public function ministreAgendaSearch(DashboardSearchAgendaRequest $request)
    {
        $query = $request->input('query');
        $isPaginator = $request->input('isPaginator') ?: 10;

        $agendas = Agenda::query();

        // Filter aganda ministre by title and type ministere if query is provided
        if ($query) {
            $agendas->where('title', 'LIKE', '%' . $query . '%')->where('type', 'ministre')->orderBy('created_at', 'desc');
        } else {
            // If query is empty, return an empty result set
            $agendas->whereRaw('1=0');
        }

        return new AgendaResource($agendas->with('media','category','user','tags')->paginate($isPaginator));



    }

    /**
    * Retrieve Acteurs based on the provided query (name or sigle ).
     *
     */
    public function acteursSearch(DashboardSearchActeurRequest $request)
    {
        $query = $request->input('query');
        $isPaginator = $request->input('isPaginator') ?: 10;

        $acteurs = Acteur::query();

        // Filter acteurs by title or sigle if query is provided
        if ($query) {
            $acteurs->where('name', 'LIKE', '%' . $query . '%')->orWhere('sigle', 'LIKE', '%' . $query . '%')->orderBy('created_at', 'desc');
        } else {
            // If query is empty, return an empty result set
            $acteurs->whereRaw('1=0');
        }

        return new ActeurResource($acteurs->with('media','user')->paginate($isPaginator));
    }

    /**
    * Retrieve Organisations based on the provided query (title ).
     *
     */
    public function organisationsSearch(DashboardSearchOrganisationRequest $request)
    {
        $query = $request->input('query');
        $isPaginator = $request->input('isPaginator') ?: 10;

        $organisations = Organisme::query();

        // Filter organisation by title if query is provided
        if ($query) {
            $organisations->where('title', 'LIKE', '%' . $query . '%')->orderBy('created_at', 'desc');
        } else {
            // If query is empty, return an empty result set
            $organisations->whereRaw('1=0');
        }

        return new OrganismeResource($organisations->with('media','user','tags')->paginate($isPaginator));

    }

    /**
    * Retrieve Reformes based on the provided query (title ).
     *
     */
    public function reformesSearch(DashboardSearchReformeRequest $request)
    {
        $query = $request->input('query');
        $isPaginator = $request->input('isPaginator') ?: 10;

        $reformes = Reforme::query();

        // Filter reformes by title if query is provided
        if ($query) {
            $reformes->where('title', 'LIKE', '%' . $query . '%')->orderBy('created_at', 'desc');
        } else {
            // If query is empty, return an empty result set
            $reformes->whereRaw('1=0');
        }

        return new ReformeResource($reformes->with('media','user','tags')->paginate($isPaginator));

    }

    /**
    * Retrieve Etat des lieux based on the provided query (title ).
     *
     */
    public function etatDesLieuxSearch(DashboardSearchEtatdeslieuRequest $request)
    {
        $query = $request->input('query');
        $isPaginator = $request->input('isPaginator') ?: 10;

        $etatDesLieux = EtatDesLieux::query();

        // Filter etat des lieux by title if query is provided
        if ($query) {
            $etatDesLieux->where('title', 'LIKE', '%' . $query . '%')->orderBy('created_at', 'desc');
        } else {
            // If query is empty, return an empty result set
            $etatDesLieux->whereRaw('1=0');
        }

        return new EtatDesLieuxResource($etatDesLieux->with('media','user')->paginate($isPaginator));

    }

    /**
     * Retrieve document based on the provided query (name ).
     *
     */
    public function documentsSearch(DashboardSearchDocumentRequest $request)
    {
        $query = $request->input('query');
        $isPaginator = $request->input('isPaginator') ?: 10;

        $documents = Document::query();

        // Filter documents by title if query is provided
        if ($query) {
            $documents->where('name', 'LIKE', '%' . $query . '%')->orderBy('created_at', 'desc');
        } else {
            // If query is empty, return an empty result set
            $documents->whereRaw('1=0');
        }

        return new DocumentResource($documents->with('media','category','user','tags')->paginate($isPaginator));

    }

    /**
     * Retrieve Directions based on the provided query (name or sigle).
     *
     */
    public function directionsSearch(DashboardSearchDirectionRequest $request)
    {
        $query = $request->input('query');
        $isPaginator = $request->input('isPaginator') ?: 10;

        $directions = Direction::query();

        // Filter directions by title if query is provided
        if ($query) {
            $directions->where('name', 'LIKE', '%' . $query . '%')->orWhere('sigle', 'LIKE', '%' . $query . '%')->orderBy('created_at', 'desc');
        } else {
            // If query is empty, return an empty result set
            $directions->whereRaw('1=0');
        }

        return new DirectionResource($directions->with('category','user')->paginate($isPaginator));
    }

    /**
     * Retrieve Entites based on the provided query (name or sigle).
     *
     */
    public function entitesSearch(DashboardSearchDirectionRequest $request)
    {

        $query = $request->input('query');
        $isPaginator = $request->input('isPaginator') ?: 10;

        $entites = Entite::query();

        // Filter directions by title if query is provided
        if ($query) {
            $entites->where('name', 'LIKE', '%' . $query . '%')->orWhere('sigle', 'LIKE', '%' . $query . '%')->orderBy('created_at', 'desc');
        } else {
            // If query is empty, return an empty result set
            $entites->whereRaw('1=0');
        }

        return new EntiteResource($entites->with('media','user')->paginate($isPaginator));

    }

    /**
     * Retrieve Ministre based on the provided query (firstname or lastname).
     *
     */
    public function ministresSearch(DashboardSearchMinistreRequest $request)
    {
        $query = $request->input('query');
        $isPaginator = $request->input('isPaginator') ?: 10;

        $ministres = Ministre::query();

        // Filter ministre by title if query is provided
        if ($query) {
            $ministres->where('firstname', 'LIKE', '%' . $query . '%')
                    ->orWhere('lastname', 'LIKE', '%' . $query . '%')->orderBy('created_at', 'desc');
        } else {
            // If query is empty, return an empty result set
            $ministres->whereRaw('1=0');
        }

        return new MinistreResource($ministres->with('media','user','agendas')->paginate($isPaginator));

    }

    /**
     * Retrieve users based on the provided query (firstname or lastname or phone).
     *
     */
    public function usersSearch(DashboardSearchUsersRequest $request)
    {
        $query = $request->input('query');
        $isPaginator = $request->input('isPaginator') ?: 10;

        $users = User::query();

        // Filter user by title if query is provided
        if ($query) {
            $users->where('firstname', 'LIKE', '%' . $query . '%')
                  ->orWhere('lastname', 'LIKE', '%' . $query . '%')
                  ->orWhere('phone', 'LIKE', '%' . $query . '%')->orderBy('created_at', 'desc');
        } else {
            // If query is empty, return an empty result set
            $users->whereRaw('1=0');
        }

        return new UserResource($users->with('media','roles')->paginate($isPaginator));

    }


    /**
     * Retrieve users based on the provided role.
     *
     */
    public function usersSearchByRole(DashboardSearchUsersRoleRequest $request)
    {
        $role = $request->input('query');
        $isPaginator = $request->input('isPaginator') ?: 10;

        $users = User::query();

        // Filter users by role if role is provided
        if ($role) {
            $users->whereHas('roles', function ($query) use ($role) {
                $query->where('title', 'LIKE', '%'.$role.'%');
            })->orderBy('created_at', 'desc');
        }else {
            // If role is empty, return an empty result set
            $users->whereRaw('1=0');
        }

        return new UserResource($users->with('media','roles')->paginate($isPaginator));

    }

    /**
     * Retrieve users based on the provided status.
     *
     */
    public function usersSearchByStatus(DashboardSearchUsersStatusRequest $request)
    {
        $status = $request->input('query');
        $isPaginator = $request->input('isPaginator') ?: 10;

        $users = User::query();

        // Filter user by title if query is provided
        if ($status) {
            $users->where('can_login', $status)->orderBy('created_at', 'desc');
        } else {
            // If query is empty, return an empty result set
            $users->whereRaw('1=0');
        }

        return new UserResource($users->with('media','roles')->paginate($isPaginator));
    }


    /**
     * Retrieve ecosysteme based on the provided query (title or description).
     *
     */
    public function ecosystemeSearch(DashboardSearchEcosystemeRequest $request)
    {
        $query = $request->input('query');
        $isPaginator = $request->input('isPaginator') ?: 10;

        $ecosystemes = Ecosysteme::query();

        // Filter user by title if query is provided
        if ($query) {
            $ecosystemes->where('title', 'LIKE', '%' . $query . '%')
                        ->orWhere('description', 'LIKE', '%' . $query . '%')->orderBy('created_at', 'desc');
        } else {
            // If query is empty, return an empty result set
            $ecosystemes->whereRaw('1=0');
        }

        return new EcosystemeResource($ecosystemes->with('category','user','tags')->paginate($isPaginator));
    }


    /**
     * Retrieve Sensibilisation based on the provided query (title or description).
     *
     */
    public function sensibilisationSearch(DashboardSearchSensibilisationRequest $request)
    {
        $query = $request->input('query');
        $isPaginator = $request->input('isPaginator') ?: 10;

        $sensibilisations = Sensibilisation::query();

        // Filter user by title if query is provided
        if ($query) {
            $sensibilisations->where('title', 'LIKE', '%' . $query . '%')
                            ->orWhere('description', 'LIKE', '%' . $query . '%')->orderBy('created_at', 'desc');
        } else {
            // If query is empty, return an empty result set
            $sensibilisations->whereRaw('1=0');
        }

        return new SensibilisationResource($sensibilisations->with('media','user')->paginate($isPaginator));
    }


    /**
     * Retrieve promotions based on the provided query (title or description).
     *
     */
    public function promotionSearch(DashboardSearchPromotionRequest $request)
    {
        $query = $request->input('query');
        $isPaginator = $request->input('isPaginator') ?: 10;

        $promotions = Promotion::query();

        // Filter user by title if query is provided
        if ($query) {
            $promotions->where('title', 'LIKE', '%' . $query . '%')
                            ->orWhere('description', 'LIKE', '%' . $query . '%')->orderBy('created_at', 'desc');
        } else {
            // If query is empty, return an empty result set
            $promotions->whereRaw('1=0');
        }

        return new PromotionResource($promotions->with('media','user')->paginate($isPaginator));
    }


    /**
     * Retrieve category actualitie based on the provided query (name or description).
     *
     */
    public function categoryActualitySearch(SearchCategoryActualiteRequest $request)
    {
        $query = $request->input('query');
        $isPaginator = $request->input('isPaginator') ?: 10;

        $categories = CategoryActualite::query();

        // Filter user by name if query is provided
        if ($query) {
            $categories->where('name', 'LIKE', '%' . $query . '%')
                            ->orWhere('description', 'LIKE', '%' . $query . '%')->orderBy('created_at', 'desc');
        } else {
            // If query is empty, return an empty result set
            $categories->whereRaw('1=0');
        }

        return new CategoryActualiteResource($categories->with('user','actualites')->paginate($isPaginator));
    }

    /**
     * Retrieve category agenda based on the provided query (name or description).
     *
     */
    public function categoryAgendaSearch(SearchCategoryAgendaRequest $request)
    {
        $query = $request->input('query');
        $isPaginator = $request->input('isPaginator') ?: 10;

        $categories = CategoryAgenda::query();

        // Filter user by name if query is provided
        if ($query) {
            $categories->where('name', 'LIKE', '%' . $query . '%')
                            ->orWhere('description', 'LIKE', '%' . $query . '%')->orderBy('created_at', 'desc');
        } else {
            // If query is empty, return an empty result set
            $categories->whereRaw('1=0');
        }

        return new CategoryAgendaResource($categories->with('user','agendas')->paginate($isPaginator));
    }


    /**
     * Retrieve category direction based on the provided query (name or description).
     *
     */
    public function categoryDirectionSearch(SearchCategoryDirectionRequest $request)
    {
        $query = $request->input('query');
        $isPaginator = $request->input('isPaginator') ?: 10;

        $categories = CategoryDirection::query();

        // Filter user by name if query is provided
        if ($query) {
            $categories->where('name', 'LIKE', '%' . $query . '%')
                            ->orWhere('description', 'LIKE', '%' . $query . '%')->orderBy('created_at', 'desc');
        } else {
            // If query is empty, return an empty result set
            $categories->whereRaw('1=0');
        }

        return new CategoryDirectionResource($categories->with('user','directions')->paginate($isPaginator));
    }

    /**
     * Retrieve category document based on the provided query (name or description).
     *
     */
    public function categoryDocumentSearch(SearchCategoryDocumentRequest $request)
    {
        $query = $request->input('query');
        $isPaginator = $request->input('isPaginator') ?: 10;

        $categories = CategoryDocument::query();

        // Filter user by name if query is provided
        if ($query) {
            $categories->where('name', 'LIKE', '%' . $query . '%')
                            ->orWhere('description', 'LIKE', '%' . $query . '%')->orderBy('created_at', 'desc');
        } else {
            // If query is empty, return an empty result set
            $categories->whereRaw('1=0');
        }

        return new CategoryDocumentResource($categories->with('user','documents')->paginate($isPaginator));
    }

    /**
     * Retrieve category ecosysteme based on the provided query (name or description).
     *
     */
    public function categoryEcosystemeSearch(SearchCategoryEcosystemeRequest $request)
    {
        $query = $request->input('query');
        $isPaginator = $request->input('isPaginator') ?: 10;

        $categories = CategoryEcosysteme::query();

        // Filter user by name if query is provided
        if ($query) {
            $categories->where('name', 'LIKE', '%' . $query . '%')
                            ->orWhere('description', 'LIKE', '%' . $query . '%')->orderBy('created_at', 'desc');
        } else {
            // If query is empty, return an empty result set
            $categories->whereRaw('1=0');
        }

        return new CategoryEcosystemeResource($categories->with('user','ecosystemes')->paginate($isPaginator));
    }


    /**
     * Retrieve category formation based on the provided query (name or description).
     *
     */
    public function categoryFormationSearch(SearchCategoryFormationRequest $request)
    {
        $query = $request->input('query');
        $isPaginator = $request->input('isPaginator') ?: 10;

        $categories = CategoryFormation::query();

        // Filter user by name if query is provided
        if ($query) {
            $categories->where('name', 'LIKE', '%' . $query . '%')
                            ->orWhere('description', 'LIKE', '%' . $query . '%')->orderBy('created_at', 'desc');
        } else {
            // If query is empty, return an empty result set
            $categories->whereRaw('1=0');
        }

        return new CategoryFormationResource($categories->with('user','formations')->paginate($isPaginator));
    }

    /**
     * Retrieve category opportunity based on the provided query (name or description).
     *
     */
    public function categoryOpportunitySearch(SearchCategoryOpportunityRequest $request)
    {
        $query = $request->input('query');
        $isPaginator = $request->input('isPaginator') ?: 10;

        $categories = CategoryOpportunity::query();

        // Filter user by name if query is provided
        if ($query) {
            $categories->where('name', 'LIKE', '%' . $query . '%')
                            ->orWhere('description', 'LIKE', '%' . $query . '%')->orderBy('created_at', 'desc');
        } else {
            // If query is empty, return an empty result set
            $categories->whereRaw('1=0');
        }

        return new CategoryOpportunityResource($categories->with('user','opportunites')->paginate($isPaginator));
    }

    /**
     * Retrieve category projet based on the provided query (name or description).
     *
     */
    public function categoryProjetSearch(SearchCategoryProjetRequest $request)
    {
        $query = $request->input('query');
        $isPaginator = $request->input('isPaginator') ?: 10;

        $categories = CategoryProjet::query();

        // Filter user by name if query is provided
        if ($query) {
            $categories->where('name', 'LIKE', '%' . $query . '%')
                            ->orWhere('description', 'LIKE', '%' . $query . '%')->orderBy('created_at', 'desc');
        } else {
            // If query is empty, return an empty result set
            $categories->whereRaw('1=0');
        }

        return new CategoryProjetResource($categories->with('user','projets')->paginate($isPaginator));
    }

    /**
     * Retrieve category rapport based on the provided query (name or description).
     *
     */
    public function categoryRapportSearch(SearchCategoryRapportRequest $request)
    {
        $query = $request->input('query');
        $isPaginator = $request->input('isPaginator') ?: 10;

        $categories = CategoryRapport::query();

        // Filter user by name if query is provided
        if ($query) {
            $categories->where('name', 'LIKE', '%' . $query . '%')
                            ->orWhere('description', 'LIKE', '%' . $query . '%')->orderBy('created_at', 'desc');
        } else {
            // If query is empty, return an empty result set
            $categories->whereRaw('1=0');
        }

        return new CategoryRapportResource($categories->with('user','rapports')->paginate($isPaginator));
    }

    /**
     * Retrieve category startup based on the provided query (name or description).
     *
     */
    public function categoryStartupSearch(SearchCategoryStartupRequest $request)
    {
        $query = $request->input('query');
        $isPaginator = $request->input('isPaginator') ?: 10;

        $categories = CategoryStartup::query();

        // Filter user by name if query is provided
        if ($query) {
            $categories->where('name', 'LIKE', '%' . $query . '%')
                            ->orWhere('description', 'LIKE', '%' . $query . '%')->orderBy('created_at', 'desc');
        } else {
            // If query is empty, return an empty result set
            $categories->whereRaw('1=0');
        }

        return new CategoryStartupResource($categories->with('user','startups')->paginate($isPaginator));
    }


    /**
     * Retrieve tag based on the provided query (title and description).
     *
     */
    public function tagSearch(SearchTagsRequest $request)
    {
        $query = $request->input('query');
        $isPaginator = $request->input('isPaginator') ?: 10;

        $tags = Tag::query();

        // Filter user by title or description if query is provided
        if ($query) {
            $tags->where('title', 'LIKE', '%' . $query . '%')
                            ->orWhere('description', 'LIKE', '%' . $query . '%')->orderBy('created_at', 'desc');
        } else {
            // If query is empty, return an empty result set
            $tags->whereRaw('1=0');
        }

        return new TagResource($tags->with('user')->paginate($isPaginator));
    }

    /**
     * Retrieve permission based on the provided query (title and description).
     *
     */
    public function permisionSearch(SearchPermissionsRequest $request)
    {
        $query = $request->input('query');
        $isPaginator = $request->input('isPaginator') ?: 10;

        $permissions = Permission::query();

        // Filter user by title or description if query is provided
        if ($query) {
            $permissions->where('title', 'LIKE', '%' . $query . '%')
                            ->orWhere('description', 'LIKE', '%' . $query . '%')->orderBy('created_at', 'desc');
        } else {
            // If query is empty, return an empty result set
            $permissions->whereRaw('1=0');
        }

        return new PermissionRessource($permissions->paginate($isPaginator));
    }

    /**
     * Retrieve role based on the provided query (title).
     *
     */
    public function roleSearch(SearchRolesRequest $request)
    {
        $query = $request->input('query');
        $isPaginator = $request->input('isPaginator') ?: 10;

        $roles = Role::query();

        // Filter user by title if query is provided
        if ($query) {
            $roles->where('title', 'LIKE', '%' . $query . '%')->orderBy('created_at', 'desc');
        } else {
            // If query is empty, return an empty result set
            $roles->whereRaw('1=0');
        }

        return new RoleResource($roles->with('users','permissions')->paginate($isPaginator));
    }

}
