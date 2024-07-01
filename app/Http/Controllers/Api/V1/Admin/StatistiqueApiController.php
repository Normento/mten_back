<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
use App\Models\Sensibilisation;

class StatistiqueApiController extends Controller
{
    /**
     * Statistique.
     */
    public function getStats()
    {
        $stats = [
            'users' => User::count(),
            'acteurs' => Acteur::count(),
            'agendas' => Agenda::count(),
            'entites' => Entite::count(),
            'projets' => Projet::count(),
            'contacts' => Contact::count(),
            'rapports' => Rapport::count(),
            'startups' => Startup::count(),
            'documents' => Document::count(),
            'ministres' => Ministre::count(),
            'actualites' => Actualite::count(),
            'directions' => Direction::count(),
            'formations' => Formation::count(),
            'organismes' => Organisme::count(),
            'promotions' => Promotion::count(),
            'ecosystemes' => Ecosysteme::count(),
            'newsletters' => Newsletter::count(),
            'plateformes' => Plateforme::count(),
            'opportunites' => Opportunite::count(),
            'etats' => EtatDesLieux::count(),
            'sensibilisations' => Sensibilisation::count(),
        ];

        return response()->json(['data' => $stats]);
    }
}
