<?php

namespace Database\Seeders;

use App\Models\CategoryEcosysteme;
use App\Models\Ecosysteme;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EcosystemeDuTchadSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = User::inRandomOrder()->value('id');
        $category = CategoryEcosysteme::inRandomOrder()->value('id');
        $ecosystemeDuTchad = [
            [
                'title' => 'ECosysteme du Tchad - publication - 1' ,
                'user_id' => $userId,
                'description' => ' Description - publication - 1',
                'category_ecosysteme_id' => $category,
                'content' => "Les trois grands écosystèmes du Tchad

                Au Tchad, les écosystèmes sont constitués des écosystèmes terrestres, aquatiques naturels et agrosystèmes aquatiques.
                Ces écosystèmes se partagent les trois (3) grands domaines phytogéographiques ou bioclimatiques du Tchad à savoir les domaines saharien, sahélien et soudanien.

                 La zone saharienne

                 Située sensiblement entre les 16e et 23e parallèles Nord et entre les 15e et 24e méridien Est, elle couvre une superficie de 600350 km² soit 48 % de la superficie du pays. Son climat est compris entre les isohyètes 0-200 mm et est caractérisé par une faible pluviométrie annuelle (moins de 200 mm).
                L’eau est la principale contrainte écologique qui limite considérablement le développement de la végétation et partant la prolifération de la variabilité biologique ; elle n’est présente que dans les lits d’oueds, plaines d’épandage, zones d’affleurement des nappes. Elle est aussi présente dans les lacs salés d’Ounianga.

                 La zone sahélienne

                 Située entre les 12e et 16e parallèles Nord, elle couvre une superficie de 490570 km². Elle s’étend des isohyètes 200 à 600 mm. Du point de vue ressources en eau, on distingue des lacs (Lac Tchad, 2e lac africain mais menacé par la désertification, Lac Fitri), des fleuves (Chari, Logone, Batha, Azoum) et des mares temporaires.

                 La zone soudanienne

                 S’étendant entre les 8e et 12e parallèles Nord, la zone soudanienne  est la zone la plus arrosée du pays et elle est caractérisée par une pluviométrie de 600 à 1 200 mm. Le réseau hydrographique se rapporte aux fleuves Chari et le Logone qui confluent à 100 km du Lac Tchad prenant leurs sources près des frontières nord de la République Centrafricaine. On y rencontre également plusieurs affluents de ces deux cours d’eau (Salamat, Bahr Azoum, Tandjilé, Ba-Illi…) et des lacs tels que les lacs Iro, Léré, Fianga, Tikem. La végétation comprend trois types de formations : forêts claires à légumineuses et combrétacées ; savanes arborées forestières dominées par les espèces comme Daniella, Khaya, Anogeissus et savanes soudaniennes à combrétacées.",
                'category_ecosysteme_id' => 1,
            ],
            [
                'title' => 'ECosysteme du Tchad - publication - 2',
                'user_id' => $userId,
                'description' => ' Description - publication - 2',
                'category_ecosysteme_id' => $category,
                'content' => "Les trois grands écosystèmes du Tchad

                Au Tchad, les écosystèmes sont constitués des écosystèmes terrestres, aquatiques naturels et agrosystèmes aquatiques.
                Ces écosystèmes se partagent les trois (3) grands domaines phytogéographiques ou bioclimatiques du Tchad à savoir les domaines saharien, sahélien et soudanien.

                 La zone saharienne

                 Située sensiblement entre les 16e et 23e parallèles Nord et entre les 15e et 24e méridien Est, elle couvre une superficie de 600350 km² soit 48 % de la superficie du pays. Son climat est compris entre les isohyètes 0-200 mm et est caractérisé par une faible pluviométrie annuelle (moins de 200 mm).
                L’eau est la principale contrainte écologique qui limite considérablement le développement de la végétation et partant la prolifération de la variabilité biologique ; elle n’est présente que dans les lits d’oueds, plaines d’épandage, zones d’affleurement des nappes. Elle est aussi présente dans les lacs salés d’Ounianga.

                 La zone sahélienne

                 Située entre les 12e et 16e parallèles Nord, elle couvre une superficie de 490570 km². Elle s’étend des isohyètes 200 à 600 mm. Du point de vue ressources en eau, on distingue des lacs (Lac Tchad, 2e lac africain mais menacé par la désertification, Lac Fitri), des fleuves (Chari, Logone, Batha, Azoum) et des mares temporaires.

                 La zone soudanienne

                 S’étendant entre les 8e et 12e parallèles Nord, la zone soudanienne  est la zone la plus arrosée du pays et elle est caractérisée par une pluviométrie de 600 à 1 200 mm. Le réseau hydrographique se rapporte aux fleuves Chari et le Logone qui confluent à 100 km du Lac Tchad prenant leurs sources près des frontières nord de la République Centrafricaine. On y rencontre également plusieurs affluents de ces deux cours d’eau (Salamat, Bahr Azoum, Tandjilé, Ba-Illi…) et des lacs tels que les lacs Iro, Léré, Fianga, Tikem. La végétation comprend trois types de formations : forêts claires à légumineuses et combrétacées ; savanes arborées forestières dominées par les espèces comme Daniella, Khaya, Anogeissus et savanes soudaniennes à combrétacées."
            ],

            [
                'title' => 'ECosysteme du Tchad - publication - 3',
                'user_id' => $userId,
                'description' => ' Description - publication - 3',
                'category_ecosysteme_id' => $category,
                'content' => "Les trois grands écosystèmes du Tchad

                Au Tchad, les écosystèmes sont constitués des écosystèmes terrestres, aquatiques naturels et agrosystèmes aquatiques.
                Ces écosystèmes se partagent les trois (3) grands domaines phytogéographiques ou bioclimatiques du Tchad à savoir les domaines saharien, sahélien et soudanien.

                 La zone saharienne

                 Située sensiblement entre les 16e et 23e parallèles Nord et entre les 15e et 24e méridien Est, elle couvre une superficie de 600350 km² soit 48 % de la superficie du pays. Son climat est compris entre les isohyètes 0-200 mm et est caractérisé par une faible pluviométrie annuelle (moins de 200 mm).
                L’eau est la principale contrainte écologique qui limite considérablement le développement de la végétation et partant la prolifération de la variabilité biologique ; elle n’est présente que dans les lits d’oueds, plaines d’épandage, zones d’affleurement des nappes. Elle est aussi présente dans les lacs salés d’Ounianga.

                 La zone sahélienne

                 Située entre les 12e et 16e parallèles Nord, elle couvre une superficie de 490570 km². Elle s’étend des isohyètes 200 à 600 mm. Du point de vue ressources en eau, on distingue des lacs (Lac Tchad, 2e lac africain mais menacé par la désertification, Lac Fitri), des fleuves (Chari, Logone, Batha, Azoum) et des mares temporaires.

                 La zone soudanienne

                 S’étendant entre les 8e et 12e parallèles Nord, la zone soudanienne  est la zone la plus arrosée du pays et elle est caractérisée par une pluviométrie de 600 à 1 200 mm. Le réseau hydrographique se rapporte aux fleuves Chari et le Logone qui confluent à 100 km du Lac Tchad prenant leurs sources près des frontières nord de la République Centrafricaine. On y rencontre également plusieurs affluents de ces deux cours d’eau (Salamat, Bahr Azoum, Tandjilé, Ba-Illi…) et des lacs tels que les lacs Iro, Léré, Fianga, Tikem. La végétation comprend trois types de formations : forêts claires à légumineuses et combrétacées ; savanes arborées forestières dominées par les espèces comme Daniella, Khaya, Anogeissus et savanes soudaniennes à combrétacées.",
                'category_ecosysteme_id' => 1,
            ],

        ];

        Ecosysteme::insert($ecosystemeDuTchad);
    }
}
