<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
// use Request;
use Illuminate\Support\Facades\Input;
use App\Models\AhliEvent;
use App\Models\Event;
use App\Models\ref_tajuk_mesyuarat;
use App\Models\ref_kementerian;
use App\Models\AhliMesyuarat;
use App\Models\KodGelaran;
use Illuminate\Support\Carbon;

class EdaranDokumenController extends Controller
{
    // Auth need to login first
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function indexEdaran(Request $request)
    {
        $title = $request->get('title');

        $tahun = $request->get('year');

        $eventTitle = Event::where('title', '=', $title)
            ->where('year', '=', $tahun)
            ->get();

        return view('mesyuarat.m_EdaranDokumen')->with(compact('title', 'tahun', 'eventTitle'));
    }

    public function cetakanEdaran_ksukp(Request $request, $id)
    {
        $event = Event::whereid($id)->firstOrFail();
        $event_start = Carbon::parse($event->start)->locale('ms_MY');
        $event_time1 = Carbon::parse($event->time1)->locale('ms_MY');
        $event_time2 = Carbon::parse($event->time2)->locale('ms_MY');

        $edaran_dokumen =  AhliEvent::join('butiran_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'butiran_ahli_mesyuarat.id_ahli')
            ->join('ahli_mesyuarat', 'butiran_ahli_mesyuarat.id_ahli', '=', 'ahli_mesyuarat.id_ahli')
            ->join('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
            ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
            ->leftJoin('lantikan_ahli_mesyuarat', 'butiran_ahli_mesyuarat.id_ahli', '=', 'lantikan_ahli_mesyuarat.id_ahli')
            ->leftJoin('kekananan_gred', 'lantikan_ahli_mesyuarat.id_gred', '=', 'kekananan_gred.id_gred')
            ->where('ahli_event.mesyuarat_id', $id)
            ->where('butiran_ahli_mesyuarat.mesyuarat_ksukp', '=', '1')
            ->select('ahli_event.*', 'ahli_mesyuarat.nama_ahli', 'ref_jawatan.nama_jawatan', 'ref_kementerian.nama_kementerian', 'kekananan_gred.nama_gred', 'lantikan_ahli_mesyuarat.tarikh_lantikan')
            ->get(['butiran_ahli_mesyuarat.*', 'ahli_mesyuarat.nama_ahli']);

        // dd($edaran_dokumen);

        return view('mesyuarat.m_CetakanEdaranDokumen_ksukp')->with(compact('event', 'edaran_dokumen', 'event_start', 'event_time1', 'event_time2'));
    }


    public function cetakanEdaran_mbkm(Request $request, $id)
    {
        $event = Event::whereid($id)->firstOrFail();
        $event_start = Carbon::parse($event->start)->locale('ms_MY');
        $event_time1 = Carbon::parse($event->time1)->locale('ms_MY');
        $event_time2 = Carbon::parse($event->time2)->locale('ms_MY');

        $edaran_dokumen =  AhliEvent::join('butiran_ahli_mesyuarat', 'ahli_event.ahli_id', '=', 'butiran_ahli_mesyuarat.id_ahli')
            ->join('ahli_mesyuarat', 'butiran_ahli_mesyuarat.id_ahli', '=', 'ahli_mesyuarat.id_ahli')
            ->join('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
            ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
            ->leftJoin('lantikan_ahli_mesyuarat', 'butiran_ahli_mesyuarat.id_ahli', '=', 'lantikan_ahli_mesyuarat.id_ahli')
            ->leftJoin('kekananan_gred', 'lantikan_ahli_mesyuarat.id_gred', '=', 'kekananan_gred.id_gred')
            ->where('ahli_event.mesyuarat_id', $id)
            ->where('butiran_ahli_mesyuarat.mesyuarat_mbkm', '=', '1')
            ->select('ahli_event.*', 'ahli_mesyuarat.nama_ahli', 'ref_jawatan.nama_jawatan', 'ref_kementerian.nama_kementerian', 'kekananan_gred.nama_gred', 'lantikan_ahli_mesyuarat.tarikh_lantikan')
            ->get(['butiran_ahli_mesyuarat.*', 'ahli_mesyuarat.nama_ahli']);

        // dd($edaran_dokumen);

        return view('mesyuarat.m_CetakanEdaranDokumen_mbkm')->with(compact('event', 'edaran_dokumen', 'event_start', 'event_time1', 'event_time2'));
    }
}
