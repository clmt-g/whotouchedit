<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use Illuminate\Http\Request;

class MachineController extends Controller
{
    /** display the show page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function show() {
        $machines = Machine::all();
        return view('machine.show', ['machines' => $machines]);
    }

    /** display the details page of a machine according to the key $id
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function detail($id) {
        $machine = Machine::find($id);
        return view('machine.detail', ['machine' => $machine]);
    }
}
