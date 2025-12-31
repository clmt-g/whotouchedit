<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use Illuminate\Http\Request;

class MachineController extends Controller
{
    public function show() {
        $machines = Machine::paginate(10);
        return view('machine.show', ['machines' => $machines]);
    }
}
