<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ref_tajuk_mesyuarat;
use App\Models\AhliMesyuarat;
use App\Models\ref_kementerian;

class MesyuaratController extends Controller
{
    // Auth need to login first
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $ref_tajuk_mesyuarat = ref_tajuk_mesyuarat::All();
        return view('penyelenggaraan.p_Mesyuarat')->with(compact('ref_tajuk_mesyuarat'));
    }

    public function create($id, Request $request)
    {
        $tajuk_mesyuarat = ref_tajuk_mesyuarat::where('id_tajuk', $id)->firstOrFail();
        $tajuk = $tajuk_mesyuarat->ringkasan;

        $ahli_mesyuarat = AhliMesyuarat::join('butiran_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'butiran_ahli_mesyuarat.id_ahli')
            ->join('lantikan_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'lantikan_ahli_mesyuarat.id_ahli')
            ->leftJoin('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
            ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
            ->leftJoin('kekananan_gred', 'lantikan_ahli_mesyuarat.id_gred', '=', 'kekananan_gred.id_gred')
            ->select(
                'ahli_mesyuarat.id_ahli',
                'ahli_mesyuarat.nama_ahli',
                'ref_jawatan.nama_jawatan',
                'ref_kementerian.nama_kementerian',
                'kekananan_gred.nama_gred',
                'lantikan_ahli_mesyuarat.tarikh_bersara',
                'lantikan_ahli_mesyuarat.kekananan_mesy_manual',
                'lantikan_ahli_mesyuarat.tarikh_lantikan'
            )
            ->where("mesyuarat_$tajuk", '=', '1')
            ->orderBy('lantikan_ahli_mesyuarat.kekananan_mesy_manual', 'ASC')
            ->orderBy('lantikan_ahli_mesyuarat.id_gred', 'ASC')
            ->orderBy('lantikan_ahli_mesyuarat.tarikh_lantikan', 'ASC')
            ->get();

        return view('penyelenggaraan.p_SenaraiAhli')->with(compact('tajuk_mesyuarat', 'ahli_mesyuarat'));
    }

    public function CetakMesyuaratAhli($id, Request $request)
    {
        $tajuk_mesyuarat = ref_tajuk_mesyuarat::where('id_tajuk', $id)->firstOrFail();
        $tajuk = $tajuk_mesyuarat->ringkasan;

        $ahli_mesyuarat = AhliMesyuarat::join('butiran_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'butiran_ahli_mesyuarat.id_ahli')
            ->join('lantikan_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'lantikan_ahli_mesyuarat.id_ahli')
            ->leftJoin('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
            ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
            ->leftJoin('kekananan_gred', 'lantikan_ahli_mesyuarat.id_gred', '=', 'kekananan_gred.id_gred')
            ->select(
                'ahli_mesyuarat.id_ahli',
                'ahli_mesyuarat.nama_ahli',
                'ref_jawatan.nama_jawatan',
                'ref_kementerian.nama_kementerian',
                'kekananan_gred.nama_gred',
                'lantikan_ahli_mesyuarat.tarikh_bersara',
                'lantikan_ahli_mesyuarat.kekananan_mesy_manual',
                'lantikan_ahli_mesyuarat.tarikh_lantikan'
            )
            ->where("mesyuarat_$tajuk", '=', '1')
            ->orderBy('lantikan_ahli_mesyuarat.kekananan_mesy_manual', 'ASC')
            ->orderBy('lantikan_ahli_mesyuarat.id_gred', 'ASC')
            ->orderBy('lantikan_ahli_mesyuarat.tarikh_lantikan', 'ASC')
            ->get();

        return view('penyelenggaraan.p_CetakanAhliMesyuarat')->with(compact('tajuk_mesyuarat', 'ahli_mesyuarat'));
    }

}
