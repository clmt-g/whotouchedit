<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddMachineRequest;
use App\Http\Requests\UpdateMachineRequest;
use App\Models\Intervention;
use App\Models\InterventionPlanifiee;
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
        // check permission
        $this->authorize('manage-machines');

        $machines = Machine::all();
        return view('machine.show', ['machines' => $machines]);
    }

    /** display the details page of a machine according to the key $id
     * @param $id
     * @return Factory|View|RedirectResponse|\Illuminate\View\View
     */
    public function detail($id) {
        // check permission
        $this->authorize('detail-machine');

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
        // check permission
        $this->authorize('add-machine');

        return view('machine.add');
    }

    /** create a machine
     * @param AddMachineRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function do_add(AddMachineRequest $request)
    {
        // check permission
        $this->authorize('add-machine');

        $validated = $request->validated();

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
        // check permission
        $this->authorize('update-machine');

        $machine = Machine::find($id);

        if (!$machine) {
            return redirect()
                ->route('machine')
                ->with('error', 'La machine n\'existe pas');
        }

        return view('machine.update', ['machine' => $machine]);
    }

    /** display the update etat page with the info of the machine according to the key $id
     * @param $id
     * @return Factory|View|RedirectResponse|\Illuminate\View\View
     */
    public function update_etat($id) {
        // check permission
        $this->authorize('update-etat-machine');

        $machine = Machine::find($id);

        if (!$machine) {
            return redirect()
                ->route('machine')
                ->with('error', 'La machine n\'existe pas');
        }

        return view('machine.update_etat', ['machine' => $machine]);
    }

    /** update a machine
     * @param UpdateMachineRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function do_update(UpdateMachineRequest $request, $id) {
        // check permission
        $this->authorize('update-machine');

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

    /** update the etat of a machine
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function do_update_etat(Request $request, $id) {
        // check permission
        $this->authorize('update-etat-machine');

        $request->validate([
            'etat' => 'required|in:opérationnelle,en_maintenance,planifiée,en_panne,hors_service',
        ]);

        try {
            Machine::findOrFail($id)->update([
                'etat' => $request->input('etat'),
            ]);

            return redirect()
                ->route('machine')
                ->with('success', 'État de la machine mis à jour avec succès');
        } catch (\Exception $e) {
            return redirect()
                ->route('machine')
                ->with('error', 'Erreur lors de la mise à jour de l\'état de la machine');
        }
    }

    /** delete an intervention
     * @param $id
     * @return RedirectResponse
     */
    public function do_delete($id) {
        // check permission
        $this->authorize('delete-machine');

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

    /** Return all the interventions and interventions_planifiees for a machine
     * @param $id
     * @return Factory|View|\Illuminate\View\View
     */
    public function historique($id) {
        // check permission
        $this->authorize('historique-machine');

        // get the interventions
        $interventions = Intervention::where('idMachine', $id)->get();
        $interventions_planifiees = InterventionPlanifiee::where('idMachine', $id)->get();
        $machine = Machine::findOrFail($id);

        return view('machine.historique', [
            'interventions' => $interventions,
            'interventions_planifiees' => $interventions_planifiees,
            'machine' => $machine
        ]);
    }
}
