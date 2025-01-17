<?php

namespace App\Http\Controllers;

use Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Models\AhliEvent;
use App\Models\AhliMesyuarat;
use App\Models\ButiranAhliMesyuarat;
use App\Models\Event;
use App\Models\kekananan_gred;
use App\Models\ref_jawatan;
use App\Models\ref_status_jawatan;
use App\Models\Log_Aktiviti;

class AhliEventController extends Controller
{

    // Auth need to login first
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function papar_pengesahan_kehadiran($id)
    {
        $kekananan_gred = kekananan_gred::all();
        $ref_jawatan     = ref_jawatan::all();
        $ref_status_jawatan   = ref_status_jawatan::all();
        $event = Event::whereid($id)->firstOrFail();
        $eventTitle = $event->title;

        if ($eventTitle == "KSUKP") {
            $ahli_event = AhliEvent::join('butiran_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'butiran_ahli_mesyuarat.id_ahli')
                ->join('ahli_mesyuarat', 'butiran_ahli_mesyuarat.id_ahli', '=', 'ahli_mesyuarat.id_ahli')
                ->join('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
                ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
                ->leftJoin('lantikan_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'lantikan_ahli_mesyuarat.id_ahli')
                ->leftJoin('kekananan_gred', 'lantikan_ahli_mesyuarat.id_gred', '=', 'kekananan_gred.id_gred')
                ->where('ahli_event.mesyuarat_id', $id)
                ->where('butiran_ahli_mesyuarat.mesyuarat_ksukp', '=', '1')
                ->select('ahli_event.*', 'ahli_mesyuarat.nama_ahli', 'ref_jawatan.nama_jawatan', 'ref_kementerian.nama_kementerian', 'kekananan_gred.nama_gred', 'lantikan_ahli_mesyuarat.tarikh_lantikan', 'ahli_event.tarikh_lantikan_wakil')
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
            $ahli_event = AhliEvent::join('butiran_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'butiran_ahli_mesyuarat.id_ahli')
                ->join('ahli_mesyuarat', 'butiran_ahli_mesyuarat.id_ahli', '=', 'ahli_mesyuarat.id_ahli')
                ->join('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
                ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
                ->leftJoin('lantikan_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'lantikan_ahli_mesyuarat.id_ahli')
                ->leftJoin('kekananan_gred', 'lantikan_ahli_mesyuarat.id_gred', '=', 'kekananan_gred.id_gred')
                ->where('ahli_event.mesyuarat_id', $id)
                ->where('butiran_ahli_mesyuarat.mesyuarat_mbkm', '=', '1')
                ->select('ahli_event.*', 'ahli_mesyuarat.nama_ahli', 'ref_jawatan.nama_jawatan', 'ref_kementerian.nama_kementerian', 'kekananan_gred.nama_gred', 'lantikan_ahli_mesyuarat.tarikh_lantikan', 'ahli_event.tarikh_lantikan_wakil')
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
        // dd($ahli_event);
        return view('mesyuarat.m_PengesahanKehadiran', compact('event', 'ahli_event', 'ref_jawatan', 'ref_status_jawatan', 'kekananan_gred'));
    }

    public function store_pengesahan_kehadiran($id, Request $request, AhliEvent $Aevt)
    {
        $event = Event::whereid($id)->firstOrFail();

        $title    = $event->title;
        $bilangan = $event->meeting_numbers;
        $tahun    = $event->year;

        $ahliEventAhli = AhliEvent::where('mesyuarat_id', '=', $id)->get();

        foreach ($ahliEventAhli as $counter => $ahli) {
            $counter++;

            $ahli->kehadiran = $request->kehadiran[$counter];

            if ($request->kehadiran[$counter] == 'N') {
                $ahli->catatan = $request->catatan[$counter];
                $ahli->jawatan_wakil = $request->jawatan_wakil[$counter];
                $ahli->wakil_oleh = $request->wakil_oleh[$counter];
                $ahli->id_gred_wakil = $request->id_gred_wakil[$counter];
                $ahli->tarikh_lantikan_wakil = $request->tarikh_lantikan_wakil[$counter];
                $ahli->id_status_jawatan = $request->id_status_jawatan[$counter];
                $ahli->pegawai_kemaskini = $request->pegawai_kemaskini[$counter];
                $ahli->no_tel_pegawai_kemaskini = $request->no_tel_pegawai_kemaskini[$counter];
            } else {
                // Set other fields to null if kehadiran is 'Y'
                $ahli->catatan = null;
                $ahli->jawatan_wakil = null;
                $ahli->wakil_oleh = null;
                $ahli->id_gred_wakil = null;
                $ahli->tarikh_lantikan_wakil = null;
                $ahli->id_status_jawatan = null;
                $ahli->pegawai_kemaskini = null;
                $ahli->no_tel_pegawai_kemaskini = null;
            }

            $ahli->update();

            Log_Aktiviti::create([
                'module_id'     => json_encode($ahli->mesyuarat_id),
                'module_type'   => class_basename(get_class($Aevt)),
                'before'        => null,
                'after'         => json_encode($ahli),
                'action'        => $request->route()->getActionMethod(),
                'action_byid'   => $request->user()->id,
                'action_name'   => $request->user()->name,
            ]);
        }

        // simpan status=1 - Kehadiran Mesyuarat telah disahkan
        $ahli1 = Event::find($id);
        $ahli1->status = $request->get('status');
        $ahli1->save();

        return redirect('/m_PaparMesyuarat')->with('status', "Kehadiran Ahli Mesyuarat $title bilangan $bilangan/ $tahun sudah disahkan");
    }

    public function update_ubah_kehadiran($id, Request $request)
    {
        $kekananan_gred = kekananan_gred::all();
        $ref_jawatan     = ref_jawatan::all();
        $ref_status_jawatan   = ref_status_jawatan::all();
        $event = Event::whereid($id)->firstOrFail();

        $eventTitle = $event->title;

        if ($eventTitle == "KSUKP") {
            $ahli_event = AhliEvent::join('butiran_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'butiran_ahli_mesyuarat.id_ahli')
                ->join('ahli_mesyuarat', 'butiran_ahli_mesyuarat.id_ahli', '=', 'ahli_mesyuarat.id_ahli')
                ->join('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
                ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
                ->leftJoin('lantikan_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'lantikan_ahli_mesyuarat.id_ahli')
                ->leftJoin('kekananan_gred', 'lantikan_ahli_mesyuarat.id_gred', '=', 'kekananan_gred.id_gred')
                ->where('ahli_event.mesyuarat_id', $id)
                ->where('butiran_ahli_mesyuarat.mesyuarat_ksukp', '=', '1')
                ->select('ahli_event.*', 'ahli_mesyuarat.nama_ahli', 'ref_jawatan.nama_jawatan', 'ref_kementerian.nama_kementerian', 'kekananan_gred.nama_gred', 'lantikan_ahli_mesyuarat.tarikh_lantikan', 'ahli_event.tarikh_lantikan_wakil')
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
            $ahli_event = AhliEvent::join('butiran_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'butiran_ahli_mesyuarat.id_ahli')
                ->join('ahli_mesyuarat', 'butiran_ahli_mesyuarat.id_ahli', '=', 'ahli_mesyuarat.id_ahli')
                ->join('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
                ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
                ->leftJoin('lantikan_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'lantikan_ahli_mesyuarat.id_ahli')
                ->leftJoin('kekananan_gred', 'lantikan_ahli_mesyuarat.id_gred', '=', 'kekananan_gred.id_gred')
                ->where('ahli_event.mesyuarat_id', $id)
                ->where('butiran_ahli_mesyuarat.mesyuarat_mbkm', '=', '1')
                ->select('ahli_event.*', 'ahli_mesyuarat.nama_ahli', 'ref_jawatan.nama_jawatan', 'ref_kementerian.nama_kementerian', 'kekananan_gred.nama_gred', 'lantikan_ahli_mesyuarat.tarikh_lantikan', 'ahli_event.tarikh_lantikan_wakil')
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

        return view('mesyuarat.m_UbahKehadiran')->with(compact('event', 'ahli_event', 'ref_jawatan', 'ref_status_jawatan', 'kekananan_gred'));
    }


    public function kemaskini_ubah_kehadiran($id, Request $request, AhliEvent $Aevt)
    {
        $event    = Event::whereid($id)->firstOrFail();
        $title    = $event->title;
        $bilangan = $event->meeting_numbers;
        $tahun    = $event->year;

        $ahliEventAhli = AhliEvent::where('mesyuarat_id', '=', $id)->get();

        foreach ($ahliEventAhli as $counter => $ahli) {
            $counter++;

            $original = $ahli->getOriginal();
            $kehadiran = $request->kehadiran[$counter] ?? null;

            if ($kehadiran !== null) {
                $ahli->kehadiran = $kehadiran;

                if ($kehadiran == 'N') {
                    $ahli->catatan = $request->catatan[$counter] ?? null;
                    $ahli->jawatan_wakil = $request->jawatan_wakil[$counter] ?? null;
                    $ahli->wakil_oleh = $request->wakil_oleh[$counter] ?? null;
                    $ahli->id_gred_wakil = $request->id_gred_wakil[$counter] ?? null;
                    $ahli->tarikh_lantikan_wakil = $request->has("tarikh_lantikan_wakil.$counter") ? $request->input("tarikh_lantikan_wakil.$counter") : null;
                    $ahli->id_status_jawatan = $request->id_status_jawatan[$counter] ?? null;
                    $ahli->pegawai_kemaskini = $request->pegawai_kemaskini[$counter] ?? null;
                    $ahli->no_tel_pegawai_kemaskini = $request->no_tel_pegawai_kemaskini[$counter] ?? null;
                } else {
                    // Set other fields to null if kehadiran is 'Y'
                    $ahli->catatan = null;
                    $ahli->jawatan_wakil = null;
                    $ahli->wakil_oleh = null;
                    $ahli->id_gred_wakil = null;
                    $ahli->tarikh_lantikan_wakil = null;
                    $ahli->id_status_jawatan = null;
                    $ahli->pegawai_kemaskini = null;
                    $ahli->no_tel_pegawai_kemaskini = null;
                }

                $ahli->updated_by = Auth::user()->name;
                $ahli->updated_at = Carbon::now()->toDateTimeString();
                $ahli->update();

                $Changes = $ahli->getChanges();

                Log_Aktiviti::create([
                    'module_id'     => json_encode($ahli->mesyuarat_id),
                    'module_type'   => class_basename(get_class($ahli)),
                    'before'        => json_encode(array_intersect_key($original, $Changes)),
                    'after'         => json_encode($Changes),
                    'action'        => $request->route()->getActionMethod(),
                    'action_byid'   => $request->user()->id,
                    'action_name'   => $request->user()->name,
                ]);
            }
        }

        return redirect('/m_PaparMesyuarat')
            ->with('status', "Rekod $title bilangan $bilangan/ $tahun berjaya diubah suai");
    }

    public function cetakhadir($document_type, $id)
    {

        $date = Carbon::now();

        $event = Event::whereid($id)->firstOrFail();

        $eventTitle = $event->title;

        if ($eventTitle == "KSUKP") {
            $kehadiran = AhliEvent::join('butiran_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'butiran_ahli_mesyuarat.id_ahli')
                ->join('ahli_mesyuarat', 'butiran_ahli_mesyuarat.id_ahli', '=', 'ahli_mesyuarat.id_ahli')
                ->join('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
                ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
                ->leftJoin('lantikan_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'lantikan_ahli_mesyuarat.id_ahli')
                ->leftJoin('kekananan_gred', 'lantikan_ahli_mesyuarat.id_gred', '=', 'kekananan_gred.id_gred')
                ->where('ahli_event.mesyuarat_id', $id)
                ->where('butiran_ahli_mesyuarat.mesyuarat_ksukp', '=', '1')
                ->where('ahli_event.kehadiran', '=', 'Y')
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
                ->where('ahli_event.kehadiran', '=', 'Y')
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
        return view('mesyuarat.m_CetakanKehadiran2')->with(compact('event', 'kehadiran', 'date'));
    }

    public function cetaktidakhadir($document_type, $id)
    {
        $date = Carbon::now();

        $event = Event::whereid($id)->firstOrFail();

        $eventTitle = $event->title;

        if ($eventTitle == "KSUKP") {
            $tidakkehadiran = AhliEvent::join('butiran_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'butiran_ahli_mesyuarat.id_ahli')
                ->join('ahli_mesyuarat', 'butiran_ahli_mesyuarat.id_ahli', '=', 'ahli_mesyuarat.id_ahli')
                ->join('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
                ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
                ->leftJoin('lantikan_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'lantikan_ahli_mesyuarat.id_ahli')
                ->leftJoin('kekananan_gred', 'lantikan_ahli_mesyuarat.id_gred', '=', 'kekananan_gred.id_gred')
                ->where('ahli_event.mesyuarat_id', $id)
                ->where('butiran_ahli_mesyuarat.mesyuarat_ksukp', '=', '1')
                ->where('ahli_event.kehadiran', '=', 'N')
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
            $tidakkehadiran = AhliEvent::join('butiran_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'butiran_ahli_mesyuarat.id_ahli')
                ->join('ahli_mesyuarat', 'butiran_ahli_mesyuarat.id_ahli', '=', 'ahli_mesyuarat.id_ahli')
                ->join('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
                ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
                ->leftJoin('lantikan_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'lantikan_ahli_mesyuarat.id_ahli')
                ->leftJoin('kekananan_gred', 'lantikan_ahli_mesyuarat.id_gred', '=', 'kekananan_gred.id_gred')
                ->where('ahli_event.mesyuarat_id', $id)
                ->where('butiran_ahli_mesyuarat.mesyuarat_mbkm', '=', '1')
                ->where('ahli_event.kehadiran', '=', 'N')
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
        // dd($tidakkehadiran);
        return view('mesyuarat.m_CetakanTidakKehadiran2')->with(compact('event', 'tidakkehadiran', 'date'));
    }
}
