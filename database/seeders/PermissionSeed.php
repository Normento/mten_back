<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public $permissions_count = 1;

    public function run()
    {

        $permissions = [
            ...$this->createPermissions(null, 'user_management', ['access'=>'Gérer les utilisateurs']),
            ...$this->createPermissions(null, 'permission', ['create'=>'Créer une permission', 'edit'=>'Modifier une  permissions', 'show'=>"Consulter les détails d'une permission", 'delete'=>"Supprimer une permission", 'access'=>"Gérer les permissions"]),
            ...$this->createPermissions(null, 'user', ['create'=>'Créer un utilisateur', 'edit'=>"Modifier les infos d'un utilisateru", 'show'=>"Consulter les détails d'un utilisateur", 'delete'=>"Supprimer un utilisateur", 'access'=>"Gérer les utilisateurs"]),
            ...$this->createPermissions(null, 'role', ['create'=>"Créer une rôle", 'edit'=>"Modifier un rôle", 'show'=>"Consulter les détails d'un rôle", 'delete'=>"Supprimer un rôle", 'access'=>"Gérer les rôles"]),
            ...$this->createPermissions(null, 'actualite', ['create'=>"Créer une actualite", 'edit'=>"Modifier une actualite", 'show'=>"Consulter les détails d'une actualite", 'delete'=>"Supprimer une actualite", 'access'=>"Gérer les actualites"]),
            ...$this->createPermissions(null, 'adresse', ['create'=>"Créer un adresse", 'edit'=>"Modifier un adresse", 'show'=>"Consulter les détails d'un adresse", 'delete'=>"Supprimer un adresse", 'access'=>"Gérer les adresses"]),
            ...$this->createPermissions(null, 'agenda', ['create'=>"Créer un agenda", 'edit'=>"Modifier un agenda", 'show'=>"Consulter les détails d'un agenda", 'delete'=>"Supprimer un agenda", 'access'=>"Gérer les agendas"]),
            ...$this->createPermissions(null, 'biography', ['create'=>"Créer un biography", 'edit'=>"Modifier un biography", 'show'=>"Consulter les détails d'un biography", 'delete'=>"Supprimer un biography", 'access'=>"Gérer les biographys"]),
            ...$this->createPermissions(null, 'contact', ['create'=>"Créer un contact", 'edit'=>"Modifier un contact", 'show'=>"Consulter les détails d'un contact", 'delete'=>"Supprimer un contact", 'access'=>"Gérer les contacts"]),
            ...$this->createPermissions(null, 'mission', ['create'=>"Créer une mission", 'edit'=>"Modifier une mission", 'show'=>"Consulter les détails d'une mission", 'delete'=>"Supprimer une mission", 'access'=>"Gérer les missions"]),
            ...$this->createPermissions(null, 'direction', ['create'=>"Créer une direction", 'edit'=>"Modifier une direction", 'show'=>"Consulter les détails d'une direction", 'delete'=>"Supprimer une direction", 'access'=>"Gérer les directions"]),
            ...$this->createPermissions(null, 'organigrame', ['create'=>"Créer un organigrame", 'edit'=>"Modifier un organigrame", 'show'=>"Consulter les détails d'un organigrame", 'delete'=>"Supprimer un organigrame", 'access'=>"Gérer les organigrames"]),
            ...$this->createPermissions(null, 'acteur', ['create'=>"Créer un acteur", 'edit'=>"Modifier un acteur", 'show'=>"Consulter les détails d'un acteur", 'delete'=>"Supprimer un acteur", 'access'=>"Gérer les acteurs"]),
            ...$this->createPermissions(null, 'projet', ['create'=>'Créer un projet', 'edit'=>"Modifier les infos d'un projet", 'show'=>"Consulter les détails d'un projet", 'delete'=>"Supprimer un projet", 'access'=>"Gérer les projets"]),
            ...$this->createPermissions(null, 'document', ['create'=>'Créer un document', 'edit'=>"Modifier les infos d'un document", 'show'=>"Consulter les détails d'un document", 'delete'=>"Supprimer un document", 'access'=>"Gérer les documents"]),
            ...$this->createPermissions(null, 'categoryDocument', ['create'=>'Créer une categorie de document', 'edit'=>"Modifier les infos d'une categorie de document", 'show'=>"Consulter les détails d'une categorie de document", 'delete'=>"Supprimer une categorie document", 'access'=>"Gérer les categories documents"]),
            ...$this->createPermissions(null, 'categoryProjet', ['create'=>'Créer une categorie de projet', 'edit'=>"Modifier les infos d'une categorie de projet", 'show'=>"Consulter les détails d'une categorie de projet", 'delete'=>"Supprimer une categorie de projet", 'access'=>"Gérer les categorie de projet"]),
            ...$this->createPermissions(null, 'opportunity', ['create'=>'Créer une opportunité', 'edit'=>"Modifier les infos d'une opportunite", 'show'=>"Consulter les détails d'une opportunité", 'delete'=>"Supprimer une opportunité", 'access'=>"Gérer les opportunité"]),
            ...$this->createPermissions(null, 'secteur', ['create'=>'Créer une secteur', 'edit'=>"Modifier les infos d'un secteur", 'show'=>"Consulter les détails d'un secteur", 'delete'=>"Supprimer un secteur", 'access'=>"Gérer les secteurs"]),
            ...$this->createPermissions(null, 'entite', ['create'=>'Créer une entite', 'edit'=>"Modifier les infos d'une entite", 'show'=>"Consulter les détails d'une entite", 'delete'=>"Supprimer une entite", 'access'=>"Gérer les entites"]),
            ...$this->createPermissions(null, 'categoryOpportunity', ['create'=>'Créer une category Opportunity', 'edit'=>"Modifier les infos d'une category Opportunity", 'show'=>"Consulter les détails d'une categoryOpportunity", 'delete'=>"Supprimer une categoryOpportunity", 'access'=>"Gérer les categoryOpportunity"]),
            ...$this->createPermissions(null, 'categoryActualite', ['create'=>'Créer une category actualite', 'edit'=>"Modifier les infos d'une category d'actualite", 'show'=>"Consulter les détails d'une category d'actualite", 'delete'=>"Supprimer une category d'actualite", 'access'=>"Gérer les category actualite"]),
            ...$this->createPermissions(null, 'tag', ['create' => "Créer un tag", 'edit' => "Modifier un tag", 'show' => "Consulter les détails d'un tag", 'delete' => "Supprimer un tag", 'access' => "Gérer les tags"]),
            ...$this->createPermissions(null, 'juridique', ['create' => "Créer un juridique", 'edit' => "Modifier un juridique", 'show' => "Consulter les détails d'un juridique", 'delete' => "Supprimer un juridique", 'access' => "Gérer les juridiques"]),
            ...$this->createPermissions(null, 'ministre', ['create' => "Créer un ministre", 'edit' => "Modifier un ministre", 'show' => "Consulter les détails d'un ministre", 'delete' => "Supprimer un ministre", 'access' => "Gérer les ministres"]),
            ...$this->createPermissions(null, 'ecosysteme', ['create' => "Créer un ecosysteme", 'edit' => "Modifier un ecosysteme", 'show' => "Consulter les détails d'un ecosysteme", 'delete' => "Supprimer un ecosysteme", 'access' => "Gérer les ecosystemes"]),
            ...$this->createPermissions(null, 'reforme', ['create' => "Créer un reforme", 'edit' => "Modifier un reforme", 'show' => "Consulter les détails d'un reforme", 'delete' => "Supprimer un reforme", 'access' => "Gérer les reformes"]),
            ...$this->createPermissions(null, 'rapport', ['create' => "Créer un rapport", 'edit' => "Modifier un rapport", 'show' => "Consulter les détails d'un rapport", 'delete' => "Supprimer un rapport", 'access' => "Gérer les rapports"]),
            ...$this->createPermissions(null, 'about', ['create' => "Créer un about", 'edit' => "Modifier un about", 'show' => "Consulter les détails d'un about", 'delete' => "Supprimer un about", 'access' => "Gérer les abouts"]),
            ...$this->createPermissions(null, 'organisme', ['create' => "Créer un organisme", 'edit' => "Modifier un organisme", 'show' => "Consulter les détails d'un organisme", 'delete' => "Supprimer un organisme", 'access' => "Gérer les organismes"]),
            ...$this->createPermissions(null, 'plateforme', ['create' => "Créer un plateforme", 'edit' => "Modifier un plateforme", 'show' => "Consulter les détails d'un plateforme", 'delete' => "Supprimer un plateforme", 'access' => "Gérer les plateformes"]),
            ...$this->createPermissions(null, 'categoryRapport', ['create' => "Créer un categoryRapport", 'edit' => "Modifier un categoryRapport", 'show' => "Consulter les détails d'un categoryRapport", 'delete' => "Supprimer un categoryRapport", 'access' => "Gérer les categoryRapports"]),
            ...$this->createPermissions(null, 'categoryReforme', ['create' => "Créer un categoryReforme", 'edit' => "Modifier un categoryReforme", 'show' => "Consulter les détails d'un categoryReforme", 'delete' => "Supprimer un categoryReforme", 'access' => "Gérer les categoryReformes"]),
            ...$this->createPermissions(null, 'categoryAgenda', ['create' => "Créer un category d'evennement", 'edit' => "Modifier un category d'evennement", 'show' => "Consulter les détails d'un category d'evennement", 'delete' => "Supprimer un category d'evennement", 'access' => "Gérer les category d'evennement"]),
            ...$this->createPermissions(null, 'categoryEcosysteme', ['create' => "Créer un category d'Ecosysteme", 'edit' => "Modifier un category d'Ecosysteme", 'show' => "Consulter les détails d'un category d'Ecosysteme", 'delete' => "Supprimer un category d'Ecosysteme", 'access' => "Gérer les category d'Ecosysteme"]),
            ...$this->createPermissions(null, 'categoryStartup', ['create' => "Créer un category pour un secteur de startup", 'edit' => "Modifier un category de startup", 'show' => "Consulter les détails d'un category de startup", 'delete' => "Supprimer un category de startup", 'access' => "Gérer les category de startup"]),
            ...$this->createPermissions(null, 'startup', ['create' => "Créer un startup", 'edit' => "Modifier un startup", 'show' => "Consulter les détails d'un startup", 'delete' => "Supprimer un startup", 'access' => "Gérer les startups"]),
            ...$this->createPermissions(null, 'categoryFormation', ['create' => "Créer un category de formation", 'edit' => "Modifier un category de formation", 'show' => "Consulter les détails d'un category de formation", 'delete' => "Supprimer un category de formation", 'access' => "Gérer les category de formation"]),
            ...$this->createPermissions(null, 'formation', ['create' => "Créer une formation", 'edit' => "Modifier une formation", 'show' => "Consulter les détails d'une formation", 'delete' => "Supprimer une formation", 'access' => "Gérer les formations"]),
            ...$this->createPermissions(null, 'promotion', ['create' => "Créer une promotion", 'edit' => "Modifier une promotion", 'show' => "Consulter les détails d'une promotion", 'delete' => "Supprimer une promotion", 'access' => "Gérer les promotion"]),
            ...$this->createPermissions(null, 'sensibilisation', ['create' => "Créer une sensibilisation", 'edit' => "Modifier une sensibilisation", 'show' => "Consulter les détails d'une sensibilisation", 'delete' => "Supprimer une sensibilisation", 'access' => "Gérer les sensibilisations"]),
            ...$this->createPermissions(null, 'etatDesLieux', ['create' => "Créer un etatDesLieux", 'edit' => "Modifier un etatDesLieux", 'show' => "Consulter les détails d'une etatDesLieux", 'delete' => "Supprimer une etatDesLieux", 'access' => "Gérer les etatDesLieux"]),

        ];

        Permission::insert($permissions);
    }

    public function createPermissions($initialId, $resource, $permissions)
    {
        $id = $initialId ?? $this->permissions_count;
        $result = array_map(function ($perm, $description) use (&$id, $resource) {
            $item = [
                "title" => $resource . '_' . $perm,
                "description"=> $description,
            ];
            $id++;
            return $item;
        }, array_keys($permissions),  $permissions);

        $this->permissions_count = $id;
        return $result;
    }
}
