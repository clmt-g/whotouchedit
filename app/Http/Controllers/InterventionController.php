<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddInterventionRequest;
use App\Http\Requests\UpdateInterventionRequest;
use App\Models\Intervention;
use App\Models\Machine;
use App\Models\User;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

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

    /** display the intervention.add page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function add() {
        $machines = Machine::all();
        $users = User::all();
        return view('intervention.add', ['machines' => $machines, 'users' => $users]);
    }

    /** create a new intervention
     * @param AddInterventionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function do_add(AddInterventionRequest $request) {
        $validated = $request->validated();

        try {
            Intervention::create($validated);

            return redirect()
                ->route('intervention')
                ->with('success', 'Intervention créer avec suces');
        } catch (\Exception $e) {
            return redirect()
                ->route('intervention')
                ->with('error', 'Une erreur est survenue lors de la création de l\'intervention');
        }
    }

    /** display the update page of an intervention identified by the key $id
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function update($id) {
        // get the intervention that corrspond to the id
        $intervention = Intervention::find($id);
        if (!$intervention) {
            return redirect()
                ->route('intervention')
                ->with('error', 'Intervention introuvable');
        }

        // get the machines and users for the select
        $machines = Machine::all();
        $users = User::all();

        return view('intervention.update', ['intervention' => $intervention, 'machines' => $machines, 'users' => $users]);
    }

    public function do_update(UpdateInterventionRequest $request, $id) {
        $validated = $request->validated();

        try {
            Intervention::findOrFail($id)->update([
                'dateHeureDebut' => $validated['dateHeureDebut'],
                'dateHeureFin' => $validated['dateHeureFin'],
                'description' => $validated['description'],
                'statut' => $validated['statut'],
                'commentaire' => $validated['commentaire'],
                'idMachine' => $validated['idMachine'],
                'idUser' => $validated['idUser']
            ]);

            return redirect()
                ->route('intervention')
                ->with('success', 'Enregistrement des modifications apporté avec succes');

        } catch (Exception $e) {
            return redirect()
                ->route('intervention')
                ->with('error', 'Erreur lors de l\'enregistrement des modifications');
        }
    }

    /** delete an intervention
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function do_delete($id) {
        try {
            $intervention = Intervention::find($id);
            $intervention->delete();

            return redirect()
                ->route('intervention')
                ->with('success', 'Intervention supprimer avec sucès');
        } catch (\Exception $e) {
            return redirect()
            ->route('intervention')
            ->with('error', 'Une erreur est survenue lors de la suppression de l\'intervention');
        }
    }
}
