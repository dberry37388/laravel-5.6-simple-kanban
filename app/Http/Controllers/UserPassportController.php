<?php

namespace App\Http\Controllers;

class UserPassportController extends Controller
{
    /**
     * Displays the user's Passport settings.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        return view('user.passport');
    }
}
