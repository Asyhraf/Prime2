<?php

namespace App\Http\Controllers;

// function use
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

// model use
use App\Models\Event;
use App\Models\AhliEvent;
use App\Models\PegawaiKhas;
use App\Models\AhliMesyuarat;
use App\Models\SetiausahaPejabat;
use App\Models\Log_Aktiviti;

class PanggilanMesyuaratController extends Controller
{
    // Auth need to login first
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function indexPanggilan(Request $request)
    {
        $title = $request->get('title');
        $tahun = $request->get('year');

        $eventTitle = Event::where('title', '=', $title)
            ->where('year', '=', $tahun)
            ->get();

        return view('mesyuarat.m_PanggilanMesyuarat')->with(compact('title', 'eventTitle', 'tahun'));
    }

    public function showSenaraiKSUKP($id)
    {
        $event = Event::findOrFail($id);

        $ahliEvent = AhliEvent::join('butiran_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'butiran_ahli_mesyuarat.id_ahli')
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
                'butiran_ahli_mesyuarat.id_ahli',
                'ref_jawatan.nama_jawatan',
                'ref_kementerian.nama_kementerian',
                'gred_lantikan.nama_gred as gred_lantikan',
                'lantikan_ahli_mesyuarat.kekananan_mesy_manual'
            )
            ->orderBy('lantikan_ahli_mesyuarat.kekananan_mesy_manual', 'ASC')
            ->get();

        // Get IDs of existing meeting members
        $existingAhliIds = $ahliEvent->pluck('id_ahli')->toArray();

        // Fetch remaining members not in $ahliEvent
        $ahliMesyuarat = AhliMesyuarat::join('butiran_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'butiran_ahli_mesyuarat.id_ahli')
            ->where('butiran_ahli_mesyuarat.mesyuarat_ksukp', '=', '1')
            ->whereNotIn('ahli_mesyuarat.id_ahli', $existingAhliIds)
            ->where('butiran_ahli_mesyuarat.status', '!=', '0')
            ->get();

        return view('mesyuarat.m-senarai-ahli-ksukp', compact('event', 'ahliEvent', 'ahliMesyuarat'));
    }

    public function showSenaraiMBKM($id)
    {
        $event = Event::findOrFail($id);

        $ahliEvent = AhliEvent::join('butiran_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'butiran_ahli_mesyuarat.id_ahli')
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
                'butiran_ahli_mesyuarat.id_ahli',
                'ref_jawatan.nama_jawatan',
                'ref_kementerian.nama_kementerian',
                'gred_lantikan.nama_gred as gred_lantikan',
                'lantikan_ahli_mesyuarat.kekananan_mesy_manual'
            )
            ->orderBy('lantikan_ahli_mesyuarat.kekananan_mesy_manual', 'ASC')
            ->get();

        // Get IDs of existing meeting members
        $existingAhliIds = $ahliEvent->pluck('id_ahli')->toArray();

        // Fetch remaining members not in $ahliEvent
        $ahliMesyuarat = AhliMesyuarat::join('butiran_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'butiran_ahli_mesyuarat.id_ahli')
            ->where('butiran_ahli_mesyuarat.mesyuarat_mbkm', '=', '1')
            ->whereNotIn('ahli_mesyuarat.id_ahli', $existingAhliIds)
            ->where('butiran_ahli_mesyuarat.status', '!=', '0')
            ->get();

        return view('mesyuarat.m-senarai-ahli-mbkm', compact('event', 'ahliEvent', 'ahliMesyuarat'));
    }

    public function tambahAhli($id, Request $request)
    {
        // Ensure the event exists
        $event = Event::find($id);

        // Validate incoming data
        $validated = $request->validate([
            'ahli' => 'required|exists:butiran_ahli_mesyuarat,id_ahli',
        ]);

        // Retrieve the seniority from lantikan_ahli_mesyuarat
        $susunan = DB::table('lantikan_ahli_mesyuarat')
        ->where('id_ahli', $validated['ahli'])
        ->value('kekananan_mesy_manual');

        // Set to null if no data is found
        $susunan = $susunan ?: null;

        // Check if record already exists
        $existing = AhliEvent::where([
            'mesyuarat_id' => $id,
            'ahli_id' => $validated['ahli'],
        ])->exists();

        if ($existing) {
            return back()->withErrors(['msg' => 'Ahli telah ditambah!']);
        }

        // Create new AhliEvent record
        $add = AhliEvent::create([
            'mesyuarat_id' => $id,
            'ahli_id' => $validated['ahli'],
            'susunan' => $susunan,
        ]);

        // Log the activity
        Log_Aktiviti::create([
            'module_id'   => $add->id,
            'module_type' => class_basename(AhliEvent::class),
            'before'      => null,
            'after'       => json_encode($add),
            'action'      => $request->route()->getActionMethod(),
            'action_byid' => $request->user()->id,
            'action_name' => $request->user()->name,
        ]);

        return back()->with('success', 'Ahli Mesyuarat berjaya ditambah!');
    }

    public function deleteAhli($id, Request $request)
    {
        $ahliEvent   = AhliEvent::find($id);
        $original = $ahliEvent->getOriginal();
        $ahliEvent->delete();

        $changes    =    $ahliEvent->getChanges();

        Log_Aktiviti::create([
            'module_id'     => json_encode($ahliEvent->id),
            'module_type'   => class_basename(get_class($ahliEvent)),
            'before'        => json_encode(array_intersect_key($original, $changes)),
            'after'         => json_encode($changes),
            'action'        =>  $request->route()->getActionMethod(),
            'action_byid'   =>  $request->user()->id,
            'action_name'   =>  $request->user()->name,
        ]);

        return redirect()->back()->with('status', "Ahli Mesyuarat telah berjaya dihapuskan.");
    }

    public function showPanggilanKSUKP($id)
    {
        $event = Event::findOrFail($id);
        $ahliMesyuarat = AhliEvent::join('butiran_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'butiran_ahli_mesyuarat.id_ahli')
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
                'butiran_ahli_mesyuarat.id_ahli',
                'ref_jawatan.nama_jawatan',
                'ref_kementerian.nama_kementerian',
                'gred_lantikan.nama_gred as gred_lantikan',
                'lantikan_ahli_mesyuarat.kekananan_mesy_manual'
            )
            ->orderBy('lantikan_ahli_mesyuarat.kekananan_mesy_manual', 'ASC')
            ->get();

        return view('mesyuarat.m-senarai-panggilan-ksukp', compact('event', 'ahliMesyuarat'));
    }

    public function showPanggilanMBKM($id)
    {
        $event = Event::where('id', $id)->firstOrFail();
        $ahliMesyuarat = AhliEvent::join('butiran_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'butiran_ahli_mesyuarat.id_ahli')
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
                'butiran_ahli_mesyuarat.id_ahli',
                'ref_jawatan.nama_jawatan',
                'ref_kementerian.nama_kementerian',
                'gred_lantikan.nama_gred as nama_gred_lantikan',
                'lantikan_ahli_mesyuarat.kekananan_mesy_manual'
                )
            ->orderBy('lantikan_ahli_mesyuarat.kekananan_mesy_manual', 'ASC')
            ->get();

        return view('mesyuarat.m-senarai-panggilan-mbkm', compact('event', 'ahliMesyuarat'));
    }

    public function emelPanggilanKSUKP($id, $id_ahli)
    {
        // Retrieve the event using the event ID
        $event = Event::where('id', $id)->firstOrFail();
        $event_start = Carbon::parse($event->start)->locale('ms_MY');
        $event_time1 = Carbon::parse($event->time1)->locale('ms_MY');
        $event_time2 = Carbon::parse($event->time2)->locale('ms_MY');

        // Retrieve the ahli (member) where ahli_id matches and kehadiran is null
        $ahli = AhliEvent::where('ahli_id', $id_ahli)
            ->where('mesyuarat_id', $id)
            ->firstOrFail();

        // Join query to fetch related information
        $eventDetails = AhliEvent::join('butiran_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'butiran_ahli_mesyuarat.id_ahli')
            ->join('ahli_mesyuarat', 'butiran_ahli_mesyuarat.id_ahli', '=', 'ahli_mesyuarat.id_ahli')
            ->join('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
            ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
            ->where('ahli_event.mesyuarat_id', $id)
            ->where('ahli_event.ahli_id', $id_ahli)
            ->where('butiran_ahli_mesyuarat.mesyuarat_ksukp', '=', '1')
            ->select('ahli_event.*', 'ahli_mesyuarat.nama_ahli', 'butiran_ahli_mesyuarat.emel', 'ref_jawatan.nama_jawatan', 'ref_kementerian.nama_kementerian')
            ->firstOrFail();

         // Fetch emails from Pegawai Khas
        $pegawaiKhas = PegawaiKhas::where('id_ahli', $id_ahli)
            ->whereNotNull('pegkhas_emel')
            ->where('pegkhas_emel', '!=', '')
            ->pluck('pegkhas_emel');

        // Fetch emails from Setiausaha Pejabat
        $supej = SetiausahaPejabat::where('id_ahli', $id_ahli)
            ->whereNotNull('supej_emel')
            ->where('supej_emel', '!=', '')
            ->pluck('supej_emel');

        $tksuEmails = AhliMesyuarat::join('butiran_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'butiran_ahli_mesyuarat.id_ahli')
            ->join('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
            ->where('ref_jawatan.nama_jawatan', 'Timbalan Ketua Setiausaha (Kabinet)')
            ->pluck('butiran_ahli_mesyuarat.id_ahli', 'butiran_ahli_mesyuarat.emel'); // Use get() for debugging

        $setiausahatksuEmails = SetiausahaPejabat::whereIn('id_ahli', $tksuEmails)
            ->whereNotNull('supej_emel')
            ->where('supej_emel', '!=', '')
            ->pluck('supej_emel');

        // Combine TKSU and Setiausaha Pejabat emails
        $tksusupejEmails = collect($tksuEmails->keys())
            ->merge($setiausahatksuEmails)
            ->flatMap(function ($emails) {
                return collect(preg_split('/[\/,]+/', $emails))->map(fn($email) => trim($email));
            })
            ->filter()
            ->unique()
            ->implode(', ');

        $ccEmails = collect($pegawaiKhas)
            ->merge($supej)
            ->merge($tksusupejEmails) // Add TKSU and Setiausaha emails
            ->flatMap(function ($emails) {
                return collect(preg_split('/[\/,]+/', $emails))->map(fn($email) => trim($email));
            })
            ->filter()
            ->unique()
            ->implode(', ');

        return view('mesyuarat.m-emel-panggilan-ksukp', compact('event', 'event_start', 'event_time1', 'event_time2', 'ahli', 'eventDetails', 'ccEmails'));
    }

    public function emelPanggilanMBKM($id, $id_ahli)
    {
        // Retrieve the event using the event ID
        $event = Event::where('id', $id)->firstOrFail();
        $event_start = Carbon::parse($event->start)->locale('ms_MY');
        $event_time1 = Carbon::parse($event->time1)->locale('ms_MY');
        $event_time2 = Carbon::parse($event->time2)->locale('ms_MY');

        // Retrieve the ahli (member) where ahli_id matches and kehadiran is null
        $ahli = AhliEvent::where('ahli_id', $id_ahli)
            ->where('mesyuarat_id', $id)
            ->firstOrFail();

        // Join query to fetch related information
        $eventDetails = AhliEvent::join('butiran_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'butiran_ahli_mesyuarat.id_ahli')
            ->join('ahli_mesyuarat', 'butiran_ahli_mesyuarat.id_ahli', '=', 'ahli_mesyuarat.id_ahli')
            ->join('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
            ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
            ->where('ahli_event.mesyuarat_id', $id)
            ->where('ahli_event.ahli_id', $id_ahli)
            ->where('butiran_ahli_mesyuarat.mesyuarat_mbkm', '=', '1')
            ->select('ahli_event.*', 'ahli_mesyuarat.nama_ahli', 'butiran_ahli_mesyuarat.emel', 'ref_jawatan.nama_jawatan', 'ref_kementerian.nama_kementerian')
            ->firstOrFail();

         // Fetch emails from Pegawai Khas
        $pegawaiKhas = PegawaiKhas::where('id_ahli', $id_ahli)
            ->whereNotNull('pegkhas_emel')
            ->where('pegkhas_emel', '!=', '')
            ->pluck('pegkhas_emel');

        // Fetch emails from Setiausaha Pejabat
        $supej = SetiausahaPejabat::where('id_ahli', $id_ahli)
            ->whereNotNull('supej_emel')
            ->where('supej_emel', '!=', '')
            ->pluck('supej_emel');

        $tksuEmails = AhliMesyuarat::join('butiran_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'butiran_ahli_mesyuarat.id_ahli')
            ->join('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
            ->where('ref_jawatan.nama_jawatan', 'Timbalan Ketua Setiausaha (Kabinet)')
            ->pluck('butiran_ahli_mesyuarat.id_ahli', 'butiran_ahli_mesyuarat.emel'); // Use get() for debugging

        $setiausahatksuEmails = SetiausahaPejabat::whereIn('id_ahli', $tksuEmails)
            ->whereNotNull('supej_emel')
            ->where('supej_emel', '!=', '')
            ->pluck('supej_emel');

        // Combine TKSU and Setiausaha Pejabat emails
        $tksusupejEmails = collect($tksuEmails->keys())
            ->merge($setiausahatksuEmails)
            ->flatMap(function ($emails) {
                return collect(preg_split('/[\/,]+/', $emails))->map(fn($email) => trim($email));
            })
            ->filter()
            ->unique()
            ->implode(', ');

        $ccEmails = collect($pegawaiKhas)
            ->merge($supej)
            ->merge($tksusupejEmails) // Add TKSU and Setiausaha emails
            ->flatMap(function ($emails) {
                return collect(preg_split('/[\/,]+/', $emails))->map(fn($email) => trim($email));
            })
            ->filter()
            ->unique()
            ->implode(', ');

        return view('mesyuarat.m-emel-panggilan-mbkm', compact('event', 'event_start', 'event_time1', 'event_time2', 'ahli', 'eventDetails', 'ccEmails'));
    }
}
