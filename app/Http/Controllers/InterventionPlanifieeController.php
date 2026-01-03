<?php

namespace App\Http\Controllers;

use App\Models\InterventionPlanifiee;
use App\Models\Machine;
use App\Models\User;
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

    /** display the infos of the intervention_planifiee identified by the key $id
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function detail($id) {
        $intervention = InterventionPlanifiee::find($id);

        if (!$intervention) {
            return redirect()
                ->route('intervention_planifiee')
                ->with('error', 'Intervention planifiee introuvable');
        }
        return view('intervention_planifiee.detail', ['intervention' => $intervention]);
    }

    /** display the intervention_planifiee.add page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function add() {
        // get the necessary data for the selects
        $machines = Machine::all();
        $users = User::all();

        return view('intervention_planifiee.add', ['machines' => $machines, 'users' => $users]);
    }

    public function do_add() {

    }
}
