<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\AhliEvent;
use App\Models\AhliMesyuarat;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('access-qr-code', function ( $user, $id_ahli, $id_event) {
            return session('session_id_ahli') == $id_ahli
                && session('session_meeting_id') == $id_event;

        });

        // Gate::define('access-qr-code', function ($user, $id_ahli, $id) {
        //     return AhliEvent::where('ahli_id', $id_ahli)
        //                     ->where('mesyuarat_id', $id)
        //                     ->exists();
        // });

        //
    }
}
