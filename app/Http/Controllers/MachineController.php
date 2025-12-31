<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddMachineRequest;
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

    /** display the machine/add page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function add() {
        return view('machine.add');
    }

    /** create a machine
     * @param AddMachineRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function do_add(AddMachineRequest $request)
    {
        $validated = $request->validated();
        $validated['idMachine'] = $this->generateId();

        try {
            Machine::create($validated);

            return redirect()
                ->route('machine')
                ->with('success', 'La machine à été ajouté avec succés');
        } catch(\Exception $e) {
            return redirect()
                ->route('machine')
                ->with('error', 'Impossible d\'ajouter la machine');
        }
    }

    /** generate a new id based on the last id stored in the database
     * @return int
     */
    private function generateId() : int {
        // get the last machine
        $lastMachine = Machine::orderBy('idMachine', 'desc')->first();

        // nothing in the database
        if (!$lastMachine) {
            return 1;
        }

        return $lastMachine->idMachine + 1;
    }
}
