<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

use App\Models\Event;
use App\Models\AhliMesyuarat;
use App\Models\ButiranAhliMesyuarat;
use App\Models\ref_aktiviti;
use App\Models\AhliEvent;
use App\Models\kehadiranQR;
use App\Models\kekananan_gred;
use App\Models\ref_jawatan;
use App\Models\ref_status_jawatan;
use App\Models\ref_tajuk_mesyuarat;
use App\Models\KodGelaran;
use App\Models\ref_kementerian;
use App\Models\ref_status_ahli;
use App\Models\Log_Aktiviti;

class MesyuaratPengesahanController extends Controller
{
    // Auth need to login first
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        $title = $request->get('title');

        $tahun = $request->get('year');

        $eventTitle = Event::where('title', '=', $title)
            ->where('year', '=', $tahun)
            ->get();

        $events = Event::All();
        $ahli_mesyuarat = ButiranAhliMesyuarat::All();
        $ref_status_jawatan = ref_status_jawatan::All();

        $EventID = Event::All()->pluck('id');

        $AhliEventID = AhliEvent::All()
            ->groupBy('mesyuarat_id');


        // dd($AhliEventID);

        return view('mesyuarat.m_PaparMesyuarat', compact('title', 'eventTitle', 'tahun', 'events', 'ahli_mesyuarat', 'AhliEventID', 'ref_status_jawatan'));
    }

    public function create()
    {
        $ahli_event = AhliEvent::All();
        $events = Event::All();
        $ahli_mesyuarat  = ButiranAhliMesyuarat::All();
        $ref_status_jawatan = ref_status_jawatan::All();
        return view('penyelenggaraan.p_Tambah')->with(compact('ahli_mesyuarat', 'kekananan_gred', 'ref_kementerian', 'ref_status_ahli', 'ref_jawatan', 'ref_status_jawatan'));
    }

    public function deleteEvent($id, Request $request, Event $evt)
    {
        $event   = Event::find($id);
        $title   = $event->title;
        $original = $event->getOriginal();

        // Use a database transaction to ensure atomicity
        DB::transaction(function () use ($id) {
            // Deleting from the event table
            Event::where('id', $id)->delete();

            // Deleting from the ahli_event table
            AhliEvent::where('mesyuarat_id', $id)->delete();
        });

        $changes    =    $event->getChanges();

        Log_Aktiviti::create([
            'module_id'     => json_encode($event->id),
            'module_type'   => class_basename(get_class($event)),
            'before'        => json_encode(array_intersect_key($original, $changes)),
            'after'         => json_encode($changes),
            'action'        =>  $request->route()->getActionMethod(),
            'action_byid'   =>  $request->user()->id,
            'action_name'   =>  $request->user()->name,
        ]);

        return redirect()->back()->with('status', "Rekod $title telah berjaya dihapuskan.");
    }

    public function indexQRPapar(Request $request)
    {
        $title = $request->get('title');

        $tahun = $request->get('year');

        $eventTitle = Event::where('title', '=', $title)
            ->where('year', '=', $tahun)
            ->get();

        $events = Event::All();
        $ahli_mesyuarat = ButiranAhliMesyuarat::All();
        $ref_status_jawatan = ref_status_jawatan::All();

        $EventID = Event::All()->pluck('id');

        $AhliEventID = AhliEvent::All()
            ->groupBy('mesyuarat_id');

        return view('mesyuarat.m_QRPaparMesyuarat', compact('title', 'eventTitle', 'tahun', 'events', 'ahli_mesyuarat', 'AhliEventID', 'ref_status_jawatan'));
    }

    public function indexQRCode($id, Request $request)
    {
        $events = Event::findOrFail($id);
        $eventTitle = $events->title;

        if ($eventTitle == "KSUKP") {
            $butiranAhliMesyuarat = AhliEvent::join('butiran_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'butiran_ahli_mesyuarat.id_ahli')
                ->join('ahli_mesyuarat', 'butiran_ahli_mesyuarat.id_ahli', '=', 'ahli_mesyuarat.id_ahli')
                ->leftJoin('lantikan_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'lantikan_ahli_mesyuarat.id_ahli')
                ->where('ahli_event.mesyuarat_id', $id)
                ->where('butiran_ahli_mesyuarat.mesyuarat_ksukp', '=', '1')
                ->orderByRaw('
                    CASE 
                        WHEN lantikan_ahli_mesyuarat.kekananan_mesy_manual BETWEEN 1 AND 1000 AND butiran_ahli_mesyuarat.status = 1 THEN 1
                        WHEN lantikan_ahli_mesyuarat.kekananan_mesy_manual IS NULL THEN 2                       
                        ELSE 3
                    END
                ')
                ->orderBy('lantikan_ahli_mesyuarat.kekananan_mesy_manual', 'ASC')
                ->get(['butiran_ahli_mesyuarat.*', 'ahli_mesyuarat.nama_ahli']);
        } elseif ($eventTitle == "MBKM") {
            $butiranAhliMesyuarat = AhliEvent::join('butiran_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'butiran_ahli_mesyuarat.id_ahli')
                ->join('ahli_mesyuarat', 'butiran_ahli_mesyuarat.id_ahli', '=', 'ahli_mesyuarat.id_ahli')
                ->leftJoin('lantikan_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'lantikan_ahli_mesyuarat.id_ahli')
                ->where('ahli_event.mesyuarat_id', $id)
                ->where('butiran_ahli_mesyuarat.mesyuarat_mbkm', '=', '1')
                ->orderByRaw('
                    CASE 
                        WHEN lantikan_ahli_mesyuarat.kekananan_mesy_manual BETWEEN 1 AND 1000 AND butiran_ahli_mesyuarat.status = 1 THEN 1
                        WHEN lantikan_ahli_mesyuarat.kekananan_mesy_manual IS NULL THEN 2
                        ELSE 3
                    END
                ')
                ->orderBy('lantikan_ahli_mesyuarat.kekananan_mesy_manual', 'ASC')
                ->get(['butiran_ahli_mesyuarat.*', 'ahli_mesyuarat.nama_ahli']);
        } else {
            return view('mesyuarat.m_PaparMesyuarat', compact('events'));
        }

        // dd($butiranAhliMesyuarat);

        return view('mesyuarat.m_CetakQRCode', compact('butiranAhliMesyuarat', 'events', 'eventTitle'));
    }

    public function getAhliEvent($eventTitle)
    {
        if ($eventTitle == "KSUKP") {
            return AhliEvent::join('butiran_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'butiran_ahli_mesyuarat.id_ahli')
                ->where('butiran_ahli_mesyuarat.mesyuarat_ksukp', '=', '1')
                ->where('butiran_ahli_mesyuarat.id_status_ahli', '=', '1')
                ->distinct()
                ->get();
        } elseif ($eventTitle == "MBKM") {
            return AhliEvent::join('butiran_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'butiran_ahli_mesyuarat.id_ahli')
                ->where('butiran_ahli_mesyuarat.mesyuarat_mbkm', '=', '1')
                ->where('butiran_ahli_mesyuarat.id_status_ahli', '=', '1')
                ->distinct()
                ->get();
        }
        return collect();
    }

    public function semakKehadiranQR($id)
    {
        $event = Event::findOrFail($id);
        $kehadiran = AhliEvent::where('mesyuarat_id', $id)->get();
        $eventTitle = $event->title;

        $ahli_event = $this->getAhliEvent($eventTitle);

        if ($ahli_event->isNotEmpty() && $kehadiran->isEmpty()) {
            foreach ($ahli_event as $ahli) {
                // Delete all duplicate records before inserting the new one
                AhliEvent::where('ahli_id', $ahli->id_ahli)
                    ->where('mesyuarat_id', $event->id)
                    ->delete();

                // Insert the new record
                AhliEvent::create([
                    'ahli_id' => $ahli->id_ahli,
                    'mesyuarat_id' => $event->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
            $kehadiran = AhliEvent::where('mesyuarat_id', $id)->get(); // refetch the updated kehadiran
        }

        if ($eventTitle == "KSUKP") {
            $kehadiran = AhliEvent::join('butiran_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'butiran_ahli_mesyuarat.id_ahli')
                ->join('ahli_mesyuarat', 'butiran_ahli_mesyuarat.id_ahli', '=', 'ahli_mesyuarat.id_ahli')
                ->join('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
                ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
                ->leftJoin('lantikan_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'lantikan_ahli_mesyuarat.id_ahli')
                ->leftJoin('kekananan_gred', 'lantikan_ahli_mesyuarat.id_gred', '=', 'kekananan_gred.id_gred')
                ->where('ahli_event.mesyuarat_id', $id)
                ->where('butiran_ahli_mesyuarat.mesyuarat_ksukp', '=', '1')
                ->select('ahli_event.*', 'ahli_mesyuarat.nama_ahli', 'ref_jawatan.nama_jawatan', 'ref_kementerian.nama_kementerian', 'kekananan_gred.nama_gred', 'lantikan_ahli_mesyuarat.tarikh_lantikan')
                ->orderByRaw('
                CASE 
                    WHEN lantikan_ahli_mesyuarat.kekananan_mesy_manual BETWEEN 1 AND 1000 AND butiran_ahli_mesyuarat.status = 1 THEN 1
                    WHEN lantikan_ahli_mesyuarat.kekananan_mesy_manual IS NULL THEN 2
                    ELSE 3
                END
            ')
                ->orderBy('lantikan_ahli_mesyuarat.kekananan_mesy_manual', 'ASC')
                ->get(['butiran_ahli_mesyuarat.*', 'ahli_mesyuarat.nama_ahli']);
        } elseif ($eventTitle == "MBKM") {
            $kehadiran = AhliEvent::join('butiran_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'butiran_ahli_mesyuarat.id_ahli')
                ->join('ahli_mesyuarat', 'butiran_ahli_mesyuarat.id_ahli', '=', 'ahli_mesyuarat.id_ahli')
                ->join('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
                ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
                ->leftJoin('lantikan_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'lantikan_ahli_mesyuarat.id_ahli')
                ->leftJoin('kekananan_gred', 'lantikan_ahli_mesyuarat.id_gred', '=', 'kekananan_gred.id_gred')
                ->where('ahli_event.mesyuarat_id', $id)
                ->where('butiran_ahli_mesyuarat.mesyuarat_mbkm', '=', '1')
                ->select('ahli_event.*', 'ahli_mesyuarat.nama_ahli', 'ref_jawatan.nama_jawatan', 'ref_kementerian.nama_kementerian', 'kekananan_gred.nama_gred', 'lantikan_ahli_mesyuarat.tarikh_lantikan')
                ->orderByRaw('
                CASE 
                    WHEN lantikan_ahli_mesyuarat.kekananan_mesy_manual BETWEEN 1 AND 1000 AND butiran_ahli_mesyuarat.status = 1 THEN 1
                    WHEN lantikan_ahli_mesyuarat.kekananan_mesy_manual IS NULL THEN 2
                    ELSE 3
                END
            ')
                ->orderBy('lantikan_ahli_mesyuarat.kekananan_mesy_manual', 'ASC')
                ->get(['butiran_ahli_mesyuarat.*', 'ahli_mesyuarat.nama_ahli']);
        }
        // dd($kehadiran);
        return view('mesyuarat.m_SemakanKehadiranQR', compact('kehadiran', 'event', 'eventTitle'));
    }

    public function show($id)
    {
        $wakil = AhliEvent::join('butiran_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'butiran_ahli_mesyuarat.id_ahli')
            ->join('ahli_mesyuarat', 'butiran_ahli_mesyuarat.id_ahli', '=', 'ahli_mesyuarat.id_ahli')
            ->join('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
            ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
            ->where('ahli_event.id', $id)
            ->select('ahli_event.*', 'ahli_mesyuarat.nama_ahli', 'ref_jawatan.nama_jawatan', 'ref_kementerian.nama_kementerian')
            ->firstOrFail();

        // dd($wakil);

        return view('mesyuarat.m_Wakil')->with(compact('wakil'));
    }

    public function blast_email_ksukp($id, $id_ahli)
    {
        // Retrieve the event using the event ID
        $event = Event::where('id', $id)->firstOrFail();

        // Retrieve the ahli (member) where ahli_id matches and kehadiran is null
        $ahli = AhliEvent::where('ahli_id', $id_ahli)
            ->where('mesyuarat_id', $id)
            ->whereNull('kehadiran')
            ->firstOrFail();

        // Join query to fetch related information
        $eventDetails = AhliEvent::join('butiran_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'butiran_ahli_mesyuarat.id_ahli')
            ->join('ahli_mesyuarat', 'butiran_ahli_mesyuarat.id_ahli', '=', 'ahli_mesyuarat.id_ahli')
            ->join('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
            ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
            ->where('ahli_event.mesyuarat_id', $id)
            ->where('ahli_event.ahli_id', $id_ahli)
            ->where('butiran_ahli_mesyuarat.mesyuarat_ksukp', '=', '1')
            ->whereNull('ahli_event.kehadiran')
            ->select('ahli_event.*', 'ahli_mesyuarat.nama_ahli', 'butiran_ahli_mesyuarat.emel', 'ref_jawatan.nama_jawatan', 'ref_kementerian.nama_kementerian')
            ->firstOrFail();

        return view('mesyuarat.m_Email_ksukp', compact('event', 'ahli', 'eventDetails'));
    }

    public function blast_email_mbkm($id, $id_ahli)
    {
        // Retrieve the event using the event ID
        $event = Event::where('id', $id)->firstOrFail();

        // Retrieve the ahli (member) where ahli_id matches and kehadiran is null
        $ahli = AhliEvent::where('ahli_id', $id_ahli)
            ->where('mesyuarat_id', $id)
            ->whereNull('kehadiran')
            ->firstOrFail();

        // Join query to fetch related information
        $eventDetails = AhliEvent::join('butiran_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'butiran_ahli_mesyuarat.id_ahli')
            ->join('ahli_mesyuarat', 'butiran_ahli_mesyuarat.id_ahli', '=', 'ahli_mesyuarat.id_ahli')
            ->join('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
            ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
            ->where('ahli_event.mesyuarat_id', $id)
            ->where('ahli_event.ahli_id', $id_ahli)
            ->where('butiran_ahli_mesyuarat.mesyuarat_mbkm', '=', '1')
            ->whereNull('ahli_event.kehadiran')
            ->select('ahli_event.*', 'ahli_mesyuarat.nama_ahli', 'butiran_ahli_mesyuarat.emel', 'ref_jawatan.nama_jawatan', 'ref_kementerian.nama_kementerian')
            ->firstOrFail();

        return view('mesyuarat.m_Email_mbkm', compact('event', 'ahli', 'eventDetails'));
    }
}
