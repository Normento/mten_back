<?php

namespace Database\Seeders;

use App\Models\Reforme;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReformeSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = User::inRandomOrder()->value('id');
        $reformes = [
            [
                'title' => 'Titre de la reforme - 1 ',
                'user_id' => $userId,
                'slug' => 'reforme-1',
                'description' => 'Les réformes institutionnelles au Tchad : Entre ambitions partisanes et unité nationale, Comité de suivi de l’appel à la paix et à la réconciliation (CSAPR), 2017',
                'content' => "Après la proclamation de la République, les élections de 1959 furent remportées par le Parti Progressiste Tchadien (PTT), une branche locale du Rassemblement Démocratique Africain (RDA). Son leader François TOMBALBAYE fut désigné Premier ministre , puis Président de la République à l’indépendance en 1960 .

                Mais la gestion du pouvoir du Président TOMBALBAYE va très vite être critiquée. Ces critiques vont conduire une partie importante des populations du Nord et du Centre à se révolter. Cette révolte est à l’origine de la création du premier mouvement rebelle au Tchad, le Front de Libération Nationale du Tchad, (FROLINAT).

                Depuis 1963, le pays est entré dans un cercle infernal de guerres  qui a fragilisé les bases des institutions étatiques. Les coups d’Etat se succèdent avec leur lot de violence. C’est une vie politique fortement militarisée. Marielle DEBOS pense que « la guerre et la paix forment un continuum : des périodes d’une paix fragiles alternent avec des éruptions soudaines de violence».
                Cette situation de guerre a eu de sérieuses conséquences sur le développement, l’organisation administrative et institutionnelle. Après la chute de TOMBALBAYE le 13 avril 1975 et la prise du pouvoir par le général Félix MALLOUM en avril 1975, le pouvoir passe aux mains des leaders de FROLINAT Goukouni WEDDEY en 1978 puis Hissein HABRE le 07 Jun 1982.

                Une période de transition a été observée jusqu’à l’adoption de la loi fondamentale du 31 Mars 1996. Elle prit fin avec les premières élections de la même année. La vie politique semble retrouver alors une relative tranquillité mais qui ne sera que de courte durée. Car dés 2005, une reforme constitutionnelle est intervenue et a fait sauté le verrou constitutionnel de limitation du nombre de mandat présidentiel.

                Le Tchad renoue avec ses démons d’instabilités politiques tant sur le plan des rebellions que celui des acteurs des partis politiques légalement constitués. Sur le plan militaire, le Tchad avait connu pendant la période 2005- 2009 une vague de mouvements de rebellions qui ont tenté de renverser le règne de Idriss Deby Itno.",
                'created_at' => Carbon::now(),
                'type' => 'text',
            ],
            [
                'title' => 'Titre de la reforme - 2 ',
                'user_id' => $userId,
                'slug' => 'reforme-2',
                'description' => 'Les réformes institutionnelles au Tchad : Entre ambitions partisanes et unité nationale, Comité de suivi de l’appel à la paix et à la réconciliation (CSAPR), 2017',
                'content' => "Après la proclamation de la République, les élections de 1959 furent remportées par le Parti Progressiste Tchadien (PTT), une branche locale du Rassemblement Démocratique Africain (RDA). Son leader François TOMBALBAYE fut désigné Premier ministre , puis Président de la République à l’indépendance en 1960 .

                Mais la gestion du pouvoir du Président TOMBALBAYE va très vite être critiquée. Ces critiques vont conduire une partie importante des populations du Nord et du Centre à se révolter. Cette révolte est à l’origine de la création du premier mouvement rebelle au Tchad, le Front de Libération Nationale du Tchad, (FROLINAT).

                Depuis 1963, le pays est entré dans un cercle infernal de guerres  qui a fragilisé les bases des institutions étatiques. Les coups d’Etat se succèdent avec leur lot de violence. C’est une vie politique fortement militarisée. Marielle DEBOS pense que « la guerre et la paix forment un continuum : des périodes d’une paix fragiles alternent avec des éruptions soudaines de violence».
                Cette situation de guerre a eu de sérieuses conséquences sur le développement, l’organisation administrative et institutionnelle. Après la chute de TOMBALBAYE le 13 avril 1975 et la prise du pouvoir par le général Félix MALLOUM en avril 1975, le pouvoir passe aux mains des leaders de FROLINAT Goukouni WEDDEY en 1978 puis Hissein HABRE le 07 Jun 1982.

                Une période de transition a été observée jusqu’à l’adoption de la loi fondamentale du 31 Mars 1996. Elle prit fin avec les premières élections de la même année. La vie politique semble retrouver alors une relative tranquillité mais qui ne sera que de courte durée. Car dés 2005, une reforme constitutionnelle est intervenue et a fait sauté le verrou constitutionnel de limitation du nombre de mandat présidentiel.

                Le Tchad renoue avec ses démons d’instabilités politiques tant sur le plan des rebellions que celui des acteurs des partis politiques légalement constitués. Sur le plan militaire, le Tchad avait connu pendant la période 2005- 2009 une vague de mouvements de rebellions qui ont tenté de renverser le règne de Idriss Deby Itno.",
                'created_at' => Carbon::now(),
                'type' => 'document',
            ],
            [
                'title' => 'Titre de la reforme - 3 ',
                'user_id' => $userId,
                'slug' => 'reforme-3',
                'description' => 'Les réformes institutionnelles au Tchad : Entre ambitions partisanes et unité nationale, Comité de suivi de l’appel à la paix et à la réconciliation (CSAPR), 2017',
                'content' => "Après la proclamation de la République, les élections de 1959 furent remportées par le Parti Progressiste Tchadien (PTT), une branche locale du Rassemblement Démocratique Africain (RDA). Son leader François TOMBALBAYE fut désigné Premier ministre , puis Président de la République à l’indépendance en 1960 .

                Mais la gestion du pouvoir du Président TOMBALBAYE va très vite être critiquée. Ces critiques vont conduire une partie importante des populations du Nord et du Centre à se révolter. Cette révolte est à l’origine de la création du premier mouvement rebelle au Tchad, le Front de Libération Nationale du Tchad, (FROLINAT).

                Depuis 1963, le pays est entré dans un cercle infernal de guerres  qui a fragilisé les bases des institutions étatiques. Les coups d’Etat se succèdent avec leur lot de violence. C’est une vie politique fortement militarisée. Marielle DEBOS pense que « la guerre et la paix forment un continuum : des périodes d’une paix fragiles alternent avec des éruptions soudaines de violence».
                Cette situation de guerre a eu de sérieuses conséquences sur le développement, l’organisation administrative et institutionnelle. Après la chute de TOMBALBAYE le 13 avril 1975 et la prise du pouvoir par le général Félix MALLOUM en avril 1975, le pouvoir passe aux mains des leaders de FROLINAT Goukouni WEDDEY en 1978 puis Hissein HABRE le 07 Jun 1982.

                Une période de transition a été observée jusqu’à l’adoption de la loi fondamentale du 31 Mars 1996. Elle prit fin avec les premières élections de la même année. La vie politique semble retrouver alors une relative tranquillité mais qui ne sera que de courte durée. Car dés 2005, une reforme constitutionnelle est intervenue et a fait sauté le verrou constitutionnel de limitation du nombre de mandat présidentiel.

                Le Tchad renoue avec ses démons d’instabilités politiques tant sur le plan des rebellions que celui des acteurs des partis politiques légalement constitués. Sur le plan militaire, le Tchad avait connu pendant la période 2005- 2009 une vague de mouvements de rebellions qui ont tenté de renverser le règne de Idriss Deby Itno.",
                'created_at' => Carbon::now(),
                'type' => 'text',
            ],

        ];

        Reforme::insert($reformes);
    }
}
