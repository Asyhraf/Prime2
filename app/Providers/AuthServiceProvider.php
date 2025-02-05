<?php

namespace App\Providers;

use App\Models\AhliEvent;
use App\Models\AhliMesyuarat;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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

        Gate::define('access-qr-code', function ($user = null, $id_ahli, $id) {
            $session_id_ahli = (int) session('session_id_ahli');
            $session_meeting_id = (int) session('session_meeting_id');
            $id_ahli = (int) $id_ahli;
            $id = (int) $id;

            Log::info('Gate Validation Check:', [
                'session_id_ahli' => $session_id_ahli,
                'session_meeting_id' => $session_meeting_id,
                'route_id_ahli' => $id_ahli,
                'route_id_meeting' => $id
            ]);

            return $session_id_ahli === $id_ahli && $session_meeting_id === $id;
        });



        // Gate::define('access-qr-code', function ($user, $id_ahli, $id) {
        //     return AhliEvent::where('ahli_id', $id_ahli)
        //                     ->where('mesyuarat_id', $id)
        //                     ->exists();
        // });

        //
    }
}
