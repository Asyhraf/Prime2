<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\AhliEvent;
use App\Models\KodGelaran;
use App\Models\kehadiranQR;
use App\Models\ref_jawatan;

use Illuminate\Support\Str;
use App\Models\Log_Aktiviti;
use App\Models\ref_aktiviti;
use Illuminate\Http\Request;
use App\Models\AhliMesyuarat;
use App\Models\kekananan_gred;
use Illuminate\Support\Carbon;
use App\Models\ref_kementerian;
use App\Models\ref_status_ahli;
use App\Models\ref_status_jawatan;
use Illuminate\Support\Facades\DB;
use App\Models\ref_tajuk_mesyuarat;
use App\Http\Controllers\Controller;
use App\Models\ButiranAhliMesyuarat;
use Illuminate\Support\Facades\Session;


class AttendanceController extends Controller
{
    public function attendanceForm(Request $request, $event_id)
    {
        if (!Session::has('ahli_logged_in')) {
            return redirect()->route('ahli.login.form', ['event_id' => $event_id]);
        }

        // Fetch the event based on event_id
        $event = Event::find($event_id);

        if (!$event) {
            // Handle the case where the event is not found
            return view('error', ['message' => 'Event not found.']);
        }

        // Pass data to the view
        return view('m_QRCode', compact('event'));
    }
}
