<?php

namespace App\Http\Controllers\Api\V1\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Acteur;
use App\Models\Agenda;
use App\Models\Entite;
use App\Models\Projet;
use App\Models\Contact;
use App\Models\Rapport;
use App\Models\Startup;
use App\Models\Document;
use App\Models\Ministre;
use App\Models\Actualite;
use App\Models\Direction;
use App\Models\Formation;
use App\Models\Organisme;
use App\Models\Promotion;
use App\Models\Ecosysteme;
use App\Models\Newsletter;
use App\Models\Plateforme;
use App\Models\Opportunite;
use App\Models\EtatDesLieux;
use Illuminate\Http\Request;
use App\Models\Sensibilisation;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExportRequest;

class ExportApiController extends Controller
{
    /**
     * Exportation des ressources.
     */
    public function search(ExportRequest $request)
    {

        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $format = 'd-m-Y';
        $start = $request->start_date;//Carbon::createFromFormat($format, $startDate)->format('Y-m-d');
        $end = $request->end_date;//Carbon::createFromFormat($format, $endDate)->format('Y-m-d');
        $model = $request->model;

        switch ($model) {
            case 'actualites':
                return $this->exportActualites($start, $end);
            case 'acteurs':
                return $this->exportActeurs($start, $end);
            case 'agendas':
                return $this->exportAgendas($start, $end);
            case 'contacts':
                return $this->exportContacts($start, $end);
            case 'directions':
                return $this->exportDirections($start, $end);
            case 'documents':
                return $this->exportDocuments($start, $end);
            case 'ecosystems':
                return $this->exportEcosystemes($start, $end);
            case 'entites':
                return $this->exportEntites($start, $end);
            case 'etats':
                return $this->exportEtats($start, $end);
            case 'formations':
                return $this->exportFormations($start, $end);
            case 'ministres':
                return $this->exportMinistres($start, $end);
            case 'newsletters':
                return $this->exportNewsletter($start, $end);
            case 'opportunities':
                return $this->exportOpportunites($start, $end);
            case 'organismes':
                return $this->exportOrganisme($start, $end);
            case 'plateformes':
                return $this->exportPlateformes($start, $end);
            case 'projets':
                return $this->exportProjets($start, $end);
            case 'promotions':
                return $this->exportPromotions($start, $end);
            case 'rapports':
                return $this->exportRapports($start, $end);
            case 'sensibilisations':
                return $this->exportSensibilisations($start, $end);
            case 'startups':
                return $this->exportStartups($start, $end);
            case 'users':
                return $this->exportUsers($start, $end);
            default:
                return response()->json(['error' => 'Modèle non pris en charge'], 400);
        }
    }

    private function exportActualites($start, $end)
    {
        $actualites = Actualite::whereBetween('created_at', [$start, $end])->get();
        if($actualites->isNotEmpty()){
            return response()->json(['data' => $actualites->load('category', 'user', 'media', 'tags')], 200);
        }

        return response()->json(['message' =>'no data']);
       
    }

    private function exportActeurs($start, $end)
    {
        $acteurs = Acteur::whereBetween('created_at', [$start, $end])->get();
        if($acteurs->isNotEmpty()){
            return response()->json(['data' => $acteurs], 200);
        } 

        return response()->json(['message' => 'no data']);
    }

    private function exportAgendas($start, $end)
    {
        $agendas = Agenda::whereBetween('created_at', [$start, $end])->get();
        if($agendas->isNotEmpty()){
          return response()->json(['data' => $agendas->load('category','ministre')],200);  
        } 
        return response()->json(['message' => 'no data']);
    }

    private function exportContacts($start, $end)
    {
        $contacts = Contact::whereBetween('created_at', [$start, $end])->get();
        if($contacts->isNotEmpty()){
          return response()->json(['data'=>$contacts],200);  
        } 
        return response()->json(['message' => 'no data']);
    }

    private function exportDirections($start, $end)
    {
        $directions = Direction::whereBetween('created_at', [$start, $end])->get();
        if($directions->isNotEmpty()){
          return response()->json(['data'=>$directions->load('category')],200);  
        } 
        return response()->json(['message' => 'no data']);
    }

    private function exportDocuments($start, $end)
    {
        $documents = Document::whereBetween('created_at', [$start, $end])->get();

        if($documents->isNotEmpty()){
          return response()->json(['data'=>$documents->load('category')],200);  
        } 
        return response()->json(['message' => 'no data']);
    }

    private function exportEcosystemes($start, $end)
    {
        $ecosystemes = Ecosysteme::whereBetween('created_at', [$start, $end])->get();
       if($ecosystemes->isNotEmpty()){
        return response()->json(['data'=>$ecosystemes->load('category')],200);
       } 
        return response()->json(['message' => 'no data']);
    }

    private function exportEntites($start, $end)
    {
        $entites = Entite::whereBetween('created_at', [$start, $end])->get();
        if($entites->isNotEmpty()){
          return response()->json(['data'=>$entites->load('category')],200);  
        } 
        return response()->json(['message' => 'no data']);
    }

    private function exportFormations($start, $end)
    {
        $formations = Formation::whereBetween('created_at', [$start, $end])->get();
        if($formations->isNotEmpty()){
          return response()->json(['data'=>$formations->load('category')],200);  
        } 
        return response()->json(['message' => 'no data']);
    }

    private function exportEtats($start, $end)
    {
        $etats = EtatDesLieux::whereBetween('created_at', [$start, $end])->get();
        if($etats->isNotEmpty()){
          return response()->json(['data'=>$etats],200);  
        } 
        return response()->json(['message' => 'no data']);
    }

    private function exportMinistres($start, $end)
    {
        $ministres = Ministre::whereBetween('created_at', [$start, $end])->get();
        if($ministres->isNotEmpty()){
            return response()->json(['data'=>$ministres],200);
        } 
        return response()->json(['message' => 'no data']);
    }

    private function exportNewsletter($start, $end)
    {
        $newsletters = Newsletter::whereBetween('created_at', [$start, $end])->get();
        if($newsletters->isNotEmpty()){
            return response()->json(['data'=>$newsletters],200);
        } 
        return response()->json(['message' => 'no data']);
    }

    private function exportOpportunites($start, $end)
    {
        $opportunites = Opportunite::whereBetween('created_at', [$start, $end])->get();
        if($opportunites->isNotEmpty()){
          return response()->json(['data'=> $opportunites->load('category')]);  
        } 
        return response()->json(['message' => 'no data']);
    }

    private function exportOrganisme($start, $end)
    {
        $organismes = Organisme::whereBetween('created_at', [$start, $end])->get();
        if($organismes->isNotEmpty()){
            return response()->json(['data'=> $organismes],200);
        } 
        return response()->json(['message' => 'no data']);
    }

    private function exportPlateformes($start, $end)
    {
        $plateformes = Plateforme::whereBetween('created_at', [$start, $end])->get();
        if($plateformes->isNotEmpty()){
          return response()->json(['data'=> $plateformes],200);  
        } 
        return response()->json(['message' => 'no data']);
    }

    private function exportProjets($start, $end)
    {
        $projets = Projet::whereBetween('created_at', [$start, $end])->get();
        if($projets->isNotEmpty()){
          return response()->json(['data'=> $projets->load('category')],200);  
        } 
        return response()->json(['message' => 'no data']);
    }

    private function exportPromotions($start, $end)
    {
        $promotions = Promotion::whereBetween('created_at', [$start, $end])->get();
        if($promotions->isNotEmpty()){
            return response()->json(['data'=> $promotions],200);
        } 
        return response()->json(['message' => 'no data']);
    }

    private function exportRapports($start, $end)
    {
        $rapports = Rapport::whereBetween('created_at', [$start, $end])->get();
        if($rapports->isNotEmpty()){
          return response()->json(['data'=> $rapports->load('category')]);  
        } 
        return response()->json(['message' => 'no data']);
    }

    private function exportSensibilisations($start, $end)
    {
        $sensibilisations = Sensibilisation::whereBetween('created_at', [$start, $end])->get();
       if($sensibilisations->isNotEmpty()){
        return response()->json(['data'=> $sensibilisations],200);
       } 
        return response()->json(['message' => 'no data']);
    }

    private function exportStartups($start, $end)
    {
        $startups = Startup::whereBetween('created_at', [$start, $end])->get();
       if($startups->isNotEmpty()){
        return response()->json(['data'=> $startups->load('category')],200);
       } 
        return response()->json(['message' => 'no data']);
    }

    private function exportUsers($start, $end)
    {
        $users = User::whereBetween('created_at', [$start, $end])->get();
       if($users->isNotEmpty()){
        return response()->json(['data'=> $users],200);
       } 
        return response()->json(['message' => 'no data']);
    }
}
