<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddInterventionRequest;
use App\Models\Intervention;
use App\Models\Machine;
use App\Models\User;
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
