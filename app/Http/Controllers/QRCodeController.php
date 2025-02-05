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
use Illuminate\Support\Facades\Log;
use App\Models\ButiranAhliMesyuarat;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class QRCodeController extends Controller
{
    public function showQRCode($id_ahli, $id, Request $request)
    {
        // Check if the user is logged in
        if (!Session::has('ahli_logged_in')) {
            return redirect('/login')->withErrors('Sila log masuk dahulu.');
        }

        // Validate that the current session's id_ahli matches the URL
        if (Session::get('session_id_ahli') != $id_ahli) {
            return redirect('/login')->withErrors('Akses ditolak. ID ahli tidak sah.');
        }

        // Validate that the current session's meeting ID matches the URL
        if (Session::get('session_meeting_id') != $id) {
            return redirect('/login')->withErrors('Akses ditolak. ID mesyuarat tidak sah.');
        }

        // Verify that this id_ahli and id combination exists in the database
        $validEvent = DB::table('ahli_event')
            ->where('ahli_id', $id_ahli)
            ->where('id', $id)
            ->first();

        if (!$validEvent) {
            return redirect('/login')->withErrors('Akses ditolak. Kombinasi ID ahli dan mesyuarat tidak wujud.');
        }

        // If everything is valid, show the QR Code page
        return view('qr_code', compact('id_ahli', 'id'));
    }


    public function indexPengesahanQRCode($id_ahli, $id)
    {
                // Pastikan session diset dulu
        Session::put('session_id_ahli', $id_ahli);
        Session::put('session_meeting_id', $id);

        // Log untuk pastikan session diset
        Log::info('Session Set in Controller:', [
            'session_id_ahli' => session('session_id_ahli'),
            'session_meeting_id' => session('session_meeting_id')
        ]);

        // Sekarang baru check Gate
        if (!Gate::allows('access-qr-code', [$id_ahli, $id])) {
            Log::warning("Akses tidak dibenarkan untuk ahli ID: $id_ahli dengan mesyuarat ID: $id");
            abort(403, 'Akses tidak dibenarkan');
        }


        // if (!Gate::allows('access-qr-code', [$id_ahli, $id]))
        //     {
        //         abort(403, 'Akses tidak dibenarkan');
        //     }

            // Kod asal jika akses dibenarkan
        $ahli_mesyuarat = AhliMesyuarat::where('id_ahli', $id_ahli)->firstOrFail();
        $event = Event::where('id', $id)->firstOrFail();

        $butiranQR = AhliEvent::join('butiran_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'butiran_ahli_mesyuarat.id_ahli')
            ->join('ahli_mesyuarat', 'butiran_ahli_mesyuarat.id_ahli', '=', 'ahli_mesyuarat.id_ahli')
            ->leftJoin('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
            ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
            ->leftJoin('lantikan_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'lantikan_ahli_mesyuarat.id_ahli')
            ->leftJoin('kekananan_gred', 'lantikan_ahli_mesyuarat.id_gred', '=', 'kekananan_gred.id_gred')
            ->where('ahli_event.mesyuarat_id', $id)
            ->where('ahli_event.ahli_id', $id_ahli)
            ->select('ahli_event.*', 'ahli_mesyuarat.nama_ahli', 'ref_jawatan.nama_jawatan', 'ref_kementerian.nama_kementerian', 'ref_kementerian.singkatan_kementerian', 'kekananan_gred.nama_gred')
            ->orderByRaw('
            CASE
                WHEN lantikan_ahli_mesyuarat.kekananan_mesy_manual BETWEEN 1 AND 1000 AND butiran_ahli_mesyuarat.status = 1 THEN 1
                WHEN lantikan_ahli_mesyuarat.kekananan_mesy_manual IS NULL THEN 2
                ELSE 3
            END
        ')
            ->orderBy('lantikan_ahli_mesyuarat.kekananan_mesy_manual', 'ASC')
            ->first(); // Ensure we get a single record

            Log::info('Query Result:', ['butiranQR' => $butiranQR]);


        $kekananan_gred = kekananan_gred::all();
        $ref_jawatan = ref_jawatan::all();
        $ref_status_jawatan = ref_status_jawatan::all();

        return view('mesyuarat.m_QRCode')->with(compact('id_ahli', 'id', 'ahli_mesyuarat', 'event', 'butiranQR', 'ref_jawatan', 'kekananan_gred', 'ref_status_jawatan'));

    }

    public function simpanKehadiranQR($id_ahli, $id, Request $request, AhliEvent $Aevt)
    {
        $ahli_mesyuarat = ButiranAhliMesyuarat::where('id_ahli', $id_ahli)->firstOrFail();
        $event = Event::where('id', $id)->firstOrFail();
        $ahli = AhliMesyuarat::where('id_ahli', $id_ahli)->firstOrFail();
        $nama = $ahli->nama_ahli;

        $ahli_event = AhliEvent::firstOrCreate(
            ['ahli_id' => $id_ahli, 'mesyuarat_id' => $id]
        ); // Use first() to get a single record
        // dd($ahli_event);

        // Use null coalescing operator to handle null values
        // $nota_kemaskini = $request->nota_kemaskini ?? null;

        if ($ahli_event !== null) {
            if ($request->kehadiran == 'Y') {
                $ahli_event->update([
                    'ahli_id' => $ahli_mesyuarat->id_ahli,
                    'mesyuarat_id' => $event->id,
                    'kehadiran' => 'Y',
                    'catatan' => null,
                    'wakil_oleh' => null,
                    'jawatan_wakil' => null,
                    'id_gred_wakil' => null,
                    'tarikh_lantikan_wakil' => null,
                    'id_status_jawatan' => null,
                    'pegawai_kemaskini' => $request->pegawai_kemaskini_Y ?? null,
                    'no_tel_pegawai_kemaskini' => $request->no_tel_pegawai_kemaskini_Y ?? null,
                    'nota_kemaskini' => $request->nota_kemaskini ?? null,
                ]);
            } else if ($request->kehadiran == 'N') {
                $ahli_event->update([
                    'ahli_id' => $ahli_mesyuarat->id_ahli,
                    'mesyuarat_id' => $event->id,
                    'kehadiran' => 'N',
                    'catatan' => $request->catatan,
                    'wakil_oleh' => $request->wakil_oleh,
                    'jawatan_wakil' => $request->jawatan_wakil,
                    'id_gred_wakil' => $request->id_gred_wakil,
                    'tarikh_lantikan_wakil' => $request->tarikh_lantikan_wakil,
                    'id_status_jawatan' => $request->id_status_jawatan,
                    'pegawai_kemaskini' => $request->pegawai_kemaskini,
                    'no_tel_pegawai_kemaskini' => $request->no_tel_pegawai_kemaskini,
                    'nota_kemaskini' => $request->nota_kemaskini ?? null,
                ]);
            } else if ($request->kehadiran == 'Null') {
                $ahli_event->update([
                    'ahli_id' => $ahli_mesyuarat->id_ahli,
                    'mesyuarat_id' => $event->id,
                    'kehadiran' => 'Null',
                    'catatan' => null,
                    'wakil_oleh' => null,
                    'jawatan_wakil' => null,
                    'id_gred_wakil' => null,
                    'tarikh_lantikan_wakil' => null,
                    'id_status_jawatan' => null,
                    'pegawai_kemaskini' => null,
                    'no_tel_pegawai_kemaskini' => null,
                    'nota_kemaskini' => null,
                ]);
            }
        }

        Log_Aktiviti::create([
            'module_id'     => json_encode($ahli_event->id),
            'module_type'   => class_basename(get_class($Aevt)),
            'before'        => null,
            'after'         => json_encode($ahli_event),
            'action'        => $request->route()->getActionMethod(),
            'action_byid'   => $ahli_mesyuarat->id_ahli,
            'action_name'   => $nama,
        ]);

        return redirect("/m_QRCodeBerjaya/{$id_ahli}/{$id}");
    }
}
