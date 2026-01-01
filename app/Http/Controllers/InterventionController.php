<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use App\Models\Machine;
use Illuminate\Http\Request;

class InterventionController extends Controller
{
    /** display the show page with all the interventions
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function show() {
        $interventions = Intervention::all();
        return view('intervention.show', ['interventions' => $interventions]);
    }

    /** display the detail page of an intervention according to the key $id
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function detail($id) {
        $intervention = Intervention::find($id);
        if (!$intervention) {
            return redirect()
                ->route('intervention')
                ->with('error', 'Intervention introuvable');
        }
        return view('intervention.detail', ['intervention' => $intervention]);
    }

    public function add() {
        return view('intervention.add');
    }
}
