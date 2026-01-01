<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InterventionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('interventions')->insert([
            [
                'idIntervention' => 1,
                'description' => 'Maintenance préventive mensuelle',
                'statut' => 'en_attente',
                'commentaire' => 'Vérification générale des composants',
                'idMachine' => 1,
                'idUser' => 1,
                'dateHeureDebut' => '2025-01-15 08:00:00',
                'dateHeureFin' => '2025-01-15 10:00:00',
                'deleted_at' => null,
            ],
            [
                'idIntervention' => 2,
                'description' => 'Réparation suite à panne électrique',
                'statut' => 'en_cours',
                'commentaire' => 'Remplacement du circuit imprimé',
                'idMachine' => 2,
                'idUser' => 2,
                'dateHeureDebut' => '2025-01-16 09:00:00',
                'dateHeureFin' => '2025-01-16 12:30:00',
                'deleted_at' => null,
            ],
            [
                'idIntervention' => 3,
                'description' => 'Calibration annuelle',
                'statut' => 'terminee',
                'commentaire' => 'Calibration effectuée avec succès',
                'idMachine' => 3,
                'idUser' => 1,
                'dateHeureDebut' => '2025-01-10 14:00:00',
                'dateHeureFin' => '2025-01-10 16:00:00',
                'deleted_at' => null,
            ],
            [
                'idIntervention' => 4,
                'description' => 'Changement de courroie',
                'statut' => 'en_attente',
                'commentaire' => 'Courroie usée détectée lors de l\'inspection',
                'idMachine' => 4,
                'idUser' => 3,
                'dateHeureDebut' => '2025-01-20 10:00:00',
                'dateHeureFin' => '2025-01-20 11:30:00',
                'deleted_at' => null,
            ],
            [
                'idIntervention' => 5,
                'description' => 'Nettoyage complet et lubrification',
                'statut' => 'terminee',
                'commentaire' => 'Machine remise en service',
                'idMachine' => 5,
                'idUser' => 2,
                'dateHeureDebut' => '2025-01-12 13:00:00',
                'dateHeureFin' => '2025-01-12 15:30:00',
                'deleted_at' => null,
            ],
        ]);
    }
}
