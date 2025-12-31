<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DefaultController extends Controller
{
    /** display the home page
     * @return Factory|\Illuminate\Contracts\View\View|View
     */
    public function index() {
        // FIXME : passer les informations nécéssaires

        return view('dashboard');
    }

    // FIXME : a supprimer
    public function test() {
        return view('machine.show');
    }
}
