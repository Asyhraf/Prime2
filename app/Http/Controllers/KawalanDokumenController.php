<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;
use App\Models\ref_tajuk_mesyuarat;
use App\Models\AhliMesyuarat;
use App\Models\AhliEvent;
use App\Models\Event;
use App\Models\ref_kementerian;
use App\Models\ref_jawatan;
use Carbon\Carbon;



class KawalanDokumenController extends Controller
{
    // Auth need to login first
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        return view('penyelenggaraan.p_KawalanDokumen');
    }

    public function cetakkawalandokumen(Request $request)
    {
        $date = Carbon::now();
        $jenis_mesyuarat = $request->get('title');
        $bil = $request->get('bil');
        $tarikhSurat = $request->get('tarikhSurat');
        $bilRujukan = $request->get('bilRujukan');
        $perkara = $request->get('perkara');        

        // dd($jenis_mesyuarat, $bil, $tarikhSurat, $bilRujukan);

        $tajuk = [
            'KSUKP' => 'mesyuarat_ksukp',            
            'MBKM' => 'mesyuarat_mbkm',
        ];    
        
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
                'lantikan_ahli_mesyuarat.kekananan_mesy_manual'                
            )
            ->where($tajuk[$jenis_mesyuarat], '=', '1')
            ->where('id_status_ahli', '=', 'A')            
            ->orderBy('lantikan_ahli_mesyuarat.kekananan_mesy_manual', 'ASC')                 
            ->get();    
                    
        return view('penyelenggaraan.p_CetakanKawalanDokumen')->with(compact('ahli_mesyuarat', 'jenis_mesyuarat', 'bil', 'tarikhSurat', 'bilRujukan', 'perkara', 'date'));
    }


    public function indexQRCode()
    {
        return view('penyelenggaraan.p_QRCode');
    }
}
