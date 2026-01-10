<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Machine;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use mysql_xdevapi\Exception;

class UserController extends Controller
{
    /** display the user.show page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function show() {
        // check permission
        $this->authorize('manage-users');

        $users = User::all();
        return view('user.show', ['users' => $users]);
    }

    /** display the user.detail page with the infos of the user corresponding to the key $id
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function detail($id) {
        $user = User::find($id);

        // check permission
        $this->authorize('detail-user', $user);

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
        // check permission
        $this->authorize('add-user');

        return view('user.add');
    }

    /** Create a user
     * @param AddUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function do_add(AddUserRequest $request) {
        // check permission
        $this->authorize('add-user');

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
        // check permission
        $this->authorize('update-user');

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
        // check permission
        $this->authorize('update-user');

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
        // check permission
        $this->authorize('delete-user');

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

    /** display the user.update_password page
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function update_password($id) {
        $user = User::find($id);

        // check permission
        $this->authorize('update-password-user', $user);

        if (!$user) {
            return redirect()
                ->route('user')
                ->with('error', 'Utilisateur introuvable');
        }

        return view('user.update_password', ['user' => $user]);
    }

    /** update the password of the user identified by the key $id
     * @param UpdatePasswordRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function do_update_password(UpdatePasswordRequest $request, $id) {
        $user = User::find($id);

        // check permission
        $this->authorize('update-password-user', $user);

        try {

            if (Hash::check($request->get('current_password'), $user->password)) {
                $user->update(['password' => bcrypt($request->get('password'))]);
                return redirect()
                    ->route('user')
                    ->with('success', 'Mot de passe modifier avec success');
            } else {
                return redirect()
                    ->route('user')
                    ->with('error', 'L\'ancien mot de passe ne correspond pas');
            }
        } catch (Exception $e) {
                return redirect()
                    ->route('user')
                    ->with('error', 'Erreur lors de la modification du mot de passe');
        }

    }
}
