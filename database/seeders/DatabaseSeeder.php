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
        // ============================================
        // 1. USERS (avec rôles)
        // ============================================

        $admin = User::create([
            'nom' => 'Admin',
            'prenom' => 'Système',
            'email' => 'admin@whotouchedit.fr',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $direction = User::create([
            'nom' => 'Dupont',
            'prenom' => 'Marie',
            'email' => 'marie.dupont@whotouchedit.fr',
            'password' => Hash::make('password'),
            'role' => 'direction',
        ]);

        $responsable = User::create([
            'nom' => 'Martin',
            'prenom' => 'Pierre',
            'email' => 'pierre.martin@whotouchedit.fr',
            'password' => Hash::make('password'),
            'role' => 'responsable',
        ]);

        $technicien1 = User::create([
            'nom' => 'Bernard',
            'prenom' => 'Sophie',
            'email' => 'sophie.bernard@whotouchedit.fr',
            'password' => Hash::make('password'),
            'role' => 'technicien',
        ]);

        $technicien2 = User::create([
            'nom' => 'Leroy',
            'prenom' => 'Thomas',
            'email' => 'thomas.leroy@whotouchedit.fr',
            'password' => Hash::make('password'),
            'role' => 'technicien',
        ]);

        $technicien3 = User::create([
            'nom' => 'Moreau',
            'prenom' => 'Julie',
            'email' => 'julie.moreau@whotouchedit.fr',
            'password' => Hash::make('password'),
            'role' => 'technicien',
        ]);

        echo "✅ 6 utilisateurs créés\n";

        // ============================================
        // 2. MACHINES
        // ============================================

        $machine1 = Machine::create([
            'nom' => 'Fraiseuse CNC X500',
            'reference' => 'CNC-X500-2023',
            'dateInstallation' => '2023-03-15',
            'etat' => 'opérationnelle',
            'criticite' => 'critique',
            'localisation' => 'Atelier A - Zone 1',
            'notes' => 'Machine principale pour la production de pièces de haute précision',
        ]);

        $machine2 = Machine::create([
            'nom' => 'Tour automatique TA-3000',
            'reference' => 'TA-3000-2022',
            'dateInstallation' => '2022-11-20',
            'etat' => 'opérationnelle',
            'criticite' => 'critique',
            'localisation' => 'Atelier A - Zone 2',
            'notes' => 'Capacité de tournage jusqu\'à 300mm de diamètre',
        ]);

        $machine3 = Machine::create([
            'nom' => 'Presse hydraulique PH-250',
            'reference' => 'PH-250-2021',
            'dateInstallation' => '2021-06-10',
            'etat' => 'en_maintenance',
            'criticite' => 'moyen',
            'localisation' => 'Atelier B - Zone 1',
            'notes' => 'Maintenance préventive en cours - Remplacement des joints',
        ]);

        $machine4 = Machine::create([
            'nom' => 'Découpe laser DL-5000',
            'reference' => 'DL-5000-2024',
            'dateInstallation' => '2024-01-05',
            'etat' => 'opérationnelle',
            'criticite' => 'critique',
            'localisation' => 'Atelier C - Zone 1',
            'notes' => 'Nouvelle installation - Capacité de découpe 5000W',
        ]);

        $machine5 = Machine::create([
            'nom' => 'Perceuse radiale PR-800',
            'reference' => 'PR-800-2020',
            'dateInstallation' => '2020-09-12',
            'etat' => 'opérationnelle',
            'criticite' => 'faible',
            'localisation' => 'Atelier B - Zone 3',
            'notes' => 'Utilisation ponctuelle pour perçages spéciaux',
        ]);

        $machine6 = Machine::create([
            'nom' => 'Rectifieuse plane RP-1200',
            'reference' => 'RP-1200-2019',
            'dateInstallation' => '2019-04-22',
            'etat' => 'en_panne',
            'criticite' => 'moyen',
            'localisation' => 'Atelier A - Zone 3',
            'notes' => 'Problème sur le système de refroidissement - Pièces en commande',
        ]);

        $machine7 = Machine::create([
            'nom' => 'Plieuse CNC PC-400',
            'reference' => 'PC-400-2023',
            'dateInstallation' => '2023-08-30',
            'etat' => 'opérationnelle',
            'criticite' => 'moyen',
            'localisation' => 'Atelier C - Zone 2',
            'notes' => 'Pliage de tôles jusqu\'à 4mm d\'épaisseur',
        ]);

        $machine8 = Machine::create([
            'nom' => 'Scie à ruban SR-600',
            'reference' => 'SR-600-2018',
            'dateInstallation' => '2018-12-05',
            'etat' => 'hors_service',
            'criticite' => 'faible',
            'localisation' => 'Atelier B - Zone 4',
            'notes' => 'À remplacer - Fin de vie prévue Q2 2025',
        ]);

        echo "✅ 8 machines créées\n";

        // ============================================
        // 3. INTERVENTIONS
        // ============================================

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->subDays(5)->setTime(8, 0),
            'dateHeureFin' => Carbon::now()->subDays(5)->setTime(10, 30),
            'description' => 'Changement des outils de coupe usés',
            'statut' => 'terminee',
            'commentaire' => 'Remplacement effectué avec succès. Machine opérationnelle.',
            'idMachine' => $machine1->idMachine,
            'idUser' => $technicien1->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->subDays(3)->setTime(14, 0),
            'dateHeureFin' => Carbon::now()->subDays(3)->setTime(16, 45),
            'description' => 'Réglage de la précision d\'usinage',
            'statut' => 'terminee',
            'commentaire' => 'Calibration effectuée. Précision rétablie à ±0.01mm',
            'idMachine' => $machine2->idMachine,
            'idUser' => $technicien2->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->subDay(1)->setTime(9, 0),
            'dateHeureFin' => Carbon::now()->subDays(1)->setTime(10, 45),
            'description' => 'Remplacement des joints hydrauliques',
            'statut' => 'en_cours',
            'commentaire' => 'Démontage terminé. En attente des nouvelles pièces.',
            'idMachine' => $machine3->idMachine,
            'idUser' => $technicien1->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->subDays(2)->setTime(8, 30),
            'dateHeureFin' => Carbon::now()->subDays(2)->setTime(11, 45),
            'description' => 'Diagnostic du système de refroidissement',
            'statut' => 'en_cours',
            'commentaire' => 'Fuite détectée au niveau du circuit principal',
            'idMachine' => $machine6->idMachine,
            'idUser' => $technicien3->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->addDays(2)->setTime(10, 0),
            'dateHeureFin' => Carbon::now()->addDay(2)->setTime(13, 45),
            'description' => 'Contrôle qualité post-installation',
            'statut' => 'en_attente',
            'commentaire' => null,
            'idMachine' => $machine4->idMachine,
            'idUser' => $responsable->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->subDays(10)->setTime(13, 0),
            'dateHeureFin' => Carbon::now()->subDays(10)->setTime(14, 30),
            'description' => 'Graissage et entretien général',
            'statut' => 'terminee',
            'commentaire' => 'Entretien de routine effectué',
            'idMachine' => $machine5->idMachine,
            'idUser' => $technicien2->id,
        ]);

        Intervention::create([
            'dateHeureDebut' => Carbon::now()->addDays(5)->setTime(9, 0),
            'dateHeureFin' => Carbon::now()->addDay(5)->setTime(10, 30),
            'description' => 'Mise à jour du logiciel de contrôle',
            'statut' => 'en_attente',
            'commentaire' => null,
            'idMachine' => $machine7->idMachine,
            'idUser' => $technicien1->id,
        ]);

        echo "✅ 7 interventions créées\n";

        // ============================================
        // 4. INTERVENTIONS PLANIFIÉES
        // ============================================

        $planifiee1 = InterventionPlanifiee::create([
            'dateDebut' => Carbon::now()->addWeek()->setTime(8, 0),
            'dateFin' => Carbon::now()->addWeek()->setTime(12, 0),
            'type' => 'preventive',
            'description' => 'Maintenance préventive trimestrielle - Vérification complète',
            'statut' => 'planifiee',
            'frequence' => 'trimestrielle',
            'idMachine' => $machine1->idMachine,
        ]);

        $planifiee2 = InterventionPlanifiee::create([
            'dateDebut' => Carbon::now()->addDays(15)->setTime(14, 0),
            'dateFin' => Carbon::now()->addDays(15)->setTime(17, 0),
            'type' => 'calibration',
            'description' => 'Calibration annuelle des capteurs de précision',
            'statut' => 'planifiee',
            'frequence' => 'annuelle',
            'idMachine' => $machine2->idMachine,
        ]);

        $planifiee3 = InterventionPlanifiee::create([
            'dateDebut' => Carbon::now()->addMonth()->setTime(9, 0),
            'dateFin' => Carbon::now()->addMonth()->setTime(16, 0),
            'type' => 'controle_periodique',
            'description' => 'Contrôle réglementaire de sécurité',
            'statut' => 'planifiee',
            'frequence' => 'annuelle',
            'idMachine' => $machine3->idMachine,
        ]);

        $planifiee4 = InterventionPlanifiee::create([
            'dateDebut' => Carbon::now()->addDays(3)->setTime(10, 0),
            'dateFin' => Carbon::now()->addDays(3)->setTime(11, 30),
            'type' => 'préventive',
            'description' => 'Vérification hebdomadaire des paramètres laser',
            'statut' => 'planifiee',
            'frequence' => 'hebdomadaire',
            'idMachine' => $machine4->idMachine,
        ]);

        $planifiee5 = InterventionPlanifiee::create([
            'dateDebut' => Carbon::now()->addDays(20)->setTime(13, 0),
            'dateFin' => Carbon::now()->addDays(20)->setTime(18, 0),
            'type' => 'amelioration',
            'description' => 'Installation d\'un nouveau système de lubrification automatique',
            'statut' => 'planifiee',
            'frequence' => 'ponctuelle',
            'idMachine' => $machine7->idMachine,
        ]);

        echo "✅ 5 interventions planifiées créées\n";

        // ============================================
        // 5. ASSOCIATIONS TECHNICIENS
        // ============================================

        // Association via la table pivot
        $planifiee1->techniciens()->attach([$technicien1->id, $technicien2->id]);
        $planifiee2->techniciens()->attach([$technicien2->id]);
        $planifiee3->techniciens()->attach([$technicien1->id, $technicien3->id]);
        $planifiee4->techniciens()->attach([$technicien3->id]);
        $planifiee5->techniciens()->attach([$technicien1->id, $technicien2->id, $technicien3->id]);

        echo "✅ Associations techniciens créées\n";

        echo "\n🎉 Seeding terminé avec succès !\n";
        echo "📧 Email de test : admin@whotouchedit.fr\n";
        echo "🔑 Mot de passe : password\n";
    }
}
