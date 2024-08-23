<?php

namespace App\Http\Responses;

use Filament\Facades\Filament;
use Filament\Http\Responses\Auth\Contracts\LoginResponse as Responsable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class LoginResponse implements Responsable
{
    public function toResponse($request): RedirectResponse|Redirector
    {
        $user = Filament::auth()->user();

        if ($user->can('admin')) {
            return redirect()->to('/dashboard');
        }

        if ($user->can('customer')) {
            return redirect()->to('/products');
        }

        return redirect()->route('home');
    }
}
