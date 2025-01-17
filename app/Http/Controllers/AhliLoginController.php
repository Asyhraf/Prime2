<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\AhliMesyuarat;
use App\Http\Controllers\Controller;
use App\Models\ButiranAhliMesyuarat;
use Illuminate\Support\Facades\Session;

class AhliLoginController extends Controller
{
    public function showLoginForm(Request $request)
    {
        return view('auth.ahli_login', [
            'redirect_url' => $request->query('redirect'),
        ]);
    }

    public function login(Request $request)
    {
        // Validate no_ic input
        $request->validate([
            'no_ic' => 'required|string|max:15',
        ]);

        // Get IC number from input
        $no_ic = $request->input('no_ic');

        // Step 1: Find the ahli using no_ic
        $ahli = ButiranAhliMesyuarat::where('no_ic', $no_ic)->first();

        if ($ahli) {
            // Step 2: Find related event using ahli_id from ahli_event table
            $ahli_event = DB::table('ahli_event')
                ->where('ahli_id', $ahli->id_ahli) // Match ahli_id from ahli_event
                ->first();

            if (!$ahli_event) {
                return back()->withErrors(['no_ic' => 'No associated event found for this IC number.']);
            }

            // Step 3: Validate event_id from the request or the ahli_event relationship
            $event_id = $request->query('event_id', $ahli_event->mesyuarat_id);

            // Step 4: Redirect to URL for the QR code page (m_QRCode/{id_ahli}/{id})
            $redirectUrl = route('pengesahanQR', [
                'id_ahli' => $ahli->id_ahli, // Using id_ahli
                'id' => $event_id, // Using event_id
            ]);

            // Store session details
            Session::put('ahli_logged_in', true);
            Session::put('ahli_no_ic', $no_ic);

            return redirect($redirectUrl);
        } else {
            return back()->withErrors(['no_ic' => 'Invalid IC Number. Please try again.']);
        }
    }

    public function submit(Request $request)
    {
        // Validate no_ic input
        $request->validate([
            'no_ic' => 'required|string|max:15',
        ]);

        // Retrieve user based on the no_ic input
        $no_ic = $request->input('no_ic');
        $user = ButiranAhliMesyuarat::where('no_ic', $no_ic)->first();

        if ($user) {
            // Save user session
            Session::put('ahli_logged_in', true);
            Session::put('ahli_no_ic', $no_ic);

            // Get related ahli_event information
            $ahli_event = \DB::table('ahli_event')
                ->where('ahli_id', $user->id_ahli)
                ->first();

            if (!$ahli_event) {
                return back()->withErrors(['no_ic' => 'No event found for this IC number.']);
            }

            // Get event_id from request or ahli_event
            $event_id = $request->query('event_id', $ahli_event->mesyuarat_id);

            // Redirect to the m_QRCode/{id_ahli}/{id} route
            $redirectUrl = route('pengesahanQR', [
                'id_ahli' => $user->id_ahli, // Using id_ahli from ButiranAhliMesyuarat
                'id' => $event_id, // Using event_id from ahli_event or request
            ]);

            return redirect($redirectUrl);
        } else {
            return back()->withErrors(['no_ic' => 'Invalid IC Number. Please try again.']);
        }
    }
}
