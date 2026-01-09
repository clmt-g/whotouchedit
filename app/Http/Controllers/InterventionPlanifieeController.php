<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddInterventionPlanifieeRequest;
use App\Http\Requests\UpdateInterventionPlanifieeRequest;
use App\Models\InterventionPlanifiee;
use App\Models\Machine;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class InterventionPlanifieeController extends Controller
{
    /** display the show page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function show()
    {
        $interventions = InterventionPlanifiee::ForUser(Auth::user())->get();
        return view('intervention_planifiee.show', ['interventions' => $interventions]);
    }

    /** display the infos of the intervention_planifiee identified by the key $id
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function detail($id)
    {
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
    public function add()
    {
        // get the necessary data for the selects
        $machines = Machine::all();
        $users = User::all();

        return view('intervention_planifiee.add', ['machines' => $machines, 'users' => $users]);
    }

    /** store an intervention in the database
     * @param AddInterventionPlanifieeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function do_add(AddInterventionPlanifieeRequest $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {

            // Créer l'intervention
            $intervention = InterventionPlanifiee::create([
                'type' => $validated['type'],
                'statut' => $validated['statut'],
                'frequence' => $validated['frequence'],
                'dateDebut' => $validated['dateDebut'],
                'dateFin' => $validated['dateFin'],
                'idMachine' => $validated['idMachine'],
                'description' => $validated['description'] ?? null,
            ]);

            // Attacher les techniciens
            $intervention->techniciens()->attach($validated['techniciens']);

            DB::commit();

            return redirect()
                ->route('intervention_planifiee')
                ->with('success', 'Intervention planifiée enregistrer avec succes');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()
                ->route('intervention_planifiee')
                ->with('error', 'Erreur lors de l\'enregistrement de l\'intervention planifiee');
        }
    }

    /** display the intervention_planifiee.update page of the intervention identified by the key $id
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function update($id) {
        $intervention = InterventionPlanifiee::find($id);

        if (!$intervention) {
            return redirect()
                ->route('intervention_planifiee')
                ->with('error', 'Intervention planifiee introuvable');
        }

        $machines = Machine::all();
        $users = User::all();

        return view('intervention_planifiee.update', ['intervention' => $intervention, 'machines' => $machines, 'users' => $users]);
    }

    /** update an intervention_planifiee
     * @param UpdateInterventionPlanifieeRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function do_update(UpdateInterventionPlanifieeRequest $request, $id) {
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            $intervention = InterventionPlanifiee::find($id);

            $intervention->update([
                'dateDebut' => $validated['dateDebut'],
                'dateFin' => $validated['dateFin'],
                'type' => $validated['type'],
                'description' => $validated['description'] ?? null,
                'statut' => $validated['statut'],
                'frequence' => $validated['frequence'],
                'idMachine' => $validated['idMachine']
            ]);

            $intervention->techniciens()->sync($validated['techniciens']);

            DB::commit();

            return redirect()
                ->route('intervention_planifiee')
                ->with('success', 'Enregistrement des modification effectuer avec succes');

        } catch(Exception $e) {
            DB::rollBack();
            return redirect()
                ->route('intervention_planifiee')
                ->with('error', 'Erreur lors de la suppression de l\'intervention planifiee');
        }
    }

    /** display the intervention_planifiee.update_statut page of the intervention identified by the key $id
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function update_statut($id) {
        $intervention = InterventionPlanifiee::find($id);

        if (!$intervention) {
            return redirect()
                ->route('intervention_planifiee')
                ->with('error', 'Intervention planifiee introuvable');
        }

        return view('intervention_planifiee.update_statut', ['intervention' => $intervention]);
    }

    /** update the statut of an intervention_planifiee
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function do_update_statut(Request $request, $id) {
        $request->validate([
            'statut' => 'required|string|in:planifiee,en_cours,terminee,annulee'
        ]);

        try {
            InterventionPlanifiee::findOrFail($id)->update([
                'statut' => $request->input('statut')
            ]);

            return redirect()
                ->route('intervention_planifiee')
                ->with('success', 'Statut de l\'intervention planifiee mis a jour avec succes');
        } catch(Exception $e) {
            return redirect()
                ->route('intervention_planifiee')
                ->with('error', 'Erreur lors de la mise a jour du statut de l\'intervention planifiee');
        }
    }

    /** delete an intervention_planifiee
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function do_delete($id) {
        DB::beginTransaction();
        try {
            $intervention = InterventionPlanifiee::find($id);

            // pas besoin de faire detach(), car soft delete, donc pas de pb d'integriter referenciel
            //$intervention->techniciens()->detach();

            $intervention->delete();

            DB::commit();
            return redirect()
                ->route('intervention_planifiee')
                ->with('success', 'Intervention planifiee supprimer avec succes');
        } catch(Exception $e) {
            DB::rollBack();
            return redirect()
                ->route('intervention_planifiee')
                ->with('error', 'Erreur lors de la suppression de l\'intervention planifiee');
        }
    }

}
