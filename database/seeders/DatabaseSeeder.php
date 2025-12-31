<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Désactiver les vérifications de clés étrangères temporairement
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Vider les tables
        DB::table('intervention_planifiee_techniciens')->truncate();
        DB::table('interventions_planifiees')->truncate();
        DB::table('interventions')->truncate();
        DB::table('machines')->truncate();
        DB::table('user')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Seed Users
        $users = [
            [
                'nom' => 'Dupont',
                'prenom' => 'Jean',
                'login' => 'admin',
                'passwd' => Hash::make('password'),
                'role' => 'admin',
                'deleted' => false
            ],
            [
                'nom' => 'Martin',
                'prenom' => 'Sophie',
                'login' => 'smartin',
                'passwd' => Hash::make('password'),
                'role' => 'responsable',
                'deleted' => false
            ],
            [
                'nom' => 'Dubois',
                'prenom' => 'Pierre',
                'login' => 'pdubois',
                'passwd' => Hash::make('password'),
                'role' => 'technicien',
                'deleted' => false
            ],
            [
                'nom' => 'Lefebvre',
                'prenom' => 'Marie',
                'login' => 'mlefebvre',
                'passwd' => Hash::make('password'),
                'role' => 'technicien',
                'deleted' => false
            ],
            [
                'nom' => 'Bernard',
                'prenom' => 'Luc',
                'login' => 'lbernard',
                'passwd' => Hash::make('password'),
                'role' => 'direction',
                'deleted' => false
            ],
        ];

        foreach ($users as $user) {
            DB::table('user')->insert($user);
        }

        // Seed Machines
        $machines = [
            [
                'nom' => 'Presse hydraulique A1',
                'reference' => 'PH-2024-001',
                'dateInstallation' => '2023-01-15',
                'etat' => 'opérationnelle',
                'criticite' => 'critique',
                'localisation' => 'Atelier principal - Zone A',
                'deleted' => false
            ],
            [
                'nom' => 'Tour CNC T500',
                'reference' => 'CNC-2024-002',
                'dateInstallation' => '2023-06-20',
                'etat' => 'opérationnelle',
                'criticite' => 'critique',
                'localisation' => 'Atelier principal - Zone B',
                'deleted' => false
            ],
            [
                'nom' => 'Fraiseuse numérique F300',
                'reference' => 'FN-2024-003',
                'dateInstallation' => '2022-11-10',
                'etat' => 'en_maintenance',
                'criticite' => 'moyen',
                'localisation' => 'Atelier principal - Zone C',
                'deleted' => false
            ],
            [
                'nom' => 'Compresseur d\'air CA-50',
                'reference' => 'CA-2024-004',
                'dateInstallation' => '2021-03-05',
                'etat' => 'opérationnelle',
                'criticite' => 'moyen',
                'localisation' => 'Local technique',
                'deleted' => false
            ],
            [
                'nom' => 'Ligne d\'assemblage L1',
                'reference' => 'LA-2024-005',
                'dateInstallation' => '2024-01-10',
                'etat' => 'planifiée',
                'criticite' => 'critique',
                'localisation' => 'Hall d\'assemblage',
                'deleted' => false
            ],
            [
                'nom' => 'Robot de soudure RS-200',
                'reference' => 'RS-2024-006',
                'dateInstallation' => '2023-09-15',
                'etat' => 'en_panne',
                'criticite' => 'critique',
                'localisation' => 'Atelier soudure',
                'deleted' => false
            ],
        ];

        foreach ($machines as $machine) {
            DB::table('machines')->insert($machine);
        }

        // Seed Interventions
        $interventions = [
            [
                'dateHeure' => '2024-12-28 09:00:00',
                'description' => 'Remplacement du filtre à huile suite à fuite détectée',
                'statut' => 'terminee',
                'commentaire' => 'Filtre remplacé, système testé et opérationnel',
                'idMachine' => 1,
                'idUser' => 3,
                'deleted' => false
            ],
            [
                'dateHeure' => '2024-12-29 14:30:00',
                'description' => 'Vérification des courroies de transmission',
                'statut' => 'terminee',
                'commentaire' => 'Courroies en bon état, tension ajustée',
                'idMachine' => 2,
                'idUser' => 4,
                'deleted' => false
            ],
            [
                'dateHeure' => '2024-12-30 10:00:00',
                'description' => 'Réparation du système de refroidissement',
                'statut' => 'en_cours',
                'commentaire' => 'Pompe défectueuse identifiée, en attente de pièce',
                'idMachine' => 3,
                'idUser' => 3,
                'deleted' => false
            ],
            [
                'dateHeure' => '2024-12-31 08:00:00',
                'description' => 'Diagnostic panne électrique',
                'statut' => 'en_attente',
                'commentaire' => null,
                'idMachine' => 6,
                'idUser' => 4,
                'deleted' => false
            ],
            [
                'dateHeure' => '2024-12-25 15:00:00',
                'description' => 'Graissage des axes de déplacement',
                'statut' => 'terminee',
                'commentaire' => 'Maintenance préventive effectuée avec succès',
                'idMachine' => 2,
                'idUser' => 3,
                'deleted' => false
            ],
        ];

        foreach ($interventions as $intervention) {
            DB::table('interventions')->insert($intervention);
        }

        // Seed Interventions Planifiées
        $interventionsPlanifiees = [
            [
                'dateDebut' => '2025-01-15 08:00:00',
                'dateFin' => '2025-01-15 12:00:00',
                'type' => 'préventive',
                'description' => 'Maintenance préventive trimestrielle - Vérification complète',
                'statut' => 'planifiee',
                'frequence' => 'trimestrielle',
                'idMachine' => 1,
                'deleted' => false
            ],
            [
                'dateDebut' => '2025-01-20 09:00:00',
                'dateFin' => '2025-01-20 11:00:00',
                'type' => 'contrôle périodique',
                'description' => 'Contrôle mensuel de précision et calibration',
                'statut' => 'planifiee',
                'frequence' => 'mensuelle',
                'idMachine' => 2,
                'deleted' => false
            ],
            [
                'dateDebut' => '2025-02-01 08:00:00',
                'dateFin' => '2025-02-01 17:00:00',
                'type' => 'calibration',
                'description' => 'Calibration annuelle des capteurs et instruments',
                'statut' => 'planifiee',
                'frequence' => 'annuelle',
                'idMachine' => 3,
                'deleted' => false
            ],
            [
                'dateDebut' => '2025-01-10 13:00:00',
                'dateFin' => '2025-01-10 15:00:00',
                'type' => 'préventive',
                'description' => 'Vidange et changement des filtres',
                'statut' => 'planifiee',
                'frequence' => 'mensuelle',
                'idMachine' => 4,
                'deleted' => false
            ],
            [
                'dateDebut' => '2025-03-01 08:00:00',
                'dateFin' => '2025-03-05 17:00:00',
                'type' => 'amelioration',
                'description' => 'Installation nouveau module de contrôle qualité',
                'statut' => 'planifiee',
                'frequence' => 'ponctuelle',
                'idMachine' => 5,
                'deleted' => false
            ],
        ];

        foreach ($interventionsPlanifiees as $intervention) {
            DB::table('interventions_planifiees')->insert($intervention);
        }

        // Seed Association Interventions Planifiées - Techniciens
        $associations = [
            ['idInterventionPlanifiee' => 1, 'idUser' => 3, 'deleted' => false],
            ['idInterventionPlanifiee' => 1, 'idUser' => 4, 'deleted' => false],
            ['idInterventionPlanifiee' => 2, 'idUser' => 4, 'deleted' => false],
            ['idInterventionPlanifiee' => 3, 'idUser' => 3, 'deleted' => false],
            ['idInterventionPlanifiee' => 4, 'idUser' => 3, 'deleted' => false],
            ['idInterventionPlanifiee' => 5, 'idUser' => 3, 'deleted' => false],
            ['idInterventionPlanifiee' => 5, 'idUser' => 4, 'deleted' => false],
        ];

        foreach ($associations as $association) {
            DB::table('intervention_planifiee_techniciens')->insert($association);
        }

        $this->command->info('Base de données seedée avec succès !');
        $this->command->info('Comptes utilisateurs créés :');
        $this->command->info('  - admin / password (Admin)');
        $this->command->info('  - smartin / password (Responsable)');
        $this->command->info('  - pdubois / password (Technicien)');
        $this->command->info('  - mlefebvre / password (Technicien)');
        $this->command->info('  - lbernard / password (Direction)');
    }
}
