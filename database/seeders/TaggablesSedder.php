<?php

namespace Database\Seeders;

use App\Models\Actualite;
use App\Models\Tag;
use App\Models\Agenda;
use App\Models\Projet;
use App\Models\Reforme;
use App\Models\Document;
use App\Models\Ecosysteme;
use App\Models\Formation;
use App\Models\Opportunite;
use App\Models\Rapport;
use App\Models\Startup;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TaggablesSedder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtenez toutes les sessions
        $document = Document::all();
        $ecosysteme = Ecosysteme::all();
        $projet = Projet::all();
        $reforme = Reforme::all();
        $agenda = Agenda::all();
        $actualites = Actualite::all();
        $rapports = Rapport::all();
        $opportunites = Opportunite::all();
        $startups = Startup::all();
        $formations = Formation::all();

        // Obtenez toutes les actualités
        //$actualites = Actualite::all();

        // Obtenez tous les tags
        $tags = Tag::all();

        // Associez des tags à des sessions
        foreach ($document as $documents) {
            // Choisissez un nombre aléatoire de tags (entre 1 et 5)
            $selectedTags = $tags->random(rand(1, 5));

            // Attachez les tags au document
            $documents->tags()->attach($selectedTags);
        }

        // Associez des tags à des actualités
        foreach ($ecosysteme as $ecosystemes) {
            // Choisissez un nombre aléatoire de tags (entre 1 et 5)
            $selectedTags = $tags->random(rand(1, 5));

            // Attachez les tags à l'ecosysteme
            $ecosystemes->tags()->attach($selectedTags);
        }

        foreach ($projet as $projets) {
            // Choisissez un nombre aléatoire de tags (entre 1 et 5)
            $selectedTags = $tags->random(rand(1, 5));

            // Attachez les tags au projets
            $projets->tags()->attach($selectedTags);
        }

        foreach ($reforme as $reformes) {
            // Choisissez un nombre aléatoire de tags (entre 1 et 5)
            $selectedTags = $tags->random(rand(1, 5));

            // Attachez les tags au reformes
            $reformes->tags()->attach($selectedTags);
        }

        foreach ($agenda as $agendas) {
            // Choisissez un nombre aléatoire de tags (entre 1 et 5)
            $selectedTags = $tags->random(rand(1, 5));

            // Attachez les tags à l'agenda
            $agendas->tags()->attach($selectedTags);
        }

        foreach ($actualites as $actualite) {
            // Choisissez un nombre aléatoire de tags (entre 1 et 5)
            $selectedTags = $tags->random(rand(1, 5));

            // Attachez les tags à l'actualité
            $actualite->tags()->attach($selectedTags);
        }

        foreach ($rapports as $rapport) {
            // Choisissez un nombre aléatoire de tags (entre 1 et 5)
            $selectedTags = $tags->random(rand(1, 5));

            // Attachez les tags à l'actualité
            $rapport->tags()->attach($selectedTags);
        }

        foreach ($opportunites as $opportunite) {
            // Choisissez un nombre aléatoire de tags (entre 1 et 5)
            $selectedTags = $tags->random(rand(1, 5));

            // Attachez les tags à l'opportunité
            $opportunite->tags()->attach($selectedTags);
        }

        foreach ($startups as $startup) {
            // Choisissez un nombre aléatoire de tags (entre 1 et 5)
            $selectedTags = $tags->random(rand(1, 5));

            // Attachez les tags au startup
            $startup->tags()->attach($selectedTags);
        }

        foreach ($formations as $formation) {
            // Choisissez un nombre aléatoire de tags (entre 1 et 5)
            $selectedTags = $tags->random(rand(1, 5));

            // Attachez les tags à la formation
            $formation->tags()->attach($selectedTags);
        }
    }
}
