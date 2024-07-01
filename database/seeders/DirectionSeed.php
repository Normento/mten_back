<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Direction;
use Illuminate\Database\Seeder;
use App\Models\CategoryDirection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DirectionSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = User::inRandomOrder()->value('id');
        $directions = [
            [
                'director_name' => 'HAOUAYE MAHAMAT',
                'name' => 'Direction de Système d’Information et de la Communication (DSIC)',
                'user_id' => $userId,
                'sigle' => 'DSI',
                'category_direction_id' => '1',
                'slug' => 'dsi',
                'content' => "Développer et constituer un système d’information global ainsi que référentiel ;
                             Apporter son concours à la promotion des nouvelles formes d’enseignement et au développement de la recherche scientifique ;
                             Assurer l’accès à l’information et aux applications de gestion de l’université et d’en garantir la sécurité, l’intégrité et la fiabilité ;
                             Afin de mener à bien ses attributions et tâches, la Direction du Système d’Information et de la Communication (DSIC) dispose de:
                             2 salles informatiques : 50 PC régulièrement renouvelé
                             20 ordinateurs portables
                             2 imprimantes
                             2 scanners
                              4 vidéoprojecteurs
                             1 salle équipée de visio-conférence
                             1 salle équipée de serveur intranet et internet
                             Une connexion internet Haut débit par fibre optique",

                'description' => 'Développer et constituer un système d’information global ainsi que référentiel ;
                             Apporter son concours à la promotion des nouvelles formes d’enseignement et au développement de la recherche scientifique ;
                             Assurer l’accès à l’information et aux applications de gestion de l’université et d’en garantir la sécurité, l’intégrité et la fiabilité ;
                             Afin de mener à bien ses attributions et tâches',
            ],
            [
                'director_name' => 'HAOUAYE MAHAMAT',
                'name' => 'Direction de Système d’Information et de la Communication (DSIC)',
                'user_id' => $userId,
                'sigle' => 'DSI',
                'slug' => 'dsi-2',
                'category_direction_id' => '2',
                'content' => "Développer et constituer un système d’information global ainsi que référentiel ;
                             Apporter son concours à la promotion des nouvelles formes d’enseignement et au développement de la recherche scientifique ;
                             Assurer l’accès à l’information et aux applications de gestion de l’université et d’en garantir la sécurité, l’intégrité et la fiabilité ;
                             Afin de mener à bien ses attributions et tâches, la Direction du Système d’Information et de la Communication (DSIC) dispose de:
                             2 salles informatiques : 50 PC régulièrement renouvelé
                             20 ordinateurs portables
                             2 imprimantes
                             2 scanners
                              4 vidéoprojecteurs
                             1 salle équipée de visio-conférence
                             1 salle équipée de serveur intranet et internet
                             Une connexion internet Haut débit par fibre optique",

                'description' => 'Développer et constituer un système d’information global ainsi que référentiel ;
                             Apporter son concours à la promotion des nouvelles formes d’enseignement et au développement de la recherche scientifique ;
                             Assurer l’accès à l’information et aux applications de gestion de l’université et d’en garantir la sécurité, l’intégrité et la fiabilité ;
                             Afin de mener à bien ses attributions et tâches',
            ],
            [
                'director_name' => 'HAOUAYE MAHAMAT',
                'name' => 'Direction de Système d’Information et de la Communication (DSIC)',
                'user_id' => $userId,
                'sigle' => 'DSI',
                'slug' => 'dsi-3',
                'category_direction_id' => '1',
                'content' => "Développer et constituer un système d’information global ainsi que référentiel ;
                             Apporter son concours à la promotion des nouvelles formes d’enseignement et au développement de la recherche scientifique ;
                             Assurer l’accès à l’information et aux applications de gestion de l’université et d’en garantir la sécurité, l’intégrité et la fiabilité ;
                             Afin de mener à bien ses attributions et tâches, la Direction du Système d’Information et de la Communication (DSIC) dispose de:
                             2 salles informatiques : 50 PC régulièrement renouvelé
                             20 ordinateurs portables
                             2 imprimantes
                             2 scanners
                              4 vidéoprojecteurs
                             1 salle équipée de visio-conférence
                             1 salle équipée de serveur intranet et internet
                             Une connexion internet Haut débit par fibre optique",

                'description' => 'Développer et constituer un système d’information global ainsi que référentiel ;
                             Apporter son concours à la promotion des nouvelles formes d’enseignement et au développement de la recherche scientifique ;
                             Assurer l’accès à l’information et aux applications de gestion de l’université et d’en garantir la sécurité, l’intégrité et la fiabilité ;
                             Afin de mener à bien ses attributions et tâches',
            ],
            [
                'director_name' => 'HAOUAYE MAHAMAT',
                'name' => 'Direction de Système d’Information et de la Communication (DSIC)',
                'user_id' => $userId,
                'sigle' => 'DSI',
                'slug' => 'dsi-4',
                'category_direction_id' => '2',
                'content' => "Développer et constituer un système d’information global ainsi que référentiel ;
                             Apporter son concours à la promotion des nouvelles formes d’enseignement et au développement de la recherche scientifique ;
                             Assurer l’accès à l’information et aux applications de gestion de l’université et d’en garantir la sécurité, l’intégrité et la fiabilité ;
                             Afin de mener à bien ses attributions et tâches, la Direction du Système d’Information et de la Communication (DSIC) dispose de:
                             2 salles informatiques : 50 PC régulièrement renouvelé
                             20 ordinateurs portables
                             2 imprimantes
                             2 scanners
                              4 vidéoprojecteurs
                             1 salle équipée de visio-conférence
                             1 salle équipée de serveur intranet et internet
                             Une connexion internet Haut débit par fibre optique",

                'description' => 'Développer et constituer un système d’information global ainsi que référentiel ;
                             Apporter son concours à la promotion des nouvelles formes d’enseignement et au développement de la recherche scientifique ;
                             Assurer l’accès à l’information et aux applications de gestion de l’université et d’en garantir la sécurité, l’intégrité et la fiabilité ;
                             Afin de mener à bien ses attributions et tâches',
            ],
            [
                'director_name' => 'HAOUAYE MAHAMAT',
                'name' => 'Direction de Système d’Information et de la Communication (DSIC)',
                'user_id' => $userId,
                'sigle' => 'DSI',
                'slug' => 'dsi-5',
                'category_direction_id' => '1',
                'content' => "Développer et constituer un système d’information global ainsi que référentiel ;
                             Apporter son concours à la promotion des nouvelles formes d’enseignement et au développement de la recherche scientifique ;
                             Assurer l’accès à l’information et aux applications de gestion de l’université et d’en garantir la sécurité, l’intégrité et la fiabilité ;
                             Afin de mener à bien ses attributions et tâches, la Direction du Système d’Information et de la Communication (DSIC) dispose de:
                             2 salles informatiques : 50 PC régulièrement renouvelé
                             20 ordinateurs portables
                             2 imprimantes
                             2 scanners
                              4 vidéoprojecteurs
                             1 salle équipée de visio-conférence
                             1 salle équipée de serveur intranet et internet
                             Une connexion internet Haut débit par fibre optique",

                'description' => 'Développer et constituer un système d’information global ainsi que référentiel ;
                             Apporter son concours à la promotion des nouvelles formes d’enseignement et au développement de la recherche scientifique ;
                             Assurer l’accès à l’information et aux applications de gestion de l’université et d’en garantir la sécurité, l’intégrité et la fiabilité ;
                             Afin de mener à bien ses attributions et tâches',
            ],

        ];

        Direction::insert($directions);
    }
}
