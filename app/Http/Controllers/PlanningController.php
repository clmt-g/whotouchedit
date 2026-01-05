<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use App\Models\InterventionPlanifiee;
use Illuminate\Http\Request;

class PlanningController extends Controller
{
    /** Display the planning page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function planning() {
        $interventions = Intervention::all();
        $interventions_planifiees = InterventionPlanifiee::all();

        return view('planning.planning', ['interventions' => $interventions, 'interventions_planifiees' => $interventions_planifiees]);
    }
}
