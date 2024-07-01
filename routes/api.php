<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryReformesController;
use App\Http\Controllers\Api\V1\Admin\TagApiController;
use App\Http\Controllers\Api\V1\Admin\AuthApiController;
use App\Http\Controllers\Api\V1\Admin\RoleApiController;
use App\Http\Controllers\Api\V1\Admin\StartupController;
use App\Http\Controllers\Api\V1\Admin\UserApiController;
use App\Http\Controllers\Api\V1\Admin\AboutApiController;
use App\Http\Controllers\Api\V1\Admin\DocumentController;
use App\Http\Controllers\Api\V1\Admin\ExportApiController;
use App\Http\Controllers\Api\V1\Admin\FormationController;
use App\Http\Controllers\Api\V1\Admin\PromotionController;
use App\Http\Controllers\Api\V1\Admin\SearchApiController;
use App\Http\Controllers\Api\V1\Admin\ActeursApiController;
use App\Http\Controllers\Api\V1\Admin\AdresseApiController;
use App\Http\Controllers\Api\V1\Admin\AgendasApiController;
use App\Http\Controllers\Api\V1\Admin\ContactApiController;
use App\Http\Controllers\Api\V1\Admin\EntitesApiController;
use App\Http\Controllers\Api\V1\Admin\ProjetsApiController;
use App\Http\Controllers\Api\V1\Admin\RapportApiController;
use App\Http\Controllers\Api\V1\Admin\ReformeApiController;
use App\Http\Controllers\Api\V1\Admin\MinistreApiController;
use App\Http\Controllers\Api\V1\Admin\OpportuniteController;
use App\Http\Controllers\Api\V1\Admin\PasswordApiController;
use App\Http\Controllers\Api\V1\Admin\SecteursApiController;
use App\Http\Controllers\Api\V1\Admin\DirectionApiController;
use App\Http\Controllers\Api\V1\Admin\EtatDesLieuxController;
use App\Http\Controllers\Api\V1\Admin\OrganismeApiController;
use App\Http\Controllers\Api\V1\Admin\ActualitesApiController;
use App\Http\Controllers\Api\V1\Admin\EcosystemeApiController;
use App\Http\Controllers\Api\V1\Admin\NewsletterApiController;
use App\Http\Controllers\Api\V1\Admin\PermissionApiController;
use App\Http\Controllers\Api\V1\Admin\PlateformeApiController;
use App\Http\Controllers\Api\V1\Admin\CategoryAgendaController;
use App\Http\Controllers\Api\V1\Admin\CategoryProjetController;
use App\Http\Controllers\Api\V1\Admin\StatistiqueApiController;
use App\Http\Controllers\Api\V1\Admin\CategoryStartupController;
use App\Http\Controllers\Api\V1\Admin\SensibilisationController;
use App\Http\Controllers\Api\V1\Admin\CategoryDocumentController;
use App\Http\Controllers\Api\V1\Admin\TwoFactorAuthApiController;
use App\Http\Controllers\Api\V1\Admin\CategoryFormationController;
use App\Http\Controllers\Api\V1\Admin\CategoryRapportApiController;
use App\Http\Controllers\Api\V1\Admin\CategoryActualiteApiController;
use App\Http\Controllers\Api\V1\Admin\CategoryDirectionApiController;
use App\Http\Controllers\Api\V1\Admin\CategoryEcosystemeApiController;
use App\Http\Controllers\Api\V1\Admin\CategoryOpportunitiesController;
use App\Http\Controllers\Api\V1\Admin\SearhDashboardApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'auth', 'middleware' => ['throtlelogin','can_login']], function () {
    Route::post('login', [AuthApiController::class, 'login'])->name('auth.login');

    Route::post('password/emails',  [PasswordApiController::class, 'forgotpassword']);
    Route::post('password/code/checks',  [PasswordApiController::class, 'checkcode']);
    Route::post('password/resets',  [PasswordApiController::class, 'changepassword']);
    Route::post('two-factor/code/checks',  [TwoFactorAuthApiController::class, 'checkcode']);


    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('logout', [AuthApiController::class, 'logout'])->name('auth.logout');
    });
});

Route::group(['prefix' => 'v1', 'as' => 'api.', 'middleware' => [
    'auth:sanctum','can_login','check_code'
]], function () {

    //ROUTE FOR  RESSOURCES

    Route::apiResource('permissions', PermissionApiController::class);
    Route::apiResource('roles', RoleApiController::class)->except('update');
    Route::post('roles/{role}', [RoleApiController::class, 'update']);
    Route::apiResource('users', UserApiController::class)->except('update');
    Route::post('users/{user}', [UserApiController::class, 'update']);

    Route::apiResource('adresse', AdresseApiController::class);
    Route::apiResource('contact', ContactApiController::class)->except('store');
    //ROUTE FOR ACTIVATION AND DESACTIVTION TWO FACTOR AUTENTIFICATION
    Route::post('toggletwofactor', [TwoFactorAuthApiController::class, 'toggleTwoFactor']);


    Route::post('users/block/{user}', [UserApiController::class, 'toggleblockAccount']);

    Route::apiResource('ministre', MinistreApiController::class)->except('update');
    Route::post('ministre/{ministre}',[MinistreApiController::class, 'update']);

    Route::apiResource('organisme', OrganismeApiController::class)->except('update');
    Route::post('organisme/{organisme}',[OrganismeApiController::class, 'update']);


    Route::apiResource('direction', DirectionApiController::class);

    Route::apiResource('agenda', AgendasApiController::class)->except('update');
    Route::post('agenda/{agenda}',[AgendasApiController::class, 'update']);


    Route::apiResource('tags', TagApiController::class);
    Route::apiResource('ecosysteme', EcosystemeApiController::class);
    Route::apiResource('acteur', ActeursApiController::class)->except('update');
    Route::post('acteur/{acteur}',[ActeursApiController::class, 'update']);

    Route::apiResource('projet', ProjetsApiController::class)->except('update');
    Route::post('projet/{projet}', [ProjetsApiController::class, 'update']);


    Route::apiResource('document', DocumentController::class)->except('update');
    Route::post('document/{document}', [DocumentController::class, 'update']);

    Route::apiResource('reforme', ReformeApiController::class)->except('update');
    Route::post('reforme/{reforme}', [ReformeApiController::class, 'update']);

    Route::apiResource('plateforme', PlateformeApiController::class)->except('update');
    Route::post('plateforme/{plateforme}', [PlateformeApiController::class, 'update']);

    Route::apiResource('about', AboutApiController::class);

    // actualites
    Route::apiResource('actualites', ActualitesApiController::class)->except('update');
    Route::post('actualites/{actualite}', [ActualitesApiController::class,'update'])->name('update.actualite');

    // opportunite
    Route::apiResource('opportunites', OpportuniteController::class)->except('update');
    Route::post('opportunites/{opportunite}', [OpportuniteController::class,'update'])->name('update.opportunite');

    // entites
    Route::apiResource('entites', EntitesApiController::class)->except('update');
    Route::post('entites/{entite}', [EntitesApiController::class,'update'])->name('update.entite');

    //Route::apiResource('secteur', SecteursApiController::class);

    //Update rapport
    Route::apiResource('rapports', RapportApiController::class)->except('update');
    Route::post('rapports/{rapport}', [RapportApiController::class,'update'])->name('update.rapport');

    // startup
    Route::apiResource('startups', StartupController::class)->except('update');
    Route::post('startups/{startup}', [StartupController::class,'update'])->name('update.startup');

    // formation
    Route::apiResource('formations', FormationController::class)->except('update');
    Route::post('formations/{formation}', [FormationController::class,'update'])->name('update.formation');

    // promotion
    Route::apiResource('promotions', PromotionController::class)->except('update');
    Route::post('promotions/{promotion}', [PromotionController::class,'update'])->name('update.promotion');

    // sensibilisation
    Route::apiResource('sensibilisations', SensibilisationController::class)->except('update');
    Route::post('sensibilisations/{sensibilisation}', [SensibilisationController::class,'update'])->name('update.sensibilisation');

    // etats-des-lieux
    Route::apiResource('etats-des-lieux', EtatDesLieuxController::class)->except('update');
    Route::post('etats-des-lieux/{etats_des_lieux}', [EtatDesLieuxController::class,'update'])->name('update.etatDesLieux');



    Route::get('newsletter/listes', [NewsletterApiController::class, 'index']);

    Route::apiResource('category-projets', CategoryProjetController::class);
    Route::apiResource('category-documents', CategoryDocumentController::class);
    Route::apiResource('category-opportunities', CategoryOpportunitiesController::class);
    Route::apiResource('category-actualites', CategoryActualiteApiController::class);
    Route::apiResource('category-rapports', CategoryRapportApiController::class);
    //Route::apiResource('category-reformes', CategoryReformesController::class);
    Route::apiResource('category-ecosysteme', CategoryEcosystemeApiController::class);
    Route::apiResource('category-agendas', CategoryAgendaController::class);
    Route::apiResource('category-startups', CategoryStartupController::class);
    Route::apiResource('category-formations', CategoryFormationController::class);
    Route::apiResource('category-direction', CategoryDirectionApiController::class);

    Route::get('export', [ExportApiController::class, 'search']);
    Route::get('stats', [StatistiqueApiController::class, 'getStats']);



    // Resource search for admin dashbord
    Route::post('dashboard-search-acteurs', [SearhDashboardApiController::class, 'acteursSearch'])->name('dashboard.search.acteurs');
    Route::post('dashboard-search-reformes', [SearhDashboardApiController::class, 'reformesSearch'])->name('dashboard.search.reformes');
    Route::post('dashboard-search-agendas-ministere', [SearhDashboardApiController::class, 'ministereAgendaSearch'])->name('dashboard.search.agenda.ministere');
    Route::post('dashboard-search-agendas-ministre', [SearhDashboardApiController::class, 'ministreAgendaSearch'])->name('dashboard.search.agenda.ministre');
    Route::post('dashboard-search-actualites', [SearhDashboardApiController::class, 'actualitesSearch'])->name('dashboard.search.actualites');
    Route::post('dashboard-search-rapports', [SearhDashboardApiController::class, 'rapportsSearch'])->name('dashboard.search.rapports');
    Route::post('dashboard-search-opportunites', [SearhDashboardApiController::class, 'opportunitesSearch'])->name('dashboard.search.opportunites');
    Route::post('dashboard-search-startups', [SearhDashboardApiController::class, 'startupsSearch'])->name('dashboard.search.startup');
    Route::post('dashboard-search-formations', [SearhDashboardApiController::class, 'formationsSearch'])->name('dashboard.search.formation');
    Route::post('dashboard-search-etats-des-lieux', [SearhDashboardApiController::class, 'etatDesLieuxSearch'])->name('dashboard.search.etatDesLieux');
    Route::post('dashboard-search-organisations', [SearhDashboardApiController::class, 'organisationsSearch'])->name('dashboard.search.organisations');
    Route::post('dashboard-search-entites', [SearhDashboardApiController::class, 'entitesSearch'])->name('dashboard.search.entites');
    Route::post('dashboard-search-documents', [SearhDashboardApiController::class, 'documentsSearch'])->name('dashboard.search.documents');
    Route::post('dashboard-search-directions', [SearhDashboardApiController::class, 'directionsSearch'])->name('dashboard.search.directions');
    Route::post('dashboard-search-ministres', [SearhDashboardApiController::class, 'ministresSearch'])->name('dashboard.search.ministres');
    Route::post('dashboard-search-users', [SearhDashboardApiController::class, 'usersSearch'])->name('dashboard.search.users');
    Route::post('dashboard-search-users-by-role', [SearhDashboardApiController::class, 'usersSearchByRole'])->name('dashboard.search.users.by.role');
    Route::post('dashboard-search-users-by-status', [SearhDashboardApiController::class, 'usersSearchByStatus'])->name('dashboard.search.users.by.status');
    Route::post('dashboard-search-ecosystemes', [SearhDashboardApiController::class, 'ecosystemeSearch'])->name('dashboard.search.ecosystemes');
    Route::post('dashboard-search-sensibilisations', [SearhDashboardApiController::class, 'sensibilisationSearch'])->name('dashboard.search.sensibilisations');
    Route::post('dashboard-search-promotions', [SearhDashboardApiController::class, 'promotionSearch'])->name('dashboard.search.promotions');


     // Category search for admin dashbord
     Route::post('search-actualites-category', [SearhDashboardApiController::class, 'categoryActualitySearch'])->name('search.actualites.category');
     Route::post('search-agendas-category', [SearhDashboardApiController::class, 'categoryAgendaSearch'])->name('search.agendas.category');
     Route::post('search-directions-category', [SearhDashboardApiController::class, 'categoryDirectionSearch'])->name('search.directions.category');
     Route::post('search-documents-category', [SearhDashboardApiController::class, 'categoryDocumentSearch'])->name('search.documents.category');
     Route::post('search-ecosystemes-category', [SearhDashboardApiController::class, 'categoryEcosystemeSearch'])->name('search.ecosystemes.category');
     Route::post('search-formations-category', [SearhDashboardApiController::class, 'categoryFormationSearch'])->name('search.formations.category');
     Route::post('search-opportunities-category', [SearhDashboardApiController::class, 'categoryOpportunitySearch'])->name('search.opportunities.category');
     Route::post('search-projets-category', [SearhDashboardApiController::class, 'categoryProjetSearch'])->name('search.projets.category');
     Route::post('search-rapports-category', [SearhDashboardApiController::class, 'categoryRapportSearch'])->name('search.rapports.category');
    //  Route::post('search-reformes-category', [SearhDashboardApiController::class, 'categoryReformeSearch'])->name('search.reformes.category');
     Route::post('search-startups-category', [SearhDashboardApiController::class, 'categoryStartupSearch'])->name('search.startups.category');
     Route::post('search-tags', [SearhDashboardApiController::class, 'tagSearch'])->name('search.tags');
     Route::post('search-permissions', [SearhDashboardApiController::class, 'permisionSearch'])->name('search.permissions');
     Route::post('search-roles', [SearhDashboardApiController::class, 'roleSearch'])->name('search.roles');

    Route::post('password/update', [PasswordApiController::class, 'updateUserpassword']);


});


Route::group([
    'prefix' => 'v1',
    'as' => 'api.'
], function () {

    //Acteurs routes for front interface
    Route::get('acteurs/listes', [ActeursApiController::class,'findlatest'])->name('listes.acteur');
    Route::get('acteurs-detail/{acteur:slug}', [ActeursApiController::class,'acteurDetail'])->name('detail.acteur');

    Route::post('contact', [ContactApiController::class,'store']);

    // Address route for front interface
    Route::get('adresses/findlatest', [AdresseApiController::class,'findlatest'])->name('last.adresse');

    // agendas route for front interface

    // direction route for front interface
    Route::get('directions/listes', [DirectionApiController::class,'findliste'])->name('listes.direction');
    Route::get('directions/details/{direction:slug}', [DirectionApiController::class,'directiondetail'])->name('direction.details');

    //Route::get('directions-detail/{direction}', [DirectionApiController::class,'directionDetail'])->name('detail.direction');
    //Route::get('cadre-juridiques/findlatest', [JuridiqueApiController::class,'findlatest']);
    //Route::get('cadre-juridiques-detail/{juridique}', [JuridiqueApiController::class,'cadreJuridiqueDetail'])->name('detail.cadre.juridique');

    Route::get('ecosystemes-du-tchad', [EcosystemeApiController::class,'findlatest'])->name('last.ecosysteme.tchad');
    Route::put('documents-count-download/{document:slug}', [DocumentController::class, 'download'])->name('documents.count.dowload');
    Route::put('documents-count-read/{document:slug}', [DocumentController::class, 'read'])->name('documents.count.read');
    Route::get('documents-liste', [DocumentController::class, 'documentliste'])->name('documents.liste');

    Route::get('plateformes-list', [PlateformeApiController::class, 'displayList'])->name('plateformes.list');
    Route::get('organisations-fonctionnements', [OrganismeApiController::class, 'displayListe'])->name('organismes.list');

    // organisationsSearch
    Route::get('reformes-listes', [ReformeApiController::class, 'displayListeReforme'])->name('reformes.listes');
    Route::get('reformes-details/{reforme:slug}', [ReformeApiController::class, 'displayReformeDetails'])->name('reformes.details');

    Route::get('ministres/archives', [MinistreApiController::class, 'archives'])->name('ministre.archives');
    Route::get('mot-biographie-ministre', [MinistreApiController::class, 'ministre'])->name('ministre.biographie.mot');
    // Route::get('agendas/ministere-latest', [AgendasApiController::class, 'ministereagendas'])->name('agenda.ministere.latest');


    Route::get('organigrame', [DirectionApiController::class, 'organigrame'])->name('organigrame');
    Route::get('about', [AboutApiController::class, 'about'])->name('about');
    Route::get('document-juridiques-category', [CategoryDocumentController::class, 'getdocumentjuridiquescategory'])->name('cadre-juridique-intutitionel');
    Route::get('document-juridiques/{document:slug}', [CategoryDocumentController::class, 'getdocumentjuridiques'])->name('document.cadre.juridique');

    //Projets routes for front interface

    Route::get('projets-recent', [ProjetsApiController::class, 'projetrecent'])->name('projet.recent');
    Route::get('projet-category/{category:slug}', [ProjetsApiController::class, 'categoryprojet']);
    Route::get('projets-category', [CategoryProjetController::class, 'categoryprojet'])->name('projets.category');
    Route::get('projets-detail/{projet:slug}', [ProjetsApiController::class, 'displayProjetDetails'])->name('projets.detail');

    //Agenda ministere routes for front interface
    Route::get('agendas-ministere-listes', [AgendasApiController::class, 'ministereagendas'])->name('agenda.ministere.listes');
    Route::get('agendas-detail/{agenda:slug}', [AgendasApiController::class,'agendaDetail'])->name('detail.agenda');
    Route::get('agendas-ministres-listes', [AgendasApiController::class, 'ministreagenda'])->name('agenda.ministre.liste');

    // Actualities routes for front interface
    Route::get('actualites-listes', [ActualitesApiController::class,'findListes'])->name('listes.actualites');
    Route::get('actualites-home', [ActualitesApiController::class,'findThreeLatest'])->name('actualite.home');
    Route::get('actualites-slide-home', [ActualitesApiController::class,'findTwoLatest'])->name('actualite.slide.home');
    Route::get('actualites-detail/{actualite:slug}', [ActualitesApiController::class,'actualiteDetail'])->name('detail.actualites');

    //Rapports routes for front interface
    Route::get('rapports-listes', [RapportApiController::class, 'displayListesRapport'])->name('rapports.listes');
    Route::get('rapports-detail/{rapport:slug}', [RapportApiController::class, 'displayRapportDetail'])->name('rapports.detail');

    // Entites routes for front interface
    Route::get('entites-listes', [EntitesApiController::class, 'displayListeEntites'])->name('entites.liste');
    Route::get('entites-detail/{entite:slug}', [EntitesApiController::class, 'displayEntiteDetails'])->name('entites.detail');

    //Opportunities routes for front interface
    Route::get('opportunites-listes', [OpportuniteController::class, 'displayListesOpportunities'])->name('opportunites.listes');
    Route::get('opportunites-detail/{opportunite:slug}', [OpportuniteController::class, 'displayOpportuniteDetails'])->name('opportunites.detail');

    //Startups routes for front interface
    Route::get('startups-listes', [StartupController::class, 'displayListesStartup'])->name('startups.listes');
    Route::get('startups-detail/{startup:slug}', [StartupController::class, 'displayStartupDetail'])->name('startups.detail');

    // Formations routes for front interface
    Route::get('formations-listes', [FormationController::class, 'displayListesFormation'])->name('formations.listes');
    Route::get('formations-detail/{formation:slug}', [FormationController::class, 'displayFormationDetail'])->name('formations.detail');

    // Promotions routes for front interface
    Route::get('promotions-listes', [PromotionController::class, 'displayListesPromotion'])->name('promotions.listes');
    Route::get('promotions-detail/{promotion:slug}', [PromotionController::class, 'displayPromotionDetail'])->name('promotions.detail');

    // Sensibilisation routes for front interface
    Route::get('sensibilisations-listes', [SensibilisationController::class, 'displayListesSensibilisation'])->name('sensibilisations.listes');
    Route::get('sensibilisations-detail/{sensibilisation:slug}', [SensibilisationController::class, 'displaySensibilisationDetail'])->name('sensibilisations.detail');

    // Etat des lieux routes for front interface
    Route::get('etats-des-lieux-listes', [EtatDesLieuxController::class, 'displayListeEtatsDesLieux'])->name('etat.lieux.listes');
    Route::get('etats-des-lieux-detail/{etats_des_lieux:slug}', [EtatDesLieuxController::class, 'displayEtatDesLieuxDetails'])->name('etatDesLieux.detail');


    // Resource search for front
    Route::post('search-acteurs', [SearchApiController::class, 'acteursSearch'])->name('search.acteurs');
    Route::post('search-reformes', [SearchApiController::class, 'reformesSearch'])->name('search.reformes');
    Route::post('search-agendas-ministere', [SearchApiController::class, 'ministereAgendaSearch'])->name('search.agenda.ministere');
    Route::post('search-agendas-ministre', [SearchApiController::class, 'ministreAgendaSearch'])->name('search.agenda.ministre');
    Route::post('search-actualites', [SearchApiController::class, 'actualitesSearch'])->name('search.actualites');
    Route::post('search-rapports', [SearchApiController::class, 'rapportsSearch'])->name('search.rapports');
    Route::post('search-opportunites', [SearchApiController::class, 'opportunitesSearch'])->name('search.opportunites');
    Route::post('search-startups', [SearchApiController::class, 'startupsSearch'])->name('search.startup');
    Route::post('search-formations', [SearchApiController::class, 'formationsSearch'])->name('search.formation');
    Route::post('search-etats-des-lieux', [SearchApiController::class, 'etatDesLieuxSearch'])->name('search.etatDesLieux');
    Route::post('search-organisations', [SearchApiController::class, 'organisationsSearch'])->name('search.organisations');
    Route::post('search-entites', [SearchApiController::class, 'entitesSearch'])->name('search.entites');
    Route::post('search-documents', [SearchApiController::class, 'documentsSearch'])->name('search.documents');
    Route::post('search-directions', [SearchApiController::class, 'directionsSearch'])->name('search.directions');
    Route::post('search-ministres', [SearchApiController::class, 'ministresSearch'])->name('search.ministres');
    Route::post('search-ecosystemes', [SearchApiController::class, 'ecosystemeSearch'])->name('search.ecosystemes');
    Route::post('search-sensibilisations', [SearchApiController::class, 'sensibilisationSearch'])->name('search.sensibilisations');
    Route::post('search-promotions', [SearchApiController::class, 'promotionSearch'])->name('search.promotions');




});

Route::post('login', function ($id) {

})->name('login');

Route::post('newsletter/unsubscribe/{token}', [NewsletterApiController::class, 'unsubscribe']);
Route::post('newsletter/subscribe', [NewsletterApiController::class, 'store']);




