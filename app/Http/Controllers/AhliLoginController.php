<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AhliMesyuarat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\ButiranAhliMesyuarat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AhliLoginController extends Controller
{
    public function showLoginForm($id_ahli, $id)
    {
        // Pass the required variables to the view
        return view('auth.ahli_login', [
            'id_ahli' => $id_ahli, // or combine with event_id if needed
            'id' => $id
        ]);
    }


    // public function showLoginForm(Request $request)
    // {
    //     return view('auth.ahli_login', [
    //         'redirect_url' => $request->query('redirect'),
    //     ]);
    // }

    public function submit(Request $request)
    {

        //!if user tried to change the numbers 1/390 to 1/391, what happends?

        $request->validate([
            'no_ic' => 'required|string|max:15',
        ]);

        $no_ic = $request->input('no_ic');
        $id = $request->id;
        $id_ahli = $request->id_ahli;

        // Step 1: Validate IC number
        $butiranAhli = ButiranAhliMesyuarat::where('no_ic', '=', $no_ic)->firstOrFail();

        if (!$butiranAhli) {
            return back()->withErrors(['no_ic' => 'Invalid IC Number. Please try again.']);
        }

        // Step 2: Validate id_ahli in AhliMesyuarat
        $ahliMesyuarat = AhliMesyuarat::where('id_ahli', $butiranAhli->id_ahli)->first();

        if (!$ahliMesyuarat) {
            return back()->withErrors(['no_ic' => 'Invalid member association.']);
        }

        // Step 3: Verify associated event in AhliEvents
        $ahliEvent = DB::table('ahli_event')
            ->where('ahli_id', $ahliMesyuarat->id_ahli)
            ->first();

        if (!$ahliEvent) {
            return back()->withErrors(['no_ic' => 'No associated event found.']);
        }

        // Step 4: Generate URL for QR Code page
        Session::put('ahli_logged_in', true);
        Session::put('session_no_ic', $no_ic); // Store IC number
        Session::put('session_id_ahli', $id_ahli); // Store ahli ID
        Session::put('session_meeting_id', $id); // Store meeting ID
        Log::info('Session set:', ['id_ahli' => $id_ahli, 'id' => $id]);
        Log::info('Session set:', [
            'session_id_ahli' => $id_ahli,
            'session_meeting_id' => $id
        ]);

        // Debug session data
        //     dd([
        //         'session_id_ahli' => session('session_id_ahli'),
        //         'session_meeting_id' => session('session_meeting_id'),
        //         'no_ic' => $no_ic,
        //         'id_ahli' => $id_ahli,
        //         'id' => $id
        //     ]);


        // Session::put('ahli_logged_in', true);
        // Session::put('ahli_no_ic', $no_ic);
        // Session::put('session_id_ahli', $butiranAhli->id_ahli); // Simpan id_ahli ke dalam sesi


        // Step 5: Store session data
        // $redirectUrl = url('/login/' . $ahliEvent->ahli_id . '/' . $ahliEvent->mesyuarat_id);
        return redirect()->route('pengesahanQR', [

            'id_ahli' => $id_ahli, // Use the ahli ID from the session
            'id' => $id // Use the meeting ID from the session
            // 'id_ahli' => Session::get('session_id_ahli'), // Ambil dari sesi
            // 'id' => $ahliEvent->mesyuarat_id // Ambil mesyuarat_id dari AhliEvent
            // kod lama
            // 'id_ahli' => $id_ahli,
            // 'id' => $id
        ]);
        // Log::info('Redirecting to pengesahanQR', ['id_ahli' => $id_ahli, 'id' => $id]);


        // Step 6: Redirect user to the QR code page
        // return redirect($redirectUrl);
            if (!$id_ahli || !$id)
            {
                return back()->withErrors(['no_ic' => 'Missing ID or member ID for redirect.']);
            }
    }
}


//     public function login(Request $request)
// {
//     $request->validate([
//         'no_ic' => 'required|string|max:15',
//     ]);

//     // Get IC number from input
//     $no_ic = $request->input('no_ic');

//     // Step 1: Find the ahli using no_ic
//     $ahli = ButiranAhliMesyuarat::where('no_ic', $no_ic)->first();

//     if (!$ahli) {
//         return back()->withErrors(['no_ic' => 'Invalid IC Number. Please try again.']);
//     }

//     // Step 2: Find related event using ahli_id from ahli_event table
//     $ahli_event = DB::table('ahli_event')
//         ->where('ahli_id', $ahli->id_ahli) // Match ahli_id from ahli_event
//         ->first();

//     if (!$ahli_event) {
//         return back()->withErrors(['no_ic' => 'No associated event found for this IC number.']);
//     }

//     // Step 3: Validate event_id from the request or the ahli_event relationship
//     $event_id = $request->query('event_id', $ahli_event->mesyuarat_id);

//     // Step 4: Debug: Log or dump to check the redirect URL
//     dd($ahli->id_ahli, $event_id);

//     // Step 5: Redirect to URL for the QR code page (m_QRCode/{id_ahli}/{id})
//     $redirectUrl = route('pengesahanQR', [
//         'id_ahli' => $ahli->id_ahli, // Using id_ahli
//         'id' => $event_id, // Using event_id
//     ]);

//     // Store session details
//     Session::put('ahli_logged_in', true);
//     Session::put('ahli_no_ic', $no_ic);

//     return redirect($redirectUrl);
// }
