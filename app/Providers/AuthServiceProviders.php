<?php

namespace App\Providers;

use App\Constant;
use App\Http\Responses\LoginResponse;
use App\Http\Responses\LogoutResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Filament\Http\Responses\Auth\Contracts\LogoutResponse as LogoutResponseContract;
use Filament\Http\Responses\Auth\Contracts\LoginResponse as LoginResponseContract;

class AuthServiceProviders extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(LoginResponseContract::class, LoginResponse::class);
        $this->app->bind(LogoutResponseContract::class, LogoutResponse::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define('admin', function ($user) {
            return $user->role == Constant::ROLE_ADMIN;
        });

        Gate::define('customer', function ($user) {
            return $user->role == Constant::ROLE_CUSTOMER;
        });
    }
}
