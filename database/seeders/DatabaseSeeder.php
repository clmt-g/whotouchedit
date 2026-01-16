<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Machine;
use App\Models\Intervention;
use App\Models\InterventionPlanifiee;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        echo "🚀 Démarrage du seeding...\n\n";

        // ============================================
        // 1. USERS (avec rôles)
        // ============================================
        echo "👥 Création des utilisateurs...\n";

        // ADMINS (2 utilisateurs)
        $admin1 = User::create([
            'nom' => 'Admin',
            'prenom' => 'Système',
            'email' => 'admin@whotouchedit.fr',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $admin2 = User::create([
            'nom' => 'Rousseau',
            'prenom' => 'Claire',
            'email' => 'claire.rousseau@whotouchedit.fr',
            'password' => Hash::make('admin2024'),
            'role' => 'admin',
        ]);

        // DIRECTION (3 utilisateurs)
        $direction1 = User::create([
            'nom' => 'Dupont',
            'prenom' => 'Marie',
            'email' => 'direction@whotouchedit.fr',
            'password' => Hash::make('password'),
            'role' => 'direction',
        ]);

        $direction2 = User::create([
            'nom' => 'Laurent',
            'prenom' => 'François',
            'email' => 'francois.laurent@whotouchedit.fr',
            'password' => Hash::make('dir2024'),
            'role' => 'direction',
        ]);

        $direction3 = User::create([
            'nom' => 'Petit',
            'prenom' => 'Isabelle',
            'email' => 'isabelle.petit@whotouchedit.fr',
            'password' => Hash::make('dir2024'),
            'role' => 'direction',
        ]);

        // RESPONSABLES (4 utilisateurs)
        $responsable1 = User::create([
            'nom' => 'Martin',
            'prenom' => 'Pierre',
            'email' => 'responsable@whotouchedit.fr',
            'password' => Hash::make('password'),
            'role' => 'responsable',
        ]);

        $responsable2 = User::create([
            'nom' => 'Dubois',
            'prenom' => 'Laurent',
            'email' => 'laurent.dubois@whotouchedit.fr',
            'password' => Hash::make('resp2024'),
            'role' => 'responsable',
        ]);

        $responsable3 = User::create([
            'nom' => 'Garcia',
            'prenom' => 'Carmen',
            'email' => 'carmen.garcia@whotouchedit.fr',
            'password' => Hash::make('resp2024'),
            'role' => 'responsable',
        ]);

        $responsable4 = User::create([
            'nom' => 'Roux',
            'prenom' => 'Marc',
            'email' => 'marc.roux@whotouchedit.fr',
            'password' => Hash::make('resp2024'),
            'role' => 'responsable',
        ]);

        // TECHNICIENS (8 utilisateurs)
        $technicien1 = User::create([
            'nom' => 'Bernard',
            'prenom' => 'Sophie',
            'email' => 'technicien@whotouchedit.fr',
            'password' => Hash::make('password'),
            'role' => 'technicien',
        ]);

        $technicien2 = User::create([
            'nom' => 'Leroy',
            'prenom' => 'Thomas',
            'email' => 'thomas.leroy@whotouchedit.fr',
            'password' => Hash::make('tech2024'),
            'role' => 'technicien',
        ]);

        $technicien3 = User::create([
            'nom' => 'Moreau',
            'prenom' => 'Julie',
            'email' => 'julie.moreau@whotouchedit.fr',
            'password' => Hash::make('tech2024'),
            'role' => 'technicien',
        ]);

        $technicien4 = User::create([
            'nom' => 'Simon',
            'prenom' => 'Lucas',
            'email' => 'lucas.simon@whotouchedit.fr',
            'password' => Hash::make('tech2024'),
            'role' => 'technicien',
        ]);

        $technicien5 = User::create([
            'nom' => 'Michel',
            'prenom' => 'Émilie',
            'email' => 'emilie.michel@whotouchedit.fr',
            'password' => Hash::make('tech2024'),
            'role' => 'technicien',
        ]);

        $technicien6 = User::create([
            'nom' => 'Lefebvre',
            'prenom' => 'Alexandre',
            'email' => 'alexandre.lefebvre@whotouchedit.fr',
            'password' => Hash::make('tech2024'),
            'role' => 'technicien',
        ]);

        $technicien7 = User::create([
            'nom' => 'Mercier',
            'prenom' => 'Pauline',
            'email' => 'pauline.mercier@whotouchedit.fr',
            'password' => Hash::make('tech2024'),
            'role' => 'technicien',
        ]);

        $technicien8 = User::create([
            'nom' => 'Blanc',
            'prenom' => 'Maxime',
            'email' => 'maxime.blanc@whotouchedit.fr',
            'password' => Hash::make('tech2024'),
            'role' => 'technicien',
        ]);

        $techniciens = [$technicien1, $technicien2, $technicien3, $technicien4, $technicien5, $technicien6, $technicien7, $technicien8];
        $responsables = [$responsable1, $responsable2, $responsable3, $responsable4];

        echo "✅ 17 utilisateurs créés (2 admins, 3 directions, 4 responsables, 8 techniciens)\n\n";

        // ============================================
        // 2. MACHINES (25 machines)
        // ============================================
        echo "🏭 Création des machines...\n";

        $machines = [];

        // MACHINES CRITIQUES OPÉRATIONNELLES (8)
        $machines[] = Machine::create([
            'nom' => 'Fraiseuse CNC X500',
            'reference' => 'CNC-X500-2023',
            'dateInstallation' => '2023-03-15',
            'etat' => 'opérationnelle',
            'criticite' => 'critique',
            'localisation' => 'Atelier A - Zone 1',
            'notes' => 'Machine principale pour la production de pièces de haute précision. Maintenance trimestrielle obligatoire.',
        ]);

        $machines[] = Machine::create([
            'nom' => 'Tour automatique TA-3000',
            'reference' => 'TA-3000-2022',
            'dateInstallation' => '2022-11-20',
            'etat' => 'opérationnelle',
            'criticite' => 'critique',
            'localisation' => 'Atelier A - Zone 2',
            'notes' => 'Capacité de tournage jusqu\'à 300mm de diamètre. Production continue 24/7.',
        ]);

        $machines[] = Machine::create([
            'nom' => 'Découpe laser DL-5000',
            'reference' => 'DL-5000-2024',
            'dateInstallation' => '2024-01-05',
            'etat' => 'opérationnelle',
            'criticite' => 'critique',
            'localisation' => 'Atelier C - Zone 1',
            'notes' => 'Installation récente. Capacité de découpe 5000W. Encore sous garantie constructeur.',
        ]);

        $machines[] = Machine::create([
            'nom' => 'Centre d\'usinage CU-800',
            'reference' => 'CU-800-2023',
            'dateInstallation' => '2023-07-12',
            'etat' => 'opérationnelle',
            'criticite' => 'critique',
            'localisation' => 'Atelier A - Zone 3',
            'notes' => 'Centre 5 axes pour pièces complexes. Utilisé pour les prototypes et petites séries.',
        ]);

        $machines[] = Machine::create([
            'nom' => 'Robot de soudure RS-2000',
            'reference' => 'RS-2000-2022',
            'dateInstallation' => '2022-09-18',
            'etat' => 'opérationnelle',
            'criticite' => 'critique',
            'localisation' => 'Atelier D - Zone 1',
            'notes' => 'Robot 6 axes pour soudure MIG/MAG. Programmation flexible pour différents produits.',
        ]);

        $machines[] = Machine::create([
            'nom' => 'Presse injection PI-1500',
            'reference' => 'PI-1500-2021',
            'dateInstallation' => '2021-05-22',
            'etat' => 'opérationnelle',
            'criticite' => 'critique',
            'localisation' => 'Atelier E - Zone 1',
            'notes' => 'Injection plastique 150 tonnes. Production de composants pour l\'assemblage final.',
        ]);

        $machines[] = Machine::create([
            'nom' => 'Fraiseuse CNC X700',
            'reference' => 'CNC-X700-2023',
            'dateInstallation' => '2023-10-08',
            'etat' => 'opérationnelle',
            'criticite' => 'critique',
            'localisation' => 'Atelier A - Zone 4',
            'notes' => 'Machine jumelle de la X500 pour augmenter les capacités de production.',
        ]);

        $machines[] = Machine::create([
            'nom' => 'Tour CNC TC-400',
            'reference' => 'TC-400-2024',
            'dateInstallation' => '2024-02-14',
            'etat' => 'opérationnelle',
            'criticite' => 'critique',
            'localisation' => 'Atelier A - Zone 5',
            'notes' => 'Nouveau tour CNC haute performance. Contrôle numérique dernière génération.',
        ]);

        // MACHINES MOYENNES OPÉRATIONNELLES (6)
        $machines[] = Machine::create([
            'nom' => 'Plieuse CNC PC-400',
            'reference' => 'PC-400-2023',
            'dateInstallation' => '2023-08-30',
            'etat' => 'opérationnelle',
            'criticite' => 'moyen',
            'localisation' => 'Atelier C - Zone 2',
            'notes' => 'Pliage de tôles jusqu\'à 4mm d\'épaisseur et 4 mètres de longueur.',
        ]);

        $machines[] = Machine::create([
            'nom' => 'Cisaille guillotine CG-300',
            'reference' => 'CG-300-2020',
            'dateInstallation' => '2020-03-17',
            'etat' => 'opérationnelle',
            'criticite' => 'moyen',
            'localisation' => 'Atelier C - Zone 3',
            'notes' => 'Coupe de tôles jusqu\'à 3mm. Lame changée tous les 6 mois.',
        ]);

        $machines[] = Machine::create([
            'nom' => 'Meuleuse automatique MA-150',
            'reference' => 'MA-150-2021',
            'dateInstallation' => '2021-11-05',
            'etat' => 'opérationnelle',
            'criticite' => 'moyen',
            'localisation' => 'Atelier B - Zone 2',
            'notes' => 'Finition des pièces métalliques. Système d\'aspiration des poussières intégré.',
        ]);

        $machines[] = Machine::create([
            'nom' => 'Perceuse à colonne PC-25',
            'reference' => 'PC-25-2019',
            'dateInstallation' => '2019-06-12',
            'etat' => 'opérationnelle',
            'criticite' => 'moyen',
            'localisation' => 'Atelier B - Zone 1',
            'notes' => 'Perçage de précision pour diamètres jusqu\'à 25mm.',
        ]);

        $machines[] = Machine::create([
            'nom' => 'Polisseuse automatique PA-500',
            'reference' => 'PA-500-2022',
            'dateInstallation' => '2022-04-20',
            'etat' => 'opérationnelle',
            'criticite' => 'moyen',
            'localisation' => 'Atelier F - Zone 1',
            'notes' => 'Polissage et finition de surface. Utilisée en fin de chaîne de production.',
        ]);

        $machines[] = Machine::create([
            'nom' => 'Machine de contrôle CMM-1000',
            'reference' => 'CMM-1000-2023',
            'dateInstallation' => '2023-05-15',
            'etat' => 'opérationnelle',
            'criticite' => 'moyen',
            'localisation' => 'Laboratoire Qualité',
            'notes' => 'Machine de mesure tridimensionnelle. Contrôle qualité des pièces usinées.',
        ]);

        // MACHINES FAIBLES OPÉRATIONNELLES (4)
        $machines[] = Machine::create([
            'nom' => 'Perceuse radiale PR-800',
            'reference' => 'PR-800-2020',
            'dateInstallation' => '2020-09-12',
            'etat' => 'opérationnelle',
            'criticite' => 'faible',
            'localisation' => 'Atelier B - Zone 3',
            'notes' => 'Utilisation ponctuelle pour perçages spéciaux et prototypes.',
        ]);

        $machines[] = Machine::create([
            'nom' => 'Affûteuse d\'outils AO-100',
            'reference' => 'AO-100-2018',
            'dateInstallation' => '2018-07-22',
            'etat' => 'opérationnelle',
            'criticite' => 'faible',
            'localisation' => 'Atelier Outillage',
            'notes' => 'Affûtage des outils de coupe. Utilisée par les techniciens d\'outillage.',
        ]);

        $machines[] = Machine::create([
            'nom' => 'Scie circulaire SC-350',
            'reference' => 'SC-350-2019',
            'dateInstallation' => '2019-10-30',
            'etat' => 'opérationnelle',
            'criticite' => 'faible',
            'localisation' => 'Atelier B - Zone 4',
            'notes' => 'Découpe de barres métalliques. Usage occasionnel.',
        ]);

        $machines[] = Machine::create([
            'nom' => 'Étau-limeur EL-200',
            'reference' => 'EL-200-2017',
            'dateInstallation' => '2017-03-08',
            'etat' => 'opérationnelle',
            'criticite' => 'faible',
            'localisation' => 'Atelier B - Zone 5',
            'notes' => 'Machine ancienne utilisée pour des travaux spécifiques. Peu sollicitée.',
        ]);

        // MACHINES EN MAINTENANCE (3)
        $machines[] = Machine::create([
            'nom' => 'Presse hydraulique PH-250',
            'reference' => 'PH-250-2021',
            'dateInstallation' => '2021-06-10',
            'etat' => 'en_maintenance',
            'criticite' => 'moyen',
            'localisation' => 'Atelier B - Zone 1',
            'notes' => 'Maintenance préventive en cours. Remplacement des joints hydrauliques et vérification complète.',
        ]);

        $machines[] = Machine::create([
            'nom' => 'Fraiseuse universelle FU-300',
            'reference' => 'FU-300-2020',
            'dateInstallation' => '2020-08-15',
            'etat' => 'en_maintenance',
            'criticite' => 'moyen',
            'localisation' => 'Atelier A - Zone 6',
            'notes' => 'Révision générale annuelle. Changement des roulements et contrôle de la géométrie.',
        ]);

        $machines[] = Machine::create([
            'nom' => 'Compresseur d\'air CA-5000',
            'reference' => 'CA-5000-2019',
            'dateInstallation' => '2019-12-01',
            'etat' => 'en_maintenance',
            'criticite' => 'critique',
            'localisation' => 'Local Technique',
            'notes' => 'Maintenance trimestrielle. Vidange et contrôle du système de filtration.',
        ]);

        // MACHINES EN PANNE (2)
        $machines[] = Machine::create([
            'nom' => 'Rectifieuse plane RP-1200',
            'reference' => 'RP-1200-2019',
            'dateInstallation' => '2019-04-22',
            'etat' => 'en_panne',
            'criticite' => 'moyen',
            'localisation' => 'Atelier A - Zone 3',
            'notes' => 'Panne du système de refroidissement. Circuit défectueux. Pièces en commande ETA 5 jours.',
        ]);

        $machines[] = Machine::create([
            'nom' => 'Électro-érosion EE-400',
            'reference' => 'EE-400-2020',
            'dateInstallation' => '2020-07-18',
            'etat' => 'en_panne',
            'criticite' => 'critique',
            'localisation' => 'Atelier A - Zone 7',
            'notes' => 'Problème électrique majeur. Court-circuit sur le générateur. Attente intervention constructeur.',
        ]);

        // MACHINES HORS SERVICE (2)
        $machines[] = Machine::create([
            'nom' => 'Scie à ruban SR-600',
            'reference' => 'SR-600-2018',
            'dateInstallation' => '2018-12-05',
            'etat' => 'hors_service',
            'criticite' => 'faible',
            'localisation' => 'Atelier B - Zone 4',
            'notes' => 'Fin de vie. Remplacée par SC-350. Démantèlement prévu Q2 2026.',
        ]);

        $machines[] = Machine::create([
            'nom' => 'Tour conventionnel TC-150',
            'reference' => 'TC-150-2015',
            'dateInstallation' => '2015-02-10',
            'etat' => 'hors_service',
            'criticite' => 'faible',
            'localisation' => 'Zone de stockage',
            'notes' => 'Obsolète. Remplacé par les tours CNC. En attente de revente.',
        ]);

        echo "✅ 25 machines créées\n\n";

        // ============================================
        // 3. INTERVENTIONS (40 interventions)
        // ============================================
        echo "🔧 Création des interventions...\n";

        // INTERVENTIONS TERMINÉES (20)
        Intervention::create([
            'dateHeureDebut' => Carbon::now()->subDays(30)->setTime(8, 0),
            'dateHeureFin' => Carbon::now()->subDays(30)->setTime(12, 0),
            'description' => 'Maintenance préventive trimestrielle complète',
            'statut' => 'terminee',
            'commentaire' => 'Tous les points de contrôle validés. Aucune anomalie détectée. Machine opérationnelle.',
            'idMachine' => $machines[0]->idMachine,
            'idUser' => $technicien1->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->subDays(28)->setTime(14, 0),
            'dateHeureFin' => Carbon::now()->subDays(28)->setTime(17, 30),
            'description' => 'Changement des outils de coupe usés et calibration',
            'statut' => 'terminee',
            'commentaire' => 'Remplacement de 8 outils. Calibration effectuée avec succès. Précision rétablie.',
            'idMachine' => $machines[1]->idMachine,
            'idUser' => $technicien2->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->subDays(25)->setTime(9, 0),
            'dateHeureFin' => Carbon::now()->subDays(25)->setTime(11, 0),
            'description' => 'Nettoyage et vérification des optiques laser',
            'statut' => 'terminee',
            'commentaire' => 'Optiques nettoyées. Puissance laser vérifiée et conforme. Tests de découpe OK.',
            'idMachine' => $machines[2]->idMachine,
            'idUser' => $technicien3->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->subDays(22)->setTime(10, 30),
            'dateHeureFin' => Carbon::now()->subDays(22)->setTime(14, 0),
            'description' => 'Réglage de la précision d\'usinage 5 axes',
            'statut' => 'terminee',
            'commentaire' => 'Calibration des 5 axes effectuée. Précision rétablie à ±0.005mm. Machine performante.',
            'idMachine' => $machines[3]->idMachine,
            'idUser' => $technicien1->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->subDays(20)->setTime(8, 0),
            'dateHeureFin' => Carbon::now()->subDays(20)->setTime(10, 30),
            'description' => 'Mise à jour du programme de soudure',
            'statut' => 'terminee',
            'commentaire' => 'Nouveau programme installé et testé. Trajectoire optimisée. Gain de 15% sur le temps de cycle.',
            'idMachine' => $machines[4]->idMachine,
            'idUser' => $technicien4->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->subDays(18)->setTime(13, 0),
            'dateHeureFin' => Carbon::now()->subDays(18)->setTime(16, 45),
            'description' => 'Contrôle du système de refroidissement injection',
            'statut' => 'terminee',
            'commentaire' => 'Circuit de refroidissement vérifié. Température stabilisée. Ajout de fluide frigorigène.',
            'idMachine' => $machines[5]->idMachine,
            'idUser' => $technicien5->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->subDays(16)->setTime(9, 30),
            'dateHeureFin' => Carbon::now()->subDays(16)->setTime(12, 0),
            'description' => 'Remplacement de la courroie de transmission',
            'statut' => 'terminee',
            'commentaire' => 'Ancienne courroie remplacée. Tension ajustée. Vibrations éliminées.',
            'idMachine' => $machines[8]->idMachine,
            'idUser' => $technicien6->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->subDays(14)->setTime(14, 0),
            'dateHeureFin' => Carbon::now()->subDays(14)->setTime(15, 30),
            'description' => 'Graissage et entretien général des glissières',
            'statut' => 'terminee',
            'commentaire' => 'Graissage effectué selon procédure. Glissement fluide rétabli.',
            'idMachine' => $machines[15]->idMachine,
            'idUser' => $technicien7->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->subDays(12)->setTime(8, 0),
            'dateHeureFin' => Carbon::now()->subDays(12)->setTime(10, 0),
            'description' => 'Changement de la lame de cisaille',
            'statut' => 'terminee',
            'commentaire' => 'Nouvelle lame installée. Coupe nette et précise. Tests sur différentes épaisseurs validés.',
            'idMachine' => $machines[9]->idMachine,
            'idUser' => $technicien8->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->subDays(10)->setTime(10, 0),
            'dateHeureFin' => Carbon::now()->subDays(10)->setTime(12, 30),
            'description' => 'Remplacement des disques de meulage',
            'statut' => 'terminee',
            'commentaire' => 'Disques usés remplacés. Système d\'aspiration vérifié et nettoyé.',
            'idMachine' => $machines[10]->idMachine,
            'idUser' => $technicien1->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->subDays(9)->setTime(13, 30),
            'dateHeureFin' => Carbon::now()->subDays(9)->setTime(15, 0),
            'description' => 'Calibration de la machine de mesure CMM',
            'statut' => 'terminee',
            'commentaire' => 'Calibration annuelle effectuée avec étalons certifiés. Certificat de conformité émis.',
            'idMachine' => $machines[13]->idMachine,
            'idUser' => $responsable1->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->subDays(8)->setTime(9, 0),
            'dateHeureFin' => Carbon::now()->subDays(8)->setTime(11, 0),
            'description' => 'Réparation du mandrin de perçage',
            'statut' => 'terminee',
            'commentaire' => 'Mandrin démonté, nettoyé et remonté. Centrage vérifié. Serrage optimal.',
            'idMachine' => $machines[11]->idMachine,
            'idUser' => $technicien3->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->subDays(7)->setTime(14, 0),
            'dateHeureFin' => Carbon::now()->subDays(7)->setTime(16, 30),
            'description' => 'Changement des bandes abrasives de polissage',
            'statut' => 'terminee',
            'commentaire' => 'Bandes usées remplacées. Vitesse de rotation ajustée. Qualité de finition améliorée.',
            'idMachine' => $machines[12]->idMachine,
            'idUser' => $technicien4->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->subDays(6)->setTime(8, 30),
            'dateHeureFin' => Carbon::now()->subDays(6)->setTime(10, 0),
            'description' => 'Affûtage des forets de perçage radiale',
            'statut' => 'terminee',
            'commentaire' => 'Lot de 12 forets affûtés. Angles de coupe contrôlés. Prêts pour utilisation.',
            'idMachine' => $machines[14]->idMachine,
            'idUser' => $technicien5->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->subDays(5)->setTime(11, 0),
            'dateHeureFin' => Carbon::now()->subDays(5)->setTime(12, 30),
            'description' => 'Remplacement de la lame de scie circulaire',
            'statut' => 'terminee',
            'commentaire' => 'Lame carbure installée. Alignement vérifié. Coupe propre et rapide.',
            'idMachine' => $machines[16]->idMachine,
            'idUser' => $technicien6->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->subDays(4)->setTime(9, 0),
            'dateHeureFin' => Carbon::now()->subDays(4)->setTime(11, 0),
            'description' => 'Maintenance de l\'étau-limeur',
            'statut' => 'terminee',
            'commentaire' => 'Graissage général. Courroies vérifiées. Machine fonctionnelle malgré son âge.',
            'idMachine' => $machines[17]->idMachine,
            'idUser' => $technicien7->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->subDays(3)->setTime(13, 0),
            'dateHeureFin' => Carbon::now()->subDays(3)->setTime(16, 0),
            'description' => 'Contrôle qualité post-installation',
            'statut' => 'terminee',
            'commentaire' => 'Tests complets effectués. Machine conforme aux spécifications. Mise en production validée.',
            'idMachine' => $machines[2]->idMachine,
            'idUser' => $responsable2->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->subDays(2)->setTime(8, 0),
            'dateHeureFin' => Carbon::now()->subDays(2)->setTime(9, 30),
            'description' => 'Vérification des systèmes de sécurité',
            'statut' => 'terminee',
            'commentaire' => 'Arrêts d\'urgence testés. Capteurs de sécurité fonctionnels. Conformité réglementaire OK.',
            'idMachine' => $machines[6]->idMachine,
            'idUser' => $technicien8->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->subDays(1)->setTime(10, 0),
            'dateHeureFin' => Carbon::now()->subDays(1)->setTime(11, 30),
            'description' => 'Mise à jour du logiciel de contrôle CNC',
            'statut' => 'terminee',
            'commentaire' => 'Firmware mis à jour vers version 4.2.1. Nouvelles fonctionnalités activées. Tests OK.',
            'idMachine' => $machines[7]->idMachine,
            'idUser' => $technicien2->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->subHours(5),
            'dateHeureFin' => Carbon::now()->subHours(3),
            'description' => 'Remplacement d\'un capteur de température défectueux',
            'statut' => 'terminee',
            'commentaire' => 'Ancien capteur remplacé. Température surveillée correctement. Alarme testée.',
            'idMachine' => $machines[5]->idMachine,
            'idUser' => $technicien1->id,
        ]);

        // INTERVENTIONS EN COURS (8)
        Intervention::create([
            'dateHeureDebut' => Carbon::now()->subHours(4),
            'dateHeureFin' => Carbon::now()->addHours(2),
            'description' => 'Remplacement des joints hydrauliques de la presse',
            'statut' => 'en_cours',
            'commentaire' => 'Démontage terminé. Nettoyage des circuits en cours. Installation des nouveaux joints prévue cet après-midi.',
            'idMachine' => $machines[18]->idMachine,
            'idUser' => $technicien3->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->subHours(3),
            'dateHeureFin' => Carbon::now()->addHours(3),
            'description' => 'Révision générale annuelle',
            'statut' => 'en_cours',
            'commentaire' => 'Changement des roulements en cours. 60% de la révision effectuée.',
            'idMachine' => $machines[19]->idMachine,
            'idUser' => $technicien4->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->subHours(2),
            'dateHeureFin' => Carbon::now()->addHours(4),
            'description' => 'Maintenance trimestrielle du compresseur',
            'statut' => 'en_cours',
            'commentaire' => 'Vidange effectuée. Filtres changés. Contrôle de la pression en cours.',
            'idMachine' => $machines[20]->idMachine,
            'idUser' => $technicien5->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->subHour(),
            'dateHeureFin' => Carbon::now()->addHours(5),
            'description' => 'Diagnostic et réparation du système de refroidissement',
            'statut' => 'en_cours',
            'commentaire' => 'Fuite localisée au niveau du circuit principal. Commande de pièces urgente effectuée.',
            'idMachine' => $machines[21]->idMachine,
            'idUser' => $technicien6->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->subMinutes(30),
            'dateHeureFin' => Carbon::now()->addHours(6),
            'description' => 'Réparation du générateur électrique (court-circuit)',
            'statut' => 'en_cours',
            'commentaire' => 'Technicien constructeur sur site. Diagnostic en cours. Pièces spéciales nécessaires.',
            'idMachine' => $machines[22]->idMachine,
            'idUser' => $responsable3->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now(),
            'dateHeureFin' => Carbon::now()->addHours(2),
            'description' => 'Contrôle de routine hebdomadaire',
            'statut' => 'en_cours',
            'commentaire' => 'Inspection en cours. Vérification des niveaux et des paramètres de fonctionnement.',
            'idMachine' => $machines[0]->idMachine,
            'idUser' => $technicien7->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now(),
            'dateHeureFin' => Carbon::now()->addHours(3),
            'description' => 'Nettoyage complet et préparation pour certification',
            'statut' => 'en_cours',
            'commentaire' => 'Nettoyage approfondi en préparation de l\'audit qualité de la semaine prochaine.',
            'idMachine' => $machines[13]->idMachine,
            'idUser' => $technicien8->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->addMinutes(30),
            'dateHeureFin' => Carbon::now()->addHours(4),
            'description' => 'Optimisation des paramètres de soudure',
            'statut' => 'en_cours',
            'commentaire' => 'Tests de différents réglages pour améliorer la qualité des soudures sur nouvelles pièces.',
            'idMachine' => $machines[4]->idMachine,
            'idUser' => $technicien2->id,
        ]);

        // INTERVENTIONS EN ATTENTE (12)
        Intervention::create([
            'dateHeureDebut' => Carbon::now()->addHours(6),
            'dateHeureFin' => Carbon::now()->addHours(8),
            'description' => 'Inspection des systèmes pneumatiques',
            'statut' => 'en_attente',
            'commentaire' => null,
            'idMachine' => $machines[1]->idMachine,
            'idUser' => $technicien1->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->addDay()->setTime(8, 0),
            'dateHeureFin' => Carbon::now()->addDay()->setTime(10, 0),
            'description' => 'Changement des filtres à air',
            'statut' => 'en_attente',
            'commentaire' => null,
            'idMachine' => $machines[20]->idMachine,
            'idUser' => $technicien2->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->addDay()->setTime(13, 0),
            'dateHeureFin' => Carbon::now()->addDay()->setTime(15, 30),
            'description' => 'Test de charge et performance',
            'statut' => 'en_attente',
            'commentaire' => null,
            'idMachine' => $machines[7]->idMachine,
            'idUser' => $responsable1->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->addDays(2)->setTime(9, 0),
            'dateHeureFin' => Carbon::now()->addDays(2)->setTime(11, 0),
            'description' => 'Vérification de l\'alignement des axes',
            'statut' => 'en_attente',
            'commentaire' => null,
            'idMachine' => $machines[3]->idMachine,
            'idUser' => $technicien3->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->addDays(2)->setTime(14, 0),
            'dateHeureFin' => Carbon::now()->addDays(2)->setTime(16, 0),
            'description' => 'Remplacement préventif des flexibles hydrauliques',
            'statut' => 'en_attente',
            'commentaire' => null,
            'idMachine' => $machines[18]->idMachine,
            'idUser' => $technicien4->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->addDays(3)->setTime(8, 30),
            'dateHeureFin' => Carbon::now()->addDays(3)->setTime(12, 0),
            'description' => 'Formation du personnel sur les nouvelles fonctionnalités',
            'statut' => 'en_attente',
            'commentaire' => null,
            'idMachine' => $machines[2]->idMachine,
            'idUser' => $responsable2->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->addDays(4)->setTime(10, 0),
            'dateHeureFin' => Carbon::now()->addDays(4)->setTime(12, 30),
            'description' => 'Contrôle des niveaux d\'huile et de fluides',
            'statut' => 'en_attente',
            'commentaire' => null,
            'idMachine' => $machines[6]->idMachine,
            'idUser' => $technicien5->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->addDays(5)->setTime(9, 0),
            'dateHeureFin' => Carbon::now()->addDays(5)->setTime(10, 30),
            'description' => 'Mise à jour du logiciel de gestion',
            'statut' => 'en_attente',
            'commentaire' => null,
            'idMachine' => $machines[8]->idMachine,
            'idUser' => $technicien6->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->addDays(6)->setTime(14, 0),
            'dateHeureFin' => Carbon::now()->addDays(6)->setTime(17, 0),
            'description' => 'Audit de sécurité annuel',
            'statut' => 'en_attente',
            'commentaire' => null,
            'idMachine' => $machines[5]->idMachine,
            'idUser' => $responsable3->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->addWeek()->setTime(8, 0),
            'dateHeureFin' => Carbon::now()->addWeek()->setTime(11, 0),
            'description' => 'Remplacement des guides de coupe',
            'statut' => 'en_attente',
            'commentaire' => null,
            'idMachine' => $machines[9]->idMachine,
            'idUser' => $technicien7->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->addWeek()->setTime(13, 30),
            'dateHeureFin' => Carbon::now()->addWeek()->setTime(15, 30),
            'description' => 'Inspection visuelle complète',
            'statut' => 'en_attente',
            'commentaire' => null,
            'idMachine' => $machines[12]->idMachine,
            'idUser' => $technicien8->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->addWeek()->addDays(2)->setTime(10, 0),
            'dateHeureFin' => Carbon::now()->addWeek()->addDays(2)->setTime(12, 0),
            'description' => 'Contrôle électrique et sécurité',
            'statut' => 'en_attente',
            'commentaire' => null,
            'idMachine' => $machines[4]->idMachine,
            'idUser' => $responsable4->id,
        ]);

        echo "✅ 40 interventions créées (20 terminées, 8 en cours, 12 en attente)\n\n";

        // ============================================
        // 4. INTERVENTIONS PLANIFIÉES (15)
        // ============================================
        echo "📅 Création des interventions planifiées...\n";

        $planifications = [];

        // MAINTENANCE PRÉVENTIVE
        $planifications[] = InterventionPlanifiee::create([
            'dateDebut' => Carbon::now()->addWeek()->setTime(8, 0),
            'dateFin' => Carbon::now()->addWeek()->setTime(12, 0),
            'type' => 'preventive',
            'description' => 'Maintenance préventive trimestrielle complète - Vérification de tous les systèmes critiques',
            'statut' => 'planifiee',
            'frequence' => 'trimestrielle',
            'idMachine' => $machines[0]->idMachine,
        ]);

        $planifications[] = InterventionPlanifiee::create([
            'dateDebut' => Carbon::now()->addWeek()->setTime(13, 0),
            'dateFin' => Carbon::now()->addWeek()->setTime(17, 0),
            'type' => 'preventive',
            'description' => 'Maintenance préventive trimestrielle - Contrôle du système de tournage et lubrification',
            'statut' => 'planifiee',
            'frequence' => 'trimestrielle',
            'idMachine' => $machines[1]->idMachine,
        ]);

        $planifications[] = InterventionPlanifiee::create([
            'dateDebut' => Carbon::now()->addDays(3)->setTime(10, 0),
            'dateFin' => Carbon::now()->addDays(3)->setTime(11, 30),
            'type' => 'preventive',
            'description' => 'Vérification hebdomadaire des paramètres laser et état des optiques',
            'statut' => 'planifiee',
            'frequence' => 'hebdomadaire',
            'idMachine' => $machines[2]->idMachine,
        ]);

        $planifications[] = InterventionPlanifiee::create([
            'dateDebut' => Carbon::now()->addDays(10)->setTime(8, 0),
            'dateFin' => Carbon::now()->addDays(10)->setTime(12, 0),
            'type' => 'preventive',
            'description' => 'Maintenance mensuelle - Graissage, vérification des outils et calibration',
            'statut' => 'planifiee',
            'frequence' => 'mensuelle',
            'idMachine' => $machines[3]->idMachine,
        ]);

        $planifications[] = InterventionPlanifiee::create([
            'dateDebut' => Carbon::now()->addDays(14)->setTime(9, 0),
            'dateFin' => Carbon::now()->addDays(14)->setTime(11, 0),
            'type' => 'preventive',
            'description' => 'Contrôle mensuel du robot - Trajectoires, capteurs et système de soudure',
            'statut' => 'planifiee',
            'frequence' => 'mensuelle',
            'idMachine' => $machines[4]->idMachine,
        ]);

        // CALIBRATION
        $planifications[] = InterventionPlanifiee::create([
            'dateDebut' => Carbon::now()->addDays(15)->setTime(14, 0),
            'dateFin' => Carbon::now()->addDays(15)->setTime(17, 0),
            'type' => 'calibration',
            'description' => 'Calibration annuelle complète - Tous les axes et capteurs de précision',
            'statut' => 'planifiee',
            'frequence' => 'annuelle',
            'idMachine' => $machines[1]->idMachine,
        ]);

        $planifications[] = InterventionPlanifiee::create([
            'dateDebut' => Carbon::now()->addDays(21)->setTime(9, 0),
            'dateFin' => Carbon::now()->addDays(21)->setTime(12, 0),
            'type' => 'calibration',
            'description' => 'Calibration semestrielle avec étalons certifiés - CMM',
            'statut' => 'planifiee',
            'frequence' => 'annuelle',
            'idMachine' => $machines[13]->idMachine,
        ]);

        $planifications[] = InterventionPlanifiee::create([
            'dateDebut' => Carbon::now()->addMonth()->setTime(10, 0),
            'dateFin' => Carbon::now()->addMonth()->setTime(13, 0),
            'type' => 'calibration',
            'description' => 'Recalibration des paramètres d\'injection et contrôle température',
            'statut' => 'planifiee',
            'frequence' => 'trimestrielle',
            'idMachine' => $machines[5]->idMachine,
        ]);

        // CONTRÔLE PÉRIODIQUE
        $planifications[] = InterventionPlanifiee::create([
            'dateDebut' => Carbon::now()->addMonth()->setTime(9, 0),
            'dateFin' => Carbon::now()->addMonth()->setTime(16, 0),
            'type' => 'controle_periodique',
            'description' => 'Contrôle réglementaire annuel de sécurité - Organisme agréé',
            'statut' => 'planifiee',
            'frequence' => 'annuelle',
            'idMachine' => $machines[18]->idMachine,
        ]);

        $planifications[] = InterventionPlanifiee::create([
            'dateDebut' => Carbon::now()->addMonth()->addDays(5)->setTime(8, 30),
            'dateFin' => Carbon::now()->addMonth()->addDays(5)->setTime(17, 0),
            'type' => 'controle_periodique',
            'description' => 'Contrôle réglementaire annuel - Compresseur sous pression',
            'statut' => 'planifiee',
            'frequence' => 'annuelle',
            'idMachine' => $machines[20]->idMachine,
        ]);

        $planifications[] = InterventionPlanifiee::create([
            'dateDebut' => Carbon::now()->addDays(7)->setTime(14, 0),
            'dateFin' => Carbon::now()->addDays(7)->setTime(16, 0),
            'type' => 'controle_periodique',
            'description' => 'Contrôle mensuel des dispositifs de sécurité et arrêts d\'urgence',
            'statut' => 'planifiee',
            'frequence' => 'mensuelle',
            'idMachine' => $machines[6]->idMachine,
        ]);

        // AMÉLIORATION
        $planifications[] = InterventionPlanifiee::create([
            'dateDebut' => Carbon::now()->addDays(20)->setTime(13, 0),
            'dateFin' => Carbon::now()->addDays(20)->setTime(18, 0),
            'type' => 'amelioration',
            'description' => 'Installation d\'un nouveau système de lubrification automatique pour optimiser la durée de vie',
            'statut' => 'planifiee',
            'frequence' => 'ponctuelle',
            'idMachine' => $machines[8]->idMachine,
        ]);

        $planifications[] = InterventionPlanifiee::create([
            'dateDebut' => Carbon::now()->addMonth()->addDays(10)->setTime(8, 0),
            'dateFin' => Carbon::now()->addMonth()->addDays(10)->setTime(17, 0),
            'type' => 'amelioration',
            'description' => 'Upgrade du système de contrôle vers nouvelle version avec interface tactile',
            'statut' => 'planifiee',
            'frequence' => 'ponctuelle',
            'idMachine' => $machines[7]->idMachine,
        ]);

        $planifications[] = InterventionPlanifiee::create([
            'dateDebut' => Carbon::now()->addMonth()->addDays(15)->setTime(9, 0),
            'dateFin' => Carbon::now()->addMonth()->addDays(16)->setTime(17, 0),
            'type' => 'amelioration',
            'description' => 'Installation d\'un système de surveillance en temps réel (IoT) pour monitoring à distance',
            'statut' => 'planifiee',
            'frequence' => 'ponctuelle',
            'idMachine' => $machines[0]->idMachine,
        ]);

        $planifications[] = InterventionPlanifiee::create([
            'dateDebut' => Carbon::now()->addWeeks(3)->setTime(10, 0),
            'dateFin' => Carbon::now()->addWeeks(3)->setTime(15, 0),
            'type' => 'amelioration',
            'description' => 'Remplacement du système d\'aspiration par un modèle plus performant et silencieux',
            'statut' => 'planifiee',
            'frequence' => 'ponctuelle',
            'idMachine' => $machines[10]->idMachine,
        ]);

        echo "✅ 15 interventions planifiées créées\n\n";

        // ============================================
        // 5. ASSOCIATIONS TECHNICIENS
        // ============================================
        echo "🔗 Création des associations techniciens...\n";

        // Planification 1 - 2 techniciens
        $planifications[0]->techniciens()->attach([$technicien1->id, $technicien2->id]);

        // Planification 2 - 2 techniciens
        $planifications[1]->techniciens()->attach([$technicien2->id, $technicien3->id]);

        // Planification 3 - 1 technicien
        $planifications[2]->techniciens()->attach([$technicien4->id]);

        // Planification 4 - 1 technicien
        $planifications[3]->techniciens()->attach([$technicien1->id]);

        // Planification 5 - 2 techniciens
        $planifications[4]->techniciens()->attach([$technicien5->id, $technicien6->id]);

        // Planification 6 - 1 technicien + 1 responsable
        $planifications[5]->techniciens()->attach([$technicien2->id]);

        // Planification 7 - 1 technicien
        $planifications[6]->techniciens()->attach([$technicien7->id]);

        // Planification 8 - 2 techniciens
        $planifications[7]->techniciens()->attach([$technicien3->id, $technicien4->id]);

        // Planification 9 - Contrôle externe (responsable)
        $planifications[8]->techniciens()->attach([$responsable1->id]);

        // Planification 10 - Contrôle externe (responsable)
        $planifications[9]->techniciens()->attach([$responsable2->id]);

        // Planification 11 - 1 technicien
        $planifications[10]->techniciens()->attach([$technicien8->id]);

        // Planification 12 - 2 techniciens
        $planifications[11]->techniciens()->attach([$technicien1->id, $technicien5->id]);

        // Planification 13 - 3 techniciens (gros projet)
        $planifications[12]->techniciens()->attach([$technicien2->id, $technicien6->id, $technicien7->id]);

        // Planification 14 - 3 techniciens (IoT)
        $planifications[13]->techniciens()->attach([$technicien1->id, $technicien3->id, $technicien8->id]);

        // Planification 15 - 2 techniciens
        $planifications[14]->techniciens()->attach([$technicien4->id, $technicien5->id]);

        echo "✅ Associations techniciens créées\n\n";

        // ============================================
        // 6. RÉCAPITULATIF
        // ============================================
        echo "═══════════════════════════════════════════════════════\n";
        echo "🎉 SEEDING TERMINÉ AVEC SUCCÈS !\n";
        echo "═══════════════════════════════════════════════════════\n\n";

        echo "📊 RÉCAPITULATIF DES DONNÉES CRÉÉES :\n";
        echo "─────────────────────────────────────────────────────\n";
        echo "👥 Utilisateurs : 17\n";
        echo "   • Admins : 2\n";
        echo "   • Direction : 3\n";
        echo "   • Responsables : 4\n";
        echo "   • Techniciens : 8\n\n";

        echo "🏭 Machines : 25\n";
        echo "   • Opérationnelles : 18 (8 critiques, 6 moyennes, 4 faibles)\n";
        echo "   • En maintenance : 3\n";
        echo "   • En panne : 2\n";
        echo "   • Hors service : 2\n\n";

        echo "🔧 Interventions : 40\n";
        echo "   • Terminées : 20\n";
        echo "   • En cours : 8\n";
        echo "   • En attente : 12\n\n";

        echo "📅 Interventions planifiées : 15\n";
        echo "   • Préventives : 5\n";
        echo "   • Calibrations : 3\n";
        echo "   • Contrôles périodiques : 3\n";
        echo "   • Améliorations : 4\n\n";

        echo "═══════════════════════════════════════════════════════\n";
        echo "🔐 COMPTES DE TEST (mot de passe : 'password') :\n";
        echo "─────────────────────────────────────────────────────\n";
        echo "👑 Admin       : admin@whotouchedit.fr\n";
        echo "💼 Direction   : direction@whotouchedit.fr\n";
        echo "📋 Responsable : responsable@whotouchedit.fr\n";
        echo "🔧 Technicien  : technicien@whotouchedit.fr\n";
        echo "═══════════════════════════════════════════════════════\n";
    }
}
