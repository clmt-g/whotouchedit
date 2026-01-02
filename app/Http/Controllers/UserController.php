<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Machine;
use App\Models\User;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class UserController extends Controller
{
    /** display the user.show page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function show() {
        $users = User::all();
        return view('user.show', ['users' => $users]);
    }

    /** display the user.detail page with the infos of the user corresponding to the key $id
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function detail($id) {
        $user = User::find($id);

        if (!$user) {
            return redirect()
                ->route('user.show')
                ->with('error', 'Utilisateur introuvable');
        }

        return view('user.detail', ['user' => $user]);
    }

    /** display the user.add page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function add() {
        return view('user.add');
    }

    /** Create a user
     * @param AddUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function do_add(AddUserRequest $request) {
        $validated = $request->validated();

        try {
            // haché le password
            $validated['password'] = bcrypt($validated['password']);

            User::create($validated);

            return redirect()
                ->route('user')
                ->with('success', 'L\'utilisateur à bien été enregistrer');
        } catch (Exception $e) {
            return redirect()
                ->route('user')
                ->with('error', 'Erreur lors de l\'ajout de l\'utilisateur');
        }
    }

    /** Display the user.update page
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function update($id) {
        $user = User::find($id);

        if (!$user) {
            return redirect()
                ->route('user')
                ->with('error', 'Utilisateur introuvable');
        }

        return view('user.update', ['user' => $user]);
    }

    /** update the user identifier by the key $id
     * @param UpdateUserRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function do_update(UpdateUserRequest $request, $id) {
        $validated = $request->validated();

        try {
            User::find($id)->update($validated);

            return redirect()
                ->route('user')
                ->with('success', 'Modification de l\'utilisateur enregistrer');
        } catch(Exception $e) {
            return redirect()
                ->route('user')
                ->with('error', 'Erreur lors de la modification de l\'utilisateur');
        }
    }

    /** delete a user
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function do_delete($id) {
        try {
            User::find($id)->delete();
            return redirect()
                ->route('user')
                ->with('success', 'Utilisateur supprimer avec success');
        } catch(Exception $e) {
            return redirect()
                ->route('user')
                ->with('error', 'Erreur lors de la suppression de l\'utilisateur');
        }
    }
}
