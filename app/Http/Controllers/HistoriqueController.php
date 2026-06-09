<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use App\Models\InterventionPlanifiee;
use App\Models\Machine;
use App\Models\User;
use Illuminate\Http\Request;

class HistoriqueController extends Controller
{
    public function show()
    {
        $this->authorize('see-historique');

        $interventions = Intervention::with(['machine', 'user'])->get();
        $interventionsPlanifiees = InterventionPlanifiee::with(['machine', 'techniciens'])->get();

        // valeurs pour les filtres
        $machines = Machine::all();
        $users = User::all();

        // On fusionne les deux collections en une seule
        $historique = collect();

        foreach ($interventions as $intervention) {
            $historique->push([
                'type'        => 'curative',
                'id'          => $intervention->idIntervention,
                'dateDebut'   => $intervention->dateHeureDebut,
                'dateFin'     => $intervention->dateHeureFin,
                'statut'      => $intervention->statut,
                'machine'     => $intervention->machine,
                'techniciens' => $intervention->user ? collect([$intervention->user]) : collect(),
                'model'       => $intervention,
            ]);
        }

        foreach ($interventionsPlanifiees as $interventionPlanifiee) {
            $historique->push([
                'type'        => 'planifiee',
                'id'          => $interventionPlanifiee->idInterventionPlanifiee,
                'dateDebut'   => $interventionPlanifiee->dateDebut,
                'dateFin'     => $interventionPlanifiee->dateFin,
                'statut'      => $interventionPlanifiee->statut,
                'machine'     => $interventionPlanifiee->machine,
                'techniciens' => $interventionPlanifiee->techniciens,
                'model'       => $interventionPlanifiee,
            ]);
        }

        // On trie par date de début, du plus récent au plus ancien
        $historique = $historique->sortByDesc('dateDebut')->values();

        return view('historique.show', [
            'historique' => $historique,
            'users'      => $users,
            'machines'   => $machines,
        ]);
    }
}
