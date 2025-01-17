<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
// use Request;
use Illuminate\Support\Facades\Input;
use App\Models\AhliEvent;
use App\Models\Event;
use App\Models\ref_tajuk_mesyuarat;
use App\Models\ref_jawatan;
use App\Models\ref_kementerian;
use App\Models\AhliMesyuarat;
use Illuminate\Support\Carbon;

class LaporanKeahlianController extends Controller
{
    // Auth need to login first
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function indexKeahlian()
    {
        $ref_tajuk_mesyuarat = ref_tajuk_mesyuarat::orderBy('id_tajuk', 'ASC')
            ->whereNotIn('id_tajuk', [6, 7, 8, 9])
            ->pluck("nama_tajuk", "id_tajuk");

        $tahun = Event::orderBy('id', 'ASC')
            ->pluck('year', 'id');
        // dd($tahun);

        return view('laporan.lap_Keahlian')->with(compact('tahun', 'ref_tajuk_mesyuarat'));
    }

    public function getAhli($id_tajuk)
    {
        if ($id_tajuk == "1") {
            $ahli_mesyuarat = AhliMesyuarat::where('mesyuarat_ksukp', '=', '1')
                ->where('id_status_ahli', '=', 'A')
                ->pluck('nama_ahli', 'id_ahli');
        } elseif ($id_tajuk == "2") {
            $ahli_mesyuarat = AhliMesyuarat::where("mesyuarat_jkppn", '=', '1')
                ->where('id_status_ahli', '=', 'A')
                ->pluck('nama_ahli', 'id_ahli');
        } elseif ($id_tajuk == "3") {
            $ahli_mesyuarat = AhliMesyuarat::where("mesyuarat_kjp", '=', '1')
                ->where('id_status_ahli', '=', 'A')
                ->pluck("nama_ahli", "id_ahli");
        } elseif ($id_tajuk == "4") {
            $ahli_mesyuarat = AhliMesyuarat::where("mesyuarat_kebbp", '=', '1')
                ->where('id_status_ahli', '=', 'A')
                ->pluck("nama_ahli", "id_ahli");
        } elseif ($id_tajuk == "5") {
            $ahli_mesyuarat = AhliMesyuarat::where("mesyuarat_mbkm", '=', '1')
                ->where('id_status_ahli', '=', 'A')
                ->pluck("nama_ahli", "id_ahli");
        } else {
            return response()->json(['message' => 'Invalid id_tajuk']);
        }
        return response()->json($ahli_mesyuarat);
    }

    public function getJawatan($id_ahli)
    {
        $jawatan = AhliMesyuarat::where('id_ahli', $id_ahli)
            ->join('ref_jawatan', 'ahli_mesyuarat.jawatan', '=', 'ref_jawatan.id_jawatan')
            ->pluck("ref_jawatan.nama_jawatan", "ref_jawatan.id_jawatan");

        return response()->json($jawatan);
    }

    public function getKementerian($id_ahli)
    {
        $kementerian = AhliMesyuarat::where('id_ahli', $id_ahli)
            ->join('ref_kementerian', 'ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
            ->pluck('ref_kementerian.nama_kementerian', 'ref_kementerian.id_kementerian');

        return response()->json($kementerian);
    }
}
