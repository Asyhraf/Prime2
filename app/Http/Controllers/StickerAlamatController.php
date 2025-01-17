<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ref_tajuk_mesyuarat;
use App\Models\AhliMesyuarat;

class StickerAlamatController extends Controller
{
    // Auth need to login first
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $ref_tajuk_mesyuarat = ref_tajuk_mesyuarat::All()
        ->where('aktiviti', '=', '1');

        return view('penyelenggaraan.p_StickerAlamat')->with(compact('ref_tajuk_mesyuarat'));
    }

    public function cetakstickeralamat($id)
    {
        $ahli_mesyuarat = AhliMesyuarat::All();

        $tajuk_mesyuarat = ref_tajuk_mesyuarat::where('id_tajuk', $id)->firstOrFail();

        $tajuk = $tajuk_mesyuarat->ringkasan;

        $mesyuaratColumns = [
            "KSUKP" => "mesyuarat_ksukp",
            "JKPPN" => "mesyuarat_jkppn",
            "KJP" => "mesyuarat_kjp",
            "KEBBP" => "mesyuarat_kebbp",
            "MBKM" => "mesyuarat_mbkm",
        ];

        $ahli_mesyuarat = AhliMesyuarat::join('butiran_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'butiran_ahli_mesyuarat.id_ahli')
            ->join('lantikan_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'lantikan_ahli_mesyuarat.id_ahli')
            ->select(
                'ahli_mesyuarat.id_ahli',
                'ahli_mesyuarat.nama_ahli',
                'butiran_ahli_mesyuarat.alamat',
            )
            ->where('butiran_ahli_mesyuarat.' . $mesyuaratColumns[$tajuk], '=', '1')
            ->where('butiran_ahli_mesyuarat.id_status_ahli', '=', 'A')
            ->orderBy('lantikan_ahli_mesyuarat.kekananan_mesy_manual', 'ASC')
            ->get(['butiran_ahli_mesyuarat.*', 'ahli_mesyuarat.nama_ahli']);

        return view('penyelenggaraan.p_CetakanStickerAlamat')->with(compact('ahli_mesyuarat', 'tajuk_mesyuarat'));
    }
}
