<?php

namespace App\Http\Controllers;


use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
        public function login(): RedirectResponse
    {
        return redirect()->route('filament.dashboard.auth.login');
    }
}
