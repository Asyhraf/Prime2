<?php

namespace App\Http\Controllers;

// function use
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// model use
use App\Models\AhliMesyuarat;
use App\Models\ButiranAhliMesyuarat;
use App\Models\LantikanAhliMesyuarat;
use App\Models\PegawaiKhas;
use App\Models\SetiausahaPejabat;
use App\Models\Pemandu_Bguard;
use App\Models\ref_jawatan;
use App\Models\kekananan_gred;
use App\Models\ref_kementerian;
use App\Models\ref_status_ahli;
use App\Models\ref_status_jawatan;
use App\Models\ref_tajuk_mesyuarat;

class CetakanPilihanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }


    public function index(Request $request)
    {
        $ref_tajuk_mesyuarat = ref_tajuk_mesyuarat::all();
        return view('penyelenggaraan.p_CetakanPilihan')->with(compact('ref_tajuk_mesyuarat'));
    }


    public function cetakanlaporan(Request $request)
    {
        //jenis cetakan
        $tajuk = $request->get('tajuk');       

        //kategori maklumat
        $opt_alamat                               = $request->get('opt_alamat');
        $opt_noTel_emel                           = $request->get('opt_noTel_emel');
        $opt_pegkhas                              = $request->get('opt_pegKhas');
        $opt_suPejnoTel_emel                      = $request->get('opt_suPejnoTel_emel');
        $opt_pemandu_noPlat                       = $request->get('opt_pemandu_noPlat');
        $opt_gred_lantikan_bersara                = $request->get('opt_gred_lantikan_bersara');
        
        //nama jenis cetakan dan query db
        if ($tajuk == "1") {
            $tajuk_dokumen = "MESYUARAT KETUA SETIAUSAHA KEMENTERIAN DAN KETUA PERKHIDMATAN";
            $ahli_mesyuarat = AhliMesyuarat::leftJoin('butiran_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'butiran_ahli_mesyuarat.id_ahli')
            ->leftJoin('lantikan_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'lantikan_ahli_mesyuarat.id_ahli')
            ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
            ->leftJoin('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
            ->leftJoin('kekananan_gred', 'lantikan_ahli_mesyuarat.id_gred', '=', 'kekananan_gred.id_gred')
            ->leftJoin('pegkhas_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'pegkhas_ahli_mesyuarat.id_ahli')
            ->leftJoin('supej_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'supej_ahli_mesyuarat.id_ahli')
            ->leftJoin('pemandu_bguard', 'ahli_mesyuarat.id_ahli', '=', 'pemandu_bguard.id_ahli')
            ->select(
                'ahli_mesyuarat.id_ahli',
                'ahli_mesyuarat.nama_ahli',
                'ref_kementerian.nama_kementerian',
                'ref_jawatan.nama_jawatan',                
                'butiran_ahli_mesyuarat.alamat',
                'butiran_ahli_mesyuarat.emel',
                'butiran_ahli_mesyuarat.no_hp_peribadi',
                'kekananan_gred.nama_gred',
                'lantikan_ahli_mesyuarat.kekananan_mesy_manual',
                'lantikan_ahli_mesyuarat.tarikh_lantikan',
                'lantikan_ahli_mesyuarat.tarikh_bersara',
                'pegkhas_ahli_mesyuarat.pegkhas_nama',
                'supej_ahli_mesyuarat.supej_nama',
                'supej_ahli_mesyuarat.supej_hp',
                'supej_ahli_mesyuarat.supej_emel',
                'pemandu_bguard.pemandu_nama',
                'pemandu_bguard.no_plat'
            )
            ->where('butiran_ahli_mesyuarat.mesyuarat_ksukp', '=', '1')
            ->where('butiran_ahli_mesyuarat.id_status_ahli', '=', 'A')
            ->orderBy('lantikan_ahli_mesyuarat.kekananan_mesy_manual', 'ASC')
            ->orderBy('lantikan_ahli_mesyuarat.id_gred', 'ASC')
            ->orderBy('lantikan_ahli_mesyuarat.tarikh_lantikan', 'ASC')
            ->get();
        } elseif ($tajuk == "2") {
            $tajuk_dokumen = "MESYUARAT JAWATANKUASA PERHUBUNGAN ANTARA KERAJAAN PERSEKUTUAN DAN KERAJAAN NEGERI";
            $ahli_mesyuarat = AhliMesyuarat::leftJoin('butiran_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'butiran_ahli_mesyuarat.id_ahli')
            ->leftJoin('lantikan_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'lantikan_ahli_mesyuarat.id_ahli')
            ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
            ->leftJoin('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
            ->leftJoin('kekananan_gred', 'lantikan_ahli_mesyuarat.id_gred', '=', 'kekananan_gred.id_gred')
            ->leftJoin('pegkhas_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'pegkhas_ahli_mesyuarat.id_ahli')
            ->leftJoin('supej_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'supej_ahli_mesyuarat.id_ahli')
            ->leftJoin('pemandu_bguard', 'ahli_mesyuarat.id_ahli', '=', 'pemandu_bguard.id_ahli')
            ->select(
                'ahli_mesyuarat.id_ahli',
                'ahli_mesyuarat.nama_ahli',
                'ref_kementerian.nama_kementerian',
                'ref_jawatan.nama_jawatan',                
                'butiran_ahli_mesyuarat.alamat',
                'butiran_ahli_mesyuarat.emel',
                'butiran_ahli_mesyuarat.no_hp_peribadi',
                'kekananan_gred.nama_gred',
                'lantikan_ahli_mesyuarat.kekananan_mesy_manual',
                'lantikan_ahli_mesyuarat.tarikh_lantikan',
                'lantikan_ahli_mesyuarat.tarikh_bersara',
                'pegkhas_ahli_mesyuarat.pegkhas_nama',
                'supej_ahli_mesyuarat.supej_nama',
                'supej_ahli_mesyuarat.supej_hp',
                'supej_ahli_mesyuarat.supej_emel',
                'pemandu_bguard.pemandu_nama',
                'pemandu_bguard.no_plat'
            )
            ->where('butiran_ahli_mesyuarat.mesyuarat_jkppn', '=', '1')
            ->where('butiran_ahli_mesyuarat.id_status_ahli', '=', 'A')
            ->orderBy('lantikan_ahli_mesyuarat.kekananan_mesy_manual', 'ASC')
            ->orderBy('lantikan_ahli_mesyuarat.id_gred', 'ASC')
            ->orderBy('lantikan_ahli_mesyuarat.tarikh_lantikan', 'ASC')
            ->get();
        } elseif ($tajuk == "3") {
            $tajuk_dokumen = "MESYUARAT KETUA JABATAN PERSEKUTUAN";
            $ahli_mesyuarat = AhliMesyuarat::leftJoin('butiran_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'butiran_ahli_mesyuarat.id_ahli')
            ->leftJoin('lantikan_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'lantikan_ahli_mesyuarat.id_ahli')
            ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
            ->leftJoin('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
            ->leftJoin('kekananan_gred', 'lantikan_ahli_mesyuarat.id_gred', '=', 'kekananan_gred.id_gred')
            ->leftJoin('pegkhas_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'pegkhas_ahli_mesyuarat.id_ahli')
            ->leftJoin('supej_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'supej_ahli_mesyuarat.id_ahli')
            ->leftJoin('pemandu_bguard', 'ahli_mesyuarat.id_ahli', '=', 'pemandu_bguard.id_ahli')
            ->select(
                'ahli_mesyuarat.id_ahli',
                'ahli_mesyuarat.nama_ahli',
                'ref_kementerian.nama_kementerian',
                'ref_jawatan.nama_jawatan',                
                'butiran_ahli_mesyuarat.alamat',
                'butiran_ahli_mesyuarat.emel',
                'butiran_ahli_mesyuarat.no_hp_peribadi',
                'kekananan_gred.nama_gred',
                'lantikan_ahli_mesyuarat.kekananan_mesy_manual',
                'lantikan_ahli_mesyuarat.tarikh_lantikan',
                'lantikan_ahli_mesyuarat.tarikh_bersara',
                'pegkhas_ahli_mesyuarat.pegkhas_nama',
                'supej_ahli_mesyuarat.supej_nama',
                'supej_ahli_mesyuarat.supej_hp',
                'supej_ahli_mesyuarat.supej_emel',
                'pemandu_bguard.pemandu_nama',
                'pemandu_bguard.no_plat'
            )
            ->where('butiran_ahli_mesyuarat.mesyuarat_kjp', '=', '1')
            ->where('butiran_ahli_mesyuarat.id_status_ahli', '=', 'A')
            ->orderBy('lantikan_ahli_mesyuarat.kekananan_mesy_manual', 'ASC')
            ->orderBy('lantikan_ahli_mesyuarat.id_gred', 'ASC')
            ->orderBy('lantikan_ahli_mesyuarat.tarikh_lantikan', 'ASC')
            ->get();
        } elseif ($tajuk == "4") {
            $tajuk_dokumen = "MESYUARAT KETUA EKSEKUTIF BADAN BERKANUN PERSEKUTUAN";
            $ahli_mesyuarat = AhliMesyuarat::leftJoin('butiran_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'butiran_ahli_mesyuarat.id_ahli')
            ->leftJoin('lantikan_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'lantikan_ahli_mesyuarat.id_ahli')
            ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
            ->leftJoin('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
            ->leftJoin('kekananan_gred', 'lantikan_ahli_mesyuarat.id_gred', '=', 'kekananan_gred.id_gred')
            ->leftJoin('pegkhas_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'pegkhas_ahli_mesyuarat.id_ahli')
            ->leftJoin('supej_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'supej_ahli_mesyuarat.id_ahli')
            ->leftJoin('pemandu_bguard', 'ahli_mesyuarat.id_ahli', '=', 'pemandu_bguard.id_ahli')
            ->select(
                'ahli_mesyuarat.id_ahli',
                'ahli_mesyuarat.nama_ahli',
                'ref_kementerian.nama_kementerian',
                'ref_jawatan.nama_jawatan',                
                'butiran_ahli_mesyuarat.alamat',
                'butiran_ahli_mesyuarat.emel',
                'butiran_ahli_mesyuarat.no_hp_peribadi',
                'kekananan_gred.nama_gred',
                'lantikan_ahli_mesyuarat.kekananan_mesy_manual',
                'lantikan_ahli_mesyuarat.tarikh_lantikan',
                'lantikan_ahli_mesyuarat.tarikh_bersara',
                'pegkhas_ahli_mesyuarat.pegkhas_nama',
                'supej_ahli_mesyuarat.supej_nama',
                'supej_ahli_mesyuarat.supej_hp',
                'supej_ahli_mesyuarat.supej_emel',
                'pemandu_bguard.pemandu_nama',
                'pemandu_bguard.no_plat'
            )
            ->where('butiran_ahli_mesyuarat.mesyuarat_kebbp', '=', '1')
            ->where('butiran_ahli_mesyuarat.id_status_ahli', '=', 'A')
            ->orderBy('lantikan_ahli_mesyuarat.kekananan_mesy_manual', 'ASC')
            ->orderBy('lantikan_ahli_mesyuarat.id_gred', 'ASC')
            ->orderBy('lantikan_ahli_mesyuarat.tarikh_lantikan', 'ASC')
            ->get();  
        } elseif ($tajuk == "5") {
            $tableName = 'ahli_mesyuarat';
            $tajuk_dokumen = "MESYUARAT MENTERI BESAR DAN KETUA MENTERI";
            $ahli_mesyuarat = AhliMesyuarat::leftJoin('butiran_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'butiran_ahli_mesyuarat.id_ahli')
            ->leftJoin('lantikan_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'lantikan_ahli_mesyuarat.id_ahli')
            ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
            ->leftJoin('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
            ->leftJoin('kekananan_gred', 'lantikan_ahli_mesyuarat.id_gred', '=', 'kekananan_gred.id_gred')
            ->leftJoin('pegkhas_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'pegkhas_ahli_mesyuarat.id_ahli')
            ->leftJoin('supej_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'supej_ahli_mesyuarat.id_ahli')
            ->leftJoin('pemandu_bguard', 'ahli_mesyuarat.id_ahli', '=', 'pemandu_bguard.id_ahli')
            ->select(
                'ahli_mesyuarat.id_ahli',
                'ahli_mesyuarat.nama_ahli',
                'ref_kementerian.nama_kementerian',
                'ref_jawatan.nama_jawatan',                
                'butiran_ahli_mesyuarat.alamat',
                'butiran_ahli_mesyuarat.emel',
                'butiran_ahli_mesyuarat.no_hp_peribadi',
                'kekananan_gred.nama_gred',
                'lantikan_ahli_mesyuarat.kekananan_mesy_manual',
                'lantikan_ahli_mesyuarat.tarikh_lantikan',
                'lantikan_ahli_mesyuarat.tarikh_bersara',
                'pegkhas_ahli_mesyuarat.pegkhas_nama',
                'supej_ahli_mesyuarat.supej_nama',
                'supej_ahli_mesyuarat.supej_hp',
                'supej_ahli_mesyuarat.supej_emel',
                'pemandu_bguard.pemandu_nama',
                'pemandu_bguard.no_plat'
            )
            ->where('butiran_ahli_mesyuarat.mesyuarat_mbkm', '=', '1')
            ->where('butiran_ahli_mesyuarat.id_status_ahli', '=', 'A')
            ->orderBy('lantikan_ahli_mesyuarat.kekananan_mesy_manual', 'ASC')
            ->orderBy('lantikan_ahli_mesyuarat.id_gred', 'ASC')
            ->orderBy('lantikan_ahli_mesyuarat.tarikh_lantikan', 'ASC')
            ->get();             
        }

        return view('penyelenggaraan.p_LaporanPilihan')->with(compact('ahli_mesyuarat', 'opt_alamat', 'opt_noTel_emel', 'opt_pegkhas', 'opt_suPejnoTel_emel', 'opt_pemandu_noPlat', 'opt_gred_lantikan_bersara', 'tajuk_dokumen'));
    }
}
