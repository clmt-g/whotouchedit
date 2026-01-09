<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use App\Models\InterventionPlanifiee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanningController extends Controller
{
    /** Display the planning page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function planning() {
        $interventions = Intervention::ForUser(Auth::user())->get();
        $interventions_planifiees = InterventionPlanifiee::ForUser(Auth::user())->get();

        return view('planning.planning', ['interventions' => $interventions, 'interventions_planifiees' => $interventions_planifiees]);
    }
}
