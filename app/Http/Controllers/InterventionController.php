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
        return view('intervention', ['interventionss' => $interventions]);
    }
}
