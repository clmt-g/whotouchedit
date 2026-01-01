<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddMachineRequest;
use App\Http\Requests\UpdateMachineRequest;
use App\Models\Machine;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Mockery\Exception;

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
     * @return Factory|View|RedirectResponse|\Illuminate\View\View
     */
    public function detail($id) {
        $machine = Machine::find($id);
        if(!$machine) {
            return redirect()
                ->route('machine')
                ->with('error', 'Machine introuvable');
        }
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

    /** display the update page with the info of the machine according to the key $id
     * @param $id
     * @return Factory|View|RedirectResponse|\Illuminate\View\View
     */
    public function update($id) {
        $machine = Machine::find($id);

        if (!$machine) {
            return redirect()
                ->route('machine')
                ->with('error', 'La machine n\'existe pas');
        }

        return view('machine.update', ['machine' => $machine]);
    }

    /** update a machine
     * @param UpdateMachineRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function do_update(UpdateMachineRequest $request, $id) {
        $validated = $request->validated();

        try {
            Machine::findOrFail($id)->update([
                'nom' => $validated['nom'],
                'reference' => $validated['reference'],
                'dateInstallation' => $validated['dateInstallation'],
                'etat' => $validated['etat'],
                'criticite' => $validated['criticite'],
                'localisation' => $validated['localisation'],
                'notes' => $validated['notes'] ?? null
            ]);

            return redirect()
                ->route('machine')
                ->with('success', 'Modifications enregistrer avec success');
        } catch (\Exception $e) {
            return redirect()
                ->route('machine')
                ->with('error', 'Erreur lors de l\'enregistrement des modifications');
        }
    }

    public function do_delete($id) {
        try {
            $machine = Machine::findOrFail($id);
            $machine->delete();
            return redirect()
                ->route('machine')
                ->with('success', 'La machine à été supprimer avec success');
        } catch (Exception $e) {
            return redirect()
                ->route('machine')
                ->with('error', 'Impossible de trouver la machine');
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
