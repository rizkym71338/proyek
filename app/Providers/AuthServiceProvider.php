<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('data-penerimaan', function (User $user) {
            return $user->role == "Penerimaan";
        });

        Gate::define('laporan-penerimaan', function (User $user) {
            return $user->role == "Divisi Peternakan" || $user->role == "Penerimaan";
        });

        Gate::define('data-penjualan', function (User $user) {
            return $user->role == "Penjualan";
        });

        Gate::define('laporan-penjualan', function (User $user) {
            return $user->role == "Divisi Peternakan" || $user->role == "Penjualan";
        });

        Gate::define('data-persediaan', function (User $user) {
            return $user->role == "Persediaan";
        });

        Gate::define('laporan-persediaan', function (User $user) {
            return $user->role == "Divisi Peternakan" || $user->role == "Persediaan";
        });

        Gate::define('kelola_pengguna', function (User $user) {
            return $user->role == "Divisi Peternakan";
        });
    }
}
