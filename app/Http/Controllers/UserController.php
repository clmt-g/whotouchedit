<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
}
