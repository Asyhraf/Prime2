<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class VerifyAhliQRCode
{
    public function handle($request, Closure $next)
    {
        // Check if user is logged in
        if (!Session::has('ahli_logged_in')) {
            return redirect('/login')->withErrors('Sila log masuk dahulu.');
        }

        // Extract parameters from the request
        $id_ahli = $request->route('id_ahli');
        $id = $request->route('id');

        // Validate session data
        if (
            Session::get('session_id_ahli') != $id_ahli ||
            Session::get('session_meeting_id') != $id
        ) {
            return redirect('/login')->withErrors('Akses ditolak. URL tidak sah.');
        }

        // Verify id_ahli and id exist in the database
        $validEvent = DB::table('ahli_event')
            ->where('ahli_id', $id_ahli)
            ->where('mesyuarat_id', $id)
            ->exists();

        if (!$validEvent) {
            return redirect('/login')->withErrors('Akses ditolak. Kombinasi ID ahli dan mesyuarat tidak wujud.');
        }

        return $next($request);
    }
}
