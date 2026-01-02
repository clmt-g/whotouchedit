<?php

namespace App\Http\Controllers;

use App\Models\InterventionPlanifiee;
use Illuminate\Http\Request;

class InterventionPlanifieeController extends Controller
{
    /** display the show page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function show() {
        $interventions = InterventionPlanifiee::all();
        return view('intervention_planifiee.show', ['interventions' => $interventions]);
    }
}
