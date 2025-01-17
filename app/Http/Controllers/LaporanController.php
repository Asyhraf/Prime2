<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// function use
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

// model use
use App\Models\Event;
use App\Models\AhliEvent;
use App\Models\ref_tajuk_mesyuarat;
use App\Models\ref_kementerian;
use App\Models\AhliMesyuarat;
use App\Models\ButiranAhliMesyuarat;
use App\Models\Log_Aktiviti;
use App\Models\Log_User;
use App\Models\ref_unit;

class LaporanController extends Controller
{
    // Auth need to login first
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function indexSusunan(Request $request)
    {
        $title = $request->get('title');

        $tahun = $request->get('year');

        $eventTitle = Event::where('title', '=', $title)
            ->where('year', '=', $tahun)
            ->get();

        return view('laporan.lap-kedudukan')->with(compact('title', 'eventTitle', 'tahun'));
    }

    public function editKedudukanKSUKP($id)
    {
        $event = Event::where('id', $id)->firstOrFail();
        $kehadiran = AhliEvent::join('butiran_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'butiran_ahli_mesyuarat.id_ahli')
            ->join('ahli_mesyuarat', 'butiran_ahli_mesyuarat.id_ahli', '=', 'ahli_mesyuarat.id_ahli')
            ->join('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
            ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
            ->leftJoin('lantikan_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'lantikan_ahli_mesyuarat.id_ahli')
            ->leftJoin('kekananan_gred as gred_lantikan', 'lantikan_ahli_mesyuarat.id_gred', '=', 'gred_lantikan.id_gred')
            ->leftJoin('kekananan_gred as gred_wakil', 'ahli_event.id_gred_wakil', '=', 'gred_wakil.id_gred')
            ->where('ahli_event.mesyuarat_id', $id)
            ->where('butiran_ahli_mesyuarat.mesyuarat_ksukp', '=', '1')
            ->select(
                'ahli_event.*',
                'ahli_mesyuarat.nama_ahli',
                'ref_jawatan.nama_jawatan',
                'ref_kementerian.nama_kementerian',
                'gred_lantikan.nama_gred as nama_gred_lantikan',
                'gred_wakil.nama_gred as nama_gred_wakil',
                'lantikan_ahli_mesyuarat.tarikh_lantikan',
                'lantikan_ahli_mesyuarat.kekananan_mesy_manual',
                'ahli_event.kehadiran',    // Added kehadiran field
                'ahli_event.tarikh_lantikan_wakil',
                'ahli_event.wakil_oleh'    // Added wakil_oleh field
                )
            ->orderByRaw("
                CASE WHEN ahli_event.kehadiran = 'Y' THEN 1 ELSE 2 END
                ")
            ->orderBy('susunan')
            ->get();

        $eventTitle = $event->title;

        return view('laporan.edit-kedudukan-KSUKP')->with(compact('event', 'kehadiran'));
    }

    public function editKedudukanMBKM($id)
    {
        $event = Event::where('id', $id)->firstOrFail();
        $kehadiran = AhliEvent::join('butiran_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'butiran_ahli_mesyuarat.id_ahli')
            ->join('ahli_mesyuarat', 'butiran_ahli_mesyuarat.id_ahli', '=', 'ahli_mesyuarat.id_ahli')
            ->join('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
            ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
            ->leftJoin('lantikan_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'lantikan_ahli_mesyuarat.id_ahli')
            ->leftJoin('kekananan_gred as gred_lantikan', 'lantikan_ahli_mesyuarat.id_gred', '=', 'gred_lantikan.id_gred')
            ->leftJoin('kekananan_gred as gred_wakil', 'ahli_event.id_gred_wakil', '=', 'gred_wakil.id_gred')
            ->where('ahli_event.mesyuarat_id', $id)
            ->where('butiran_ahli_mesyuarat.mesyuarat_mbkm', '=', '1')
            ->select(
                'ahli_event.*',
                'ahli_mesyuarat.nama_ahli',
                'ref_jawatan.nama_jawatan',
                'ref_kementerian.nama_kementerian',
                'gred_lantikan.nama_gred as nama_gred_lantikan',
                'gred_wakil.nama_gred as nama_gred_wakil',
                'lantikan_ahli_mesyuarat.tarikh_lantikan',
                'lantikan_ahli_mesyuarat.kekananan_mesy_manual',
                'ahli_event.kehadiran',    // Added kehadiran field
                'ahli_event.tarikh_lantikan_wakil',
                'ahli_event.wakil_oleh'    // Added wakil_oleh field
                )
            ->orderByRaw("
                CASE WHEN ahli_event.kehadiran = 'Y' THEN 1 ELSE 2 END
                ")
            ->orderBy('susunan')
            ->get();

        $eventTitle = $event->title;

        return view('laporan.edit-kedudukan-MBKM')->with(compact('event', 'kehadiran'));
    }

    public function updateKedudukanKSUKP($id, Request $request, AhliEvent $AEvt)
    {
        // Retrieve the event
        $event = Event::where('id', $id)->firstOrFail();

        // Retrieve all the 'ahli' data submitted from the form
        $ahliData = $request->input('ahli');

        // Loop through each attendee and update their susunan
        foreach ($ahliData as $ahliId => $data) {
            $kehadiran = AhliEvent::where('ahli_id', $ahliId)
                ->where('mesyuarat_id', $id)
                ->firstOrFail();

            // Save original values for logging purposes
            $original = $kehadiran->getOriginal();

            // Update susunan and other necessary fields
            $kehadiran->susunan = $data['susunan'];
            $kehadiran->updated_by = Auth::user()->name;
            $kehadiran->updated_at = Carbon::now()->toDateTimeString();
            $kehadiran->update();

            // Log changes if any
            $changes = $kehadiran->getChanges();
            if (!empty($changes)) {
                Log_Aktiviti::create([
                    'module_id'     => json_encode($kehadiran->mesyuarat_id),
                    'module_type'   => class_basename(get_class($AEvt)),
                    'before'        => json_encode(array_intersect_key($original, $changes)),
                    'after'         => json_encode($changes),
                    'action'        => $request->route()->getActionMethod(),
                    'action_byid'   => $request->user()->id,
                    'action_name'   => $request->user()->name,
                ]);
            }
        }

        // Return back to the view with success message
        return back()
            ->with(compact('event'))
            ->with('status', 'Susun Atur Kedudukan KSUKP telah berjaya diubah suai');
    }

    public function updateKedudukanMBKM($id, Request $request, AhliEvent $AEvt)
    {
        // Retrieve the event
        $event = Event::where('id', $id)->firstOrFail();

        // Retrieve all the 'ahli' data submitted from the form
        $ahliData = $request->input('ahli');

        // Loop through each attendee and update their susunan
        foreach ($ahliData as $ahliId => $data) {
            $kehadiran = AhliEvent::where('ahli_id', $ahliId)
                ->where('mesyuarat_id', $id)
                ->firstOrFail();

            // Save original values for logging purposes
            $original = $kehadiran->getOriginal();

            // Update susunan and other necessary fields
            $kehadiran->susunan = $data['susunan'];
            $kehadiran->updated_by = Auth::user()->name;
            $kehadiran->updated_at = Carbon::now()->toDateTimeString();
            $kehadiran->update();

            // Log changes if any
            $changes = $kehadiran->getChanges();
            if (!empty($changes)) {
                Log_Aktiviti::create([
                    'module_id'     => json_encode($kehadiran->mesyuarat_id),
                    'module_type'   => class_basename(get_class($AEvt)),
                    'before'        => json_encode(array_intersect_key($original, $changes)),
                    'after'         => json_encode($changes),
                    'action'        => $request->route()->getActionMethod(),
                    'action_byid'   => $request->user()->id,
                    'action_name'   => $request->user()->name,
                ]);
            }
        }

        // Return back to the view with success message
        return back()
            ->with(compact('event'))
            ->with('status', 'Susun Atur Kedudukan KSUKP telah berjaya diubah suai');
    }

    public function showKedudukanKSUKP($id)
    {
        $event = Event::findOrFail($id);
        $attendees = AhliEvent::join('butiran_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'butiran_ahli_mesyuarat.id_ahli')
            ->join('ahli_mesyuarat', 'butiran_ahli_mesyuarat.id_ahli', '=', 'ahli_mesyuarat.id_ahli')
            ->join('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
            ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
            ->leftJoin('lantikan_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'lantikan_ahli_mesyuarat.id_ahli')
            ->leftJoin('kekananan_gred as gred_lantikan', 'lantikan_ahli_mesyuarat.id_gred', '=', 'gred_lantikan.id_gred')
            ->leftJoin('kekananan_gred as gred_wakil', 'ahli_event.id_gred_wakil', '=', 'gred_wakil.id_gred')
            ->where('ahli_event.mesyuarat_id', $id)
            ->where('butiran_ahli_mesyuarat.mesyuarat_ksukp', '=', '1')
            ->select(
                'ahli_event.*',
                'ahli_mesyuarat.nama_ahli',
                'ref_jawatan.nama_jawatan',
                'ref_kementerian.nama_kementerian',
                'gred_lantikan.nama_gred as gred_lantikan',
                'gred_wakil.nama_gred as gred_wakil',
                'lantikan_ahli_mesyuarat.tarikh_lantikan',
                'lantikan_ahli_mesyuarat.kekananan_mesy_manual',
                'ahli_event.kehadiran',
                'ahli_event.tarikh_lantikan_wakil',
                'ahli_event.wakil_oleh',
                'ahli_event.susunan'
            )
            ->orderBy('susunan')
            ->get();

        // Filter attendees for each position
        $top = $attendees->where('susunan', 1); // `susunan` 1 goes at the bottom
        $right = $attendees->filter(fn($attendee) => $attendee->susunan % 2 !== 0 && $attendee->susunan != 1); // odd `susunan` except 1
        $left = $attendees->filter(fn($attendee) => $attendee->susunan % 2 === 0); // even `susunan`

        return view('laporan.lap-kedudukan-KSUKP', compact('event', 'attendees', 'top', 'left', 'right'));
    }

    public function showKedudukanMBKM($id)
    {
        $event = Event::findOrFail($id);
        $attendees = AhliEvent::join('butiran_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'butiran_ahli_mesyuarat.id_ahli')
            ->join('ahli_mesyuarat', 'butiran_ahli_mesyuarat.id_ahli', '=', 'ahli_mesyuarat.id_ahli')
            ->join('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
            ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
            ->leftJoin('lantikan_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'lantikan_ahli_mesyuarat.id_ahli')
            ->leftJoin('kekananan_gred as gred_lantikan', 'lantikan_ahli_mesyuarat.id_gred', '=', 'gred_lantikan.id_gred')
            ->leftJoin('kekananan_gred as gred_wakil', 'ahli_event.id_gred_wakil', '=', 'gred_wakil.id_gred')
            ->where('ahli_event.mesyuarat_id', $id)
            ->where('butiran_ahli_mesyuarat.mesyuarat_mbkm', '=', '1')
            ->select(
                'ahli_event.*',
                'ahli_mesyuarat.nama_ahli',
                'ref_jawatan.nama_jawatan',
                'ref_kementerian.nama_kementerian',
                'gred_lantikan.nama_gred as gred_lantikan',
                'gred_wakil.nama_gred as gred_wakil',
                'lantikan_ahli_mesyuarat.tarikh_lantikan',
                'lantikan_ahli_mesyuarat.kekananan_mesy_manual',
                'ahli_event.kehadiran',
                'ahli_event.tarikh_lantikan_wakil',
                'ahli_event.wakil_oleh',
                'ahli_event.susunan'
            )
            ->orderBy('susunan')
            ->get();

        // Filter attendees for each position
        $top = $attendees->where('susunan', 1); // `susunan` 1 goes at the bottom
        $right = $attendees->filter(fn($attendee) => $attendee->susunan % 2 !== 0 && $attendee->susunan != 1); // odd `susunan` except 1
        $left = $attendees->filter(fn($attendee) => $attendee->susunan % 2 === 0); // even `susunan`

        return view('laporan.lap-kedudukan-MBKM', compact('event', 'attendees', 'top', 'left', 'right'));
    }

    public function cetakSusunanKSUKP($id)
    {
        $event = Event::findOrFail($id);
        $attendees = AhliEvent::join('butiran_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'butiran_ahli_mesyuarat.id_ahli')
            ->join('ahli_mesyuarat', 'butiran_ahli_mesyuarat.id_ahli', '=', 'ahli_mesyuarat.id_ahli')
            ->join('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
            ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
            ->leftJoin('lantikan_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'lantikan_ahli_mesyuarat.id_ahli')
            ->leftJoin('kekananan_gred as gred_lantikan', 'lantikan_ahli_mesyuarat.id_gred', '=', 'gred_lantikan.id_gred')
            ->leftJoin('kekananan_gred as gred_wakil', 'ahli_event.id_gred_wakil', '=', 'gred_wakil.id_gred')
            ->where('ahli_event.mesyuarat_id', $id)
            ->where('butiran_ahli_mesyuarat.mesyuarat_ksukp', '=', '1')
            ->select(
                'ahli_event.*',
                'ahli_mesyuarat.nama_ahli',
                'ref_jawatan.nama_jawatan',
                'ref_kementerian.nama_kementerian',
                'gred_lantikan.nama_gred as gred_lantikan',
                'gred_wakil.nama_gred as gred_wakil',
                'lantikan_ahli_mesyuarat.tarikh_lantikan',
                'lantikan_ahli_mesyuarat.kekananan_mesy_manual',
                'ahli_event.kehadiran',
                'ahli_event.tarikh_lantikan_wakil',
                'ahli_event.wakil_oleh',
                'ahli_event.susunan'
            )
            ->orderBy('susunan')
            ->get();

        // Filter attendees for each position
        $top = $attendees->where('susunan', 1); // `susunan` 1 goes at the bottom
        $right = $attendees->filter(fn($attendee) => $attendee->susunan % 2 !== 0 && $attendee->susunan != 1); // odd `susunan` except 1
        $left = $attendees->filter(fn($attendee) => $attendee->susunan % 2 === 0); // even `susunan`

        return view('laporan.cetak-susunan-KSUKP', compact('event', 'attendees', 'top', 'left', 'right'));
    }

    public function indexStatistik(Request $request)
    {
        //Data dari form
        $jenis_mesyuarat = $request->get('title');
        $tahun = $request->get('year');

        $ahli_event = AhliEvent::all();

        // dd($ahli_event);


        //Kiraan bilangan mesyuarat pada tahun tersebut
        $eventCount = Event::where('title', $jenis_mesyuarat)
            ->where('year', $tahun)->count();

        // dd($eventCount);

        //Nak ambil id mesyuarat yang berjalan pada tahun tersebut.
        $paparan = Event::where('title', $jenis_mesyuarat)
            ->where('year', $tahun)->pluck('id');

        // dd($paparan);

        $paparanCount = Event::where('title', $jenis_mesyuarat)
            ->where('year', $tahun)
            ->count();

        // dd($paparanCount);


        // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

        //Kiraan bilangan ahli yang telah dilantik pada tahun tersebut

        if ($jenis_mesyuarat == "KSUKP") {
            $ahli_mesyuaratCount = AhliMesyuarat::join('butiran_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'butiran_ahli_mesyuarat.id_ahli')
                ->join('lantikan_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'lantikan_ahli_mesyuarat.id_ahli')
                ->leftJoin('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
                ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
                ->leftJoin('kekananan_gred', 'lantikan_ahli_mesyuarat.id_gred', '=', 'kekananan_gred.id_gred')
                ->where('butiran_ahli_mesyuarat.mesyuarat_ksukp', '=', '1')
                ->where('butiran_ahli_mesyuarat.id_status_ahli', '=', 'A')
                ->select('ahli_mesyuarat.*', 'ref_jawatan.nama_jawatan', 'ref_kementerian.nama_kementerian',  'ref_kementerian.singkatan_kementerian', 'kekananan_gred.nama_gred', 'lantikan_ahli_mesyuarat.tarikh_lantikan')
                ->orderByRaw('
        CASE
            WHEN lantikan_ahli_mesyuarat.kekananan_mesy_manual BETWEEN 1 AND 1000 AND butiran_ahli_mesyuarat.status = 1 THEN 1
            WHEN lantikan_ahli_mesyuarat.kekananan_mesy_manual IS NULL THEN 2
            ELSE 3
        END
    ')
                ->orderBy('lantikan_ahli_mesyuarat.kekananan_mesy_manual', 'ASC')
                ->orderBy('lantikan_ahli_mesyuarat.id_gred', 'ASC')
                ->orderBy('lantikan_ahli_mesyuarat.tarikh_lantikan', 'ASC')
                ->count();

            $ahli_mesyuaratID = AhliMesyuarat::join('butiran_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'butiran_ahli_mesyuarat.id_ahli')
                ->join('lantikan_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'lantikan_ahli_mesyuarat.id_ahli')
                ->leftJoin('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
                ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
                ->leftJoin('kekananan_gred', 'lantikan_ahli_mesyuarat.id_gred', '=', 'kekananan_gred.id_gred')
                ->where('butiran_ahli_mesyuarat.mesyuarat_ksukp', '=', '1')
                ->where('butiran_ahli_mesyuarat.id_status_ahli', '=', 'A')
                ->select('ahli_mesyuarat.*', 'ref_jawatan.nama_jawatan', 'ref_kementerian.nama_kementerian',  'ref_kementerian.singkatan_kementerian', 'kekananan_gred.nama_gred', 'lantikan_ahli_mesyuarat.tarikh_lantikan')
                ->orderByRaw('
        CASE
            WHEN lantikan_ahli_mesyuarat.kekananan_mesy_manual BETWEEN 1 AND 1000 AND butiran_ahli_mesyuarat.status = 1 THEN 1
            WHEN lantikan_ahli_mesyuarat.kekananan_mesy_manual IS NULL THEN 2
            ELSE 3
        END
    ')
                ->orderBy('lantikan_ahli_mesyuarat.kekananan_mesy_manual', 'ASC')
                ->orderBy('lantikan_ahli_mesyuarat.id_gred', 'ASC')
                ->orderBy('lantikan_ahli_mesyuarat.tarikh_lantikan', 'ASC')
                ->pluck('ahli_mesyuarat.id_ahli');

            $ahli_mesyuarat =  AhliMesyuarat::join('butiran_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'butiran_ahli_mesyuarat.id_ahli')
                ->join('lantikan_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'lantikan_ahli_mesyuarat.id_ahli')
                ->leftJoin('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
                ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
                ->leftJoin('kekananan_gred', 'lantikan_ahli_mesyuarat.id_gred', '=', 'kekananan_gred.id_gred')
                ->where('butiran_ahli_mesyuarat.mesyuarat_ksukp', '=', '1')
                ->where('butiran_ahli_mesyuarat.id_status_ahli', '=', 'A')
                ->select('ahli_mesyuarat.*', 'ref_jawatan.nama_jawatan', 'ref_kementerian.nama_kementerian',  'ref_kementerian.singkatan_kementerian', 'kekananan_gred.nama_gred', 'lantikan_ahli_mesyuarat.tarikh_lantikan')
                ->orderByRaw('
        CASE
            WHEN lantikan_ahli_mesyuarat.kekananan_mesy_manual BETWEEN 1 AND 1000 AND butiran_ahli_mesyuarat.status = 1 THEN 1
            WHEN lantikan_ahli_mesyuarat.kekananan_mesy_manual IS NULL THEN 2
            ELSE 3
        END
    ')
                ->orderBy('lantikan_ahli_mesyuarat.kekananan_mesy_manual', 'ASC')
                ->orderBy('lantikan_ahli_mesyuarat.id_gred', 'ASC')
                ->orderBy('lantikan_ahli_mesyuarat.tarikh_lantikan', 'ASC')
                ->get();
        } elseif ($jenis_mesyuarat == "MBKM") {
            $ahli_mesyuaratCount =  AhliMesyuarat::join('butiran_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'butiran_ahli_mesyuarat.id_ahli')
                ->join('lantikan_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'lantikan_ahli_mesyuarat.id_ahli')
                ->leftJoin('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
                ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
                ->leftJoin('kekananan_gred', 'lantikan_ahli_mesyuarat.id_gred', '=', 'kekananan_gred.id_gred')
                ->where('butiran_ahli_mesyuarat.mesyuarat_mbkm', '=', '1')
                ->where('butiran_ahli_mesyuarat.id_status_ahli', '=', 'A')
                ->select('ahli_mesyuarat.*', 'ref_jawatan.nama_jawatan', 'ref_kementerian.nama_kementerian',  'ref_kementerian.singkatan_kementerian', 'kekananan_gred.nama_gred', 'lantikan_ahli_mesyuarat.tarikh_lantikan')
                ->orderByRaw('
        CASE
            WHEN lantikan_ahli_mesyuarat.kekananan_mesy_manual BETWEEN 1 AND 1000 AND butiran_ahli_mesyuarat.status = 1 THEN 1
            WHEN lantikan_ahli_mesyuarat.kekananan_mesy_manual IS NULL THEN 2
            ELSE 3
        END
    ')
                ->orderBy('lantikan_ahli_mesyuarat.kekananan_mesy_manual', 'ASC')
                ->orderBy('lantikan_ahli_mesyuarat.id_gred', 'ASC')
                ->orderBy('lantikan_ahli_mesyuarat.tarikh_lantikan', 'ASC')
                ->count();

            $ahli_mesyuaratID =  AhliMesyuarat::join('butiran_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'butiran_ahli_mesyuarat.id_ahli')
                ->leftJoin('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
                ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
                ->leftJoin('lantikan_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'lantikan_ahli_mesyuarat.id_ahli')
                ->leftJoin('kekananan_gred', 'lantikan_ahli_mesyuarat.id_gred', '=', 'kekananan_gred.id_gred')
                ->where('butiran_ahli_mesyuarat.mesyuarat_mbkm', '=', '1')
                ->where('butiran_ahli_mesyuarat.id_status_ahli', '=', 'A')
                ->select('ahli_mesyuarat.*', 'ref_jawatan.nama_jawatan', 'ref_kementerian.nama_kementerian',  'ref_kementerian.singkatan_kementerian', 'kekananan_gred.nama_gred', 'lantikan_ahli_mesyuarat.tarikh_lantikan')
                ->orderByRaw('
        CASE
            WHEN lantikan_ahli_mesyuarat.kekananan_mesy_manual BETWEEN 1 AND 1000 AND butiran_ahli_mesyuarat.status = 1 THEN 1
            WHEN lantikan_ahli_mesyuarat.kekananan_mesy_manual IS NULL THEN 2
            ELSE 3
        END
    ')
                ->orderBy('lantikan_ahli_mesyuarat.kekananan_mesy_manual', 'ASC')
                ->orderBy('lantikan_ahli_mesyuarat.id_gred', 'ASC')
                ->orderBy('lantikan_ahli_mesyuarat.tarikh_lantikan', 'ASC')
                ->pluck('ahli_mesyuarat.id_ahli');

            $ahli_mesyuarat = AhliMesyuarat::join('butiran_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'butiran_ahli_mesyuarat.id_ahli')
                ->leftJoin('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
                ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
                ->leftJoin('lantikan_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'lantikan_ahli_mesyuarat.id_ahli')
                ->leftJoin('kekananan_gred', 'lantikan_ahli_mesyuarat.id_gred', '=', 'kekananan_gred.id_gred')
                ->where('butiran_ahli_mesyuarat.mesyuarat_mbkm', '=', '1')
                ->where('butiran_ahli_mesyuarat.id_status_ahli', '=', 'A')
                ->select('ahli_mesyuarat.*', 'ref_jawatan.nama_jawatan', 'ref_kementerian.nama_kementerian',  'ref_kementerian.singkatan_kementerian', 'kekananan_gred.nama_gred', 'lantikan_ahli_mesyuarat.tarikh_lantikan')
                ->orderByRaw('
        CASE
            WHEN lantikan_ahli_mesyuarat.kekananan_mesy_manual BETWEEN 1 AND 1000 AND butiran_ahli_mesyuarat.status = 1 THEN 1
            WHEN lantikan_ahli_mesyuarat.kekananan_mesy_manual IS NULL THEN 2
            ELSE 3
        END
    ')
                ->orderBy('lantikan_ahli_mesyuarat.kekananan_mesy_manual', 'ASC')
                ->orderBy('lantikan_ahli_mesyuarat.id_gred', 'ASC')
                ->orderBy('lantikan_ahli_mesyuarat.tarikh_lantikan', 'ASC')
                ->get();
        } else {
            return view('laporan.lap_Statistik')->with(compact('jenis_mesyuarat', 'tahun'));
        }

        // dd($ahli_mesyuaratCount);
        // dd($ahli_mesyuaratID);


        // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

        $mesyuaratList = AhliEvent::join('events', 'events.id', '=', 'ahli_event.mesyuarat_id')
            ->join('ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'ahli_event.ahli_id')
            ->join('butiran_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'butiran_ahli_mesyuarat.id_ahli')
            ->where('events.title', '=', $jenis_mesyuarat)
            ->where('events.year', '=', $tahun)
            ->where('ahli_event.kehadiran', '=', 'N')
            ->get();

        // dd($mesyuaratList);


        $mesyuaratListCount = AhliEvent::join('events', 'events.id', '=', 'ahli_event.mesyuarat_id')
            ->join('ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'ahli_event.ahli_id')
            ->join('butiran_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'butiran_ahli_mesyuarat.id_ahli')
            ->where('events.title', '=', $jenis_mesyuarat)
            ->where('events.year', '=', $tahun)
            ->where('ahli_event.kehadiran', '=', 'N')
            ->count();

        // dd($mesyuaratListCount);


        $mesyuaratList2 = AhliEvent::join('events', 'events.id', '=', 'ahli_event.mesyuarat_id')
            ->where('events.title', '=', $jenis_mesyuarat)
            ->where('events.year', '=', $tahun)
            ->where('ahli_event.kehadiran', '=', 'N')
            ->get();

        // dd($mesyuaratList2);


        $mesyList = AhliEvent::join('events', 'events.id', '=', 'ahli_event.mesyuarat_id')
            ->join('ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'ahli_event.ahli_id')
            ->join('butiran_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'butiran_ahli_mesyuarat.id_ahli')
            ->where('events.title', '=', $jenis_mesyuarat)
            ->where('events.year', '=', $tahun)
            ->where('ahli_event.kehadiran', '=', 'N')
            ->pluck('ahli_event.mesyuarat_id');

        // dd($mesyList);


        // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


        for ($b = 0; $b < $ahli_mesyuaratCount; $b++) {
            $ketidakhadiranCount1[$b] = Event::join('ahli_event', 'ahli_event.mesyuarat_id', '=', 'events.id')
                ->where('events.year', '=', $tahun)
                ->where('title', '=', $jenis_mesyuarat)
                ->where('ahli_event.kehadiran', '=', 'N')
                ->where('ahli_event.ahli_id', '=', '1')
                ->count();
        }

        // dd($ketidakhadiranCount1);

        if ($eventCount > 0) {
            for ($c = 0; $c < $ahli_mesyuaratCount; $c++)

                $ketidakhadiranCount2[$c] = Event::join('ahli_event', 'ahli_event.mesyuarat_id', '=', 'events.id')
                    ->where('events.year', '=', $tahun)
                    ->where('title', '=', $jenis_mesyuarat)
                    ->where('ahli_event.kehadiran', '=', 'N')
                    ->where('ahli_event.ahli_id', '=', $ahli_mesyuaratID[$c])
                    ->count();

            // dd($ketidakhadiranCount2);
        } else {
            return view('laporan.lap_Statistik')->with(compact('jenis_mesyuarat', 'tahun', 'eventCount'));
        }

        if ($eventCount > 0) {
            for ($c = 0; $c < $ahli_mesyuaratCount; $c++)

                $jumlahJemputan[$c] = Event::join('ahli_event', 'ahli_event.mesyuarat_id', '=', 'events.id')
                    ->where('events.year', '=', $tahun)
                    ->where('title', '=', $jenis_mesyuarat)
                    ->where('ahli_event.ahli_id', '=', $ahli_mesyuaratID[$c])
                    ->count();

            // dd($jumlahJemputan);

        } else {
            return view('laporan.lap_Statistik')->with(compact('jenis_mesyuarat', 'tahun', 'eventCount'));
        }

        if ($eventCount > 0) {
            for ($c = 0; $c < $ahli_mesyuaratCount; $c++)

                if ($jumlahJemputan[$c] == 0) {
                    $peratusan[$c] = 0;
                } else {
                    $peratusan[$c] = ($ketidakhadiranCount2[$c] / $jumlahJemputan[$c]) * 100;
                }

            // dd($peratusan);

        } else {
            return view('laporan.lap_Statistik')->with(compact('jenis_mesyuarat', 'tahun', 'eventCount'));
        }

        // dd($peratusan);
        // dd($jumlahJemputan);
        // dd($ketidakhadiranCount2);
        // dd($eventCount);

        return view('laporan.lap_Statistik')->with(compact('ahli_mesyuarat', 'jenis_mesyuarat', 'tahun', 'eventCount', 'ahli_mesyuaratCount', 'mesyuaratList', 'paparan', 'mesyList', 'mesyuaratListCount', 'paparanCount', 'ketidakhadiranCount2', 'jumlahJemputan', 'peratusan'));
    }

    /*--------------------------------------------------------------------------
    * Function used for   : paparan log aktiviti
    * Page used           : log_aktiviti.blade.php
    * Model used          : log_aktiviti
    * Variable used       : -
    * variable from       : -
    * variable sent to    : -
    /*---------------------------- Function Begin ----------------------------*/
    public function log_aktiviti()
    {
        $log = Log_Aktiviti::orderBy('id', 'DESC')
            ->get();

        return view('laporan.log_aktiviti')
            ->with(compact('log'));
    }
    /*----------------------------- Function End -------------------------------*/

    /*--------------------------------------------------------------------------
    * Function used for   : paparan log user
    * Page used           : log_user.blade.php
    * Model used          : log_user
    * Variable used       : -
    * variable from       : -
    * variable sent to    : -
    /*---------------------------- Function Begin ----------------------------*/
    public function log_login(Request $request)
    {
        $tarikh1 = $request->get('tarikh_mula');
        $tarikh2 = $request->get('tarikh_akhir');
        $req_unit = $request->get('unit');
        $unit      = ref_unit::all();

        if ($req_unit == "0" || $req_unit == "null") {
            $log = Log_User::whereBetween('login_at', [$tarikh1, $tarikh2])
                ->orWhereDate('login_at', $tarikh1)
                ->orWhereDate('login_at', $tarikh2)
                // ->orderBy('id', 'DESC')
                ->get();
        } else {
            $log = Log_User::join('users', 'users.id', 'log_user.id_pengguna')
                ->where('users.unit', '=', $req_unit)
                ->where(function ($query) use ($tarikh1, $tarikh2) {
                    $query->whereBetween('login_at', [$tarikh1, $tarikh2])
                        ->orWhereDate('login_at', $tarikh1)
                        ->orWhereDate('login_at', $tarikh2);
                })
                // ->orderBy('id', 'DESC')
                ->get();
        }
        $unit_req = ref_unit::where('id_unit', $req_unit)
        // ->get();
        // ->get('nama_unit');
        ->pluck('nama_unit')
        ->first();
        // dd($unit_req);

        return view('laporan.log_user')
            ->with(compact('log','tarikh1', 'tarikh2', 'unit', 'unit_req'));
    }
    /*----------------------------- Function End -------------------------------*/
}
