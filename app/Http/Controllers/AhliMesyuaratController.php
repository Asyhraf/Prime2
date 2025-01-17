<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// function use
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

// model use
use App\Models\AhliMesyuarat;
use App\Models\ButiranAhliMesyuarat;
use App\Models\LantikanAhliMesyuarat;
use App\Models\PegawaiKhas;
use App\Models\SetiausahaPejabat;
use App\Models\Pemandu_Bguard;
use App\Models\Event;
use App\Models\AhliEvent;
use App\Models\ref_jawatan;
use App\Models\kekananan_gred;
use App\Models\ref_kementerian;
use App\Models\ref_status_ahli;
use App\Models\ref_status_jawatan;
use App\Models\KodGelaran;
use App\Models\ref_tajuk_mesyuarat;
use App\Models\Log_Aktiviti;

class AhliMesyuaratController extends Controller
{
    // Auth need to login first
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $tableName = 'ahli_mesyuarat';

        // Join the tables and select required columns
        $ahliMesyuarat = \DB::table($tableName)
            ->leftJoin('butiran_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'butiran_ahli_mesyuarat.id_ahli')
            ->leftJoin('lantikan_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'lantikan_ahli_mesyuarat.id_ahli')
            ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
            ->leftJoin('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
            ->leftJoin('kekananan_gred', 'lantikan_ahli_mesyuarat.id_gred', '=', 'kekananan_gred.id_gred')
            ->select(
                'ahli_mesyuarat.id_ahli',
                'ahli_mesyuarat.nama_ahli',
                \DB::raw('COALESCE(ref_kementerian.nama_kementerian, "") as nama_kementerian'),
                'ref_jawatan.nama_jawatan',
                'kekananan_gred.nama_gred',
                'lantikan_ahli_mesyuarat.tarikh_lantikan'
            )
            ->orderByRaw('
                CASE
                    WHEN lantikan_ahli_mesyuarat.kekananan_mesy_manual BETWEEN 1 AND 1000 AND butiran_ahli_mesyuarat.status = 1 THEN 1
                    WHEN lantikan_ahli_mesyuarat.kekananan_mesy_manual IS NULL THEN 2
                    WHEN butiran_ahli_mesyuarat.status = 0 THEN 3
                    ELSE 4
                END
            ')
            ->orderBy('lantikan_ahli_mesyuarat.kekananan_mesy_manual', 'ASC')
            ->where('ahli_mesyuarat.deleted_at', null)
            ->get();

        return view('penyelenggaraan.p_AhliMesyuarat', compact('ahliMesyuarat'));
    }

    public function show(Request $request, $id)
    {
        // Retrieve data from the first table ahli_mesyuarat
        $ahli_mesyuarat = AhliMesyuarat::where('id_ahli', $id)->firstOrFail();

        $id_gelaran = $ahli_mesyuarat->id_gelaran;
        $gelaran = KodGelaran::find($id_gelaran);
        $kod_gelaran  = KodGelaran::All();

        // Retrieve data from the second table butiran_ahli_mesyuarat
        $butiran = ButiranAhliMesyuarat::where('id_ahli', $id)->firstOrFail();

        $id_jawatan = $butiran->id_jawatan;
        $id_kementerian = $butiran->id_kementerian;
        $id_status = $butiran->id_status_ahli;

        $jawatan = ref_jawatan::find($id_jawatan);
        $kementerian = ref_kementerian::find($id_kementerian);
        $status_ahli = ref_status_ahli::find($id_status);

        // Retrieve data from the third table lantikan_ahli_mesyuarat
        $lantikan = LantikanAhliMesyuarat::where('id_ahli', $id)->firstOrFail();

        $id_gred = $lantikan->id_gred;
        $gred_bersara = $lantikan->id_gred;

        $gred = kekananan_gred::find($id_gred);

        $GredBersara = kekananan_gred::find($gred_bersara);

        // Retrieve data from the fourth table pegkhas_ahli_mesyuarat
        $peg_khas = PegawaiKhas::where('id_ahli', $id)->get();

        // Retrieve data from the fifth table supej_ahli_mesyuarat
        $supej = SetiausahaPejabat::where('id_ahli', $id)->get();

        // Retrieve data from the six table pemandu_bguard
        $pemandu_bguard = Pemandu_Bguard::where('id_ahli', $id)->firstOrFail();

        // Pass the data to the view
        return view('penyelenggaraan.p_Show')
            ->with(compact('ahli_mesyuarat', 'gelaran', 'butiran', 'jawatan', 'kementerian', 'status_ahli', 'lantikan', 'gred', 'GredBersara', 'peg_khas', 'supej', 'pemandu_bguard'));
    }

    public function createAhliMesyuarat()
    {
        $ahli_mesyuarat  = AhliMesyuarat::All();
        $kod_gelaran  = KodGelaran::All();

        return view('penyelenggaraan.p_TambahAhliMesyuarat')->with(compact('ahli_mesyuarat', 'kod_gelaran'));
    }

    public function storeAhliMesyuarat(Request $request, AhliMesyuarat $AhliM)
    {
        $add = new AhliMesyuarat(array(
            'id_gelaran'        => $request->get('gelaran'),
            'nama_ahli'         => $request->get('nama_ahli'),
            'created_by'        => $request->user()->name,
        ));

        $add->save();

        // Get the id_ahli of the newly created AhliMesyuarat
        $id_ahli = $add->id_ahli;

        // Create and save the ButiranAhliMesyuarat object with the same id_ahli
        $butiranAdd = new ButiranAhliMesyuarat(array(
            'id_ahli'        => $id_ahli,
        ));
        $butiranAdd->save();

        // Create and save the LantikanAhliMesyuarat object with the same id_ahli
        $lantikanAdd = new LantikanAhliMesyuarat(array(
            'id_ahli'        => $id_ahli,
        ));
        $lantikanAdd->save();

        // Create and save the Pemandu_Bguard object with the same id_ahli
        $pbguardAdd = new Pemandu_Bguard(array(
            'id_ahli'        => $id_ahli,
        ));
        $pbguardAdd->save();

        Log_Aktiviti::create([
            'module_id'     => json_encode($add->id_ahli),
            'module_type'   => class_basename(get_class($AhliM)),
            'before'        => null,
            'after'         => json_encode($add),
            'action'        => $request->route()->getActionMethod(),
            'action_byid'   => $request->user()->id,
            'action_name'   => $request->user()->name,
        ]);

        return redirect()->route('kemaskini', $id_ahli);
    }

    public function edit($id, Request $request)
    {
        // Retrieve data from the first table ahli_mesyuarat
        $ahli_mesyuarat = AhliMesyuarat::where('id_ahli', $id)->firstOrFail();

        // dd($ahli_mesyuarat);
        $id_gelaran = $ahli_mesyuarat->id_gelaran;
        $gelaran = KodGelaran::find($id_gelaran);
        $kod_gelaran  = KodGelaran::All();
        $ref_jawatan =  ref_jawatan::all()->sortBy('nama_jawatan');
        $kekananan_gred = kekananan_gred::all();
        $ref_kementerian = ref_kementerian::all()->sortBy('nama_kementerian');
        $ref_status_ahli = ref_status_ahli::all();


        // Retrieve data from the second table butiran_ahli_mesyuarat
        $butiran = ButiranAhliMesyuarat::where('id_ahli', $id)->firstOrFail();

        $id_jawatan = $butiran->id_jawatan;
        $id_kementerian = $butiran->id_kementerian;
        $id_status = $butiran->id_status_ahli;

        $jawatan = ref_jawatan::find($id_jawatan);
        $kementerian = ref_kementerian::find($id_kementerian);
        $status_ahli = ref_status_ahli::find($id_status);

        // Retrieve data from the third table lantikan_ahli_mesyuarat
        $lantikan = LantikanAhliMesyuarat::where('id_ahli', $id)->firstOrFail();

        $id_gred = $lantikan->id_gred;
        $gred_bersara = $lantikan->gred_bersara;

        $gred = kekananan_gred::find($id_gred);

        $GredBersara = kekananan_gred::find($gred_bersara);

        // Retrieve data from the fourth table pegkhas_ahli_mesyuarat
        $peg_khas = PegawaiKhas::where('id_ahli', $id)->get();

        // Retrieve data from the fifth table supej_ahli_mesyuarat
        $supej = SetiausahaPejabat::where('id_ahli', $id)->get();

        // Retrieve data from the six table pemandu_bguard
        $pemandu_bguard = Pemandu_Bguard::where('id_ahli', $id)->firstOrFail();

        // Pass the data to the view
        return view('penyelenggaraan.p_Edit2')
            ->with(compact('ahli_mesyuarat', 'gelaran', 'kod_gelaran', 'butiran', 'jawatan', 'kementerian', 'kekananan_gred', 'ref_kementerian', 'ref_jawatan', 'ref_status_ahli', 'status_ahli', 'lantikan', 'gred', 'GredBersara', 'peg_khas', 'supej', 'pemandu_bguard'));
    }

    public function updateButiranAhli($id, Request $request, AhliMesyuarat $AhliM)
    {
        // Retrieve the existing records
        $ahli = AhliMesyuarat::where('id_ahli', $id)->firstOrFail();
        $butiran = ButiranAhliMesyuarat::where('id_ahli', $id)->firstOrFail();

        // Store original data for logging
        $originalAhli = $ahli->getOriginal();
        $originalButiran = $butiran->getOriginal();

        // Update Butiran Ahli Mesyuarat details
        $butiran->mesyuarat_ksukp = $request->get('mesyuarat_ksukp');
        $butiran->mesyuarat_mbkm  = $request->get('mesyuarat_mbkm');
        $butiran->id_jawatan     = $request->get('jawatan');
        $butiran->id_kementerian = $request->get('id_kementerian');
        $butiran->no_ic          = $request->get('no_ic');
        $butiran->isteri_suami   = $request->get('isteri_suami');
        $butiran->alamat         = $request->get('alamat');
        $butiran->emel           = $request->get('emel');
        $butiran->no_hp_peribadi = $request->get('no_hp_peribadi');
        $butiran->id_status_ahli = $request->get('id_status_ahli');
        $butiran->status         = $request->get('status');
        $butiran->action_by      = Auth::user()->name;
        $butiran->updated_at     = Carbon::now()->toDateTimeString();

        // Update Ahli Mesyuarat details
        $ahli->id_gelaran  = $request->get('gelaran');
        $ahli->nama_ahli   = $request->get('nama_ahli');
        $ahli->action_by   = Auth::user()->name;
        $ahli->updated_at  = Carbon::now()->toDateTimeString();

        // Save updates
        $ahli->update();
        $butiran->update();

        // Capture changes for logging
        $ahliChanges = $ahli->getChanges();
        $butiranChanges = $butiran->getChanges();

        // Log changes for AhliMesyuarat
        Log_Aktiviti::create([
            'module_id'     => json_encode($ahli->id_ahli),
            'module_type'   => class_basename(get_class($ahli)),
            'before'        => json_encode(array_intersect_key($originalAhli, $ahliChanges)),
            'after'         => json_encode($ahliChanges),
            'action'        => $request->route()->getActionMethod(),
            'action_byid'   => $request->user()->id,
            'action_name'   => $request->user()->name,
        ]);

        // Log changes for ButiranAhliMesyuarat
        Log_Aktiviti::create([
            'module_id'     => json_encode($butiran->id_ahli),
            'module_type'   => class_basename(get_class($butiran)),
            'before'        => json_encode(array_intersect_key($originalButiran, $butiranChanges)),
            'after'         => json_encode($butiranChanges),
            'action'        => $request->route()->getActionMethod(),
            'action_byid'   => $request->user()->id,
            'action_name'   => $request->user()->name,
        ]);

        // Return back with success message
        return back()
            ->with(compact('ahli', 'butiran'))
            ->with('status', 'Butiran ahli berjaya diubah suai');
    }

    public function updateLantikanPersaraan($id, Request $request, LantikanAhliMesyuarat $lantik)
    {
        $lantikan = LantikanAhliMesyuarat::where('id_ahli', $id)->firstOrFail();
        $original   = $lantikan->getOriginal();

        // Gred dan Tarikh Lantikan
        $lantikan->id_gred         = $request->get('id_gred');
        $lantikan->tarikh_lantikan = $request->get('tarikh_lantikan');
        $lantikan->kekananan_mesy_manual = $request->get('kekananan_mesy_manual');

        // Lantikan Kontrak
        $lantikan->tarikh_mula_kontrak1 = $request->get('tarikh_mula_kontrak1');

        // Persaraan Wajib
        $lantikan->gred_bersara                   = $request->get('id_gred_bersara');
        $lantikan->tarikh_bersara                 = $request->get('tarikh_bersara');
        $lantikan->tarikh_lantikan_semasa_bersara = $request->get('tarikh_lantikan_semasa_bersara');
        $lantikan->action_by       = Auth::user()->name;
        $lantikan->updated_at      = Carbon::now()->toDateTimeString();
        $lantikan->update();

        $lantikanAhli = LantikanAhliMesyuarat::all();

        $changes    =    $lantikan->getChanges();

        Log_Aktiviti::create([
            'module_id'     => json_encode($lantikan->id_ahli),
            'module_type'   => class_basename(get_class($lantikan)),
            'before'        => json_encode(array_intersect_key($original, $changes)),
            'after'         => json_encode($changes),
            'action'        =>  $request->route()->getActionMethod(),
            'action_byid'   =>  $request->user()->id,
            'action_name'   =>  $request->user()->name,

        ]);

        return back()
            ->with(compact('lantikan', 'lantikanAhli'))
            ->with('status', 'Lantikan & Persaraan berjaya diubah suai');
    }

    public function updatePemanduBguard($id, Request $request, Pemandu_Bguard $pbg)
    {
        $pbguard = Pemandu_Bguard::where('id_ahli', $id)->firstOrFail();
        $original   = $pbguard->getOriginal();

        $pbguard->pemandu_nama    = $request->get('pemandu_nama');
        $pbguard->pemandu_hp      = $request->get('pemandu_hp');
        $pbguard->pemandu_telpej  = $request->get('pemandu_telpej');
        $pbguard->bguard_nama     = $request->get('bguard_nama');
        $pbguard->bguard_hp       = $request->get('bguard_hp');
        $pbguard->bguard_telpej   = $request->get('bguard_telpej');
        $pbguard->no_plat         = $request->get('no_plat');

        $pbguard->action_by      = Auth::user()->name;
        $pbguard->updated_at      = Carbon::now()->toDateTimeString();

        $pbguard->update();

        $pbguardAhli = Pemandu_Bguard::all();

        $changes    =    $pbguard->getChanges();

        Log_Aktiviti::create([
            'module_id'     => json_encode($pbguard->id),
            'module_type'   => class_basename(get_class($pbg)),
            'before'        => json_encode(array_intersect_key($original, $changes)),
            'after'         => json_encode($changes),
            'action'        => $request->route()->getActionMethod(),
            'action_byid'   => $request->user()->id,
            'action_name'   => $request->user()->name,
        ]);

        return back()
            ->with(compact('pbguard', 'pbguardAhli'))
            ->with('status', 'Pemandu, Bodyguard & No Plat Kenderaan berjaya diubah suai');
    }

    public function storePegawaiKhas($id, Request $request, PegawaiKhas $pks)
    {
        $ahli_mesyuarat = AhliMesyuarat::where('id_ahli', $id)->firstOrFail();

        // Pegawai Khas
        $peg_khas = new PegawaiKhas(array(
            'id_ahli'          => $id,
            'pegkhas_nama'     => $request->get('pegkhas_nama'),
            'pegkhas_emel'     => $request->get('pegkhas_emel'),
            'pegkhas_hp'       => $request->get('pegkhas_hp'),
            'pegkhas_telpej'   => $request->get('pegkhas_telpej'),
            'pegkhas_faks'     => $request->get('pegkhas_faks'),
            'created_by'       => Auth::user()->name,
            'created_at'       => Carbon::now()->toDateTimeString(),
        ));
        $peg_khas->save();

        $ahli = AhliMesyuarat::all();
        $senarai_pegkhas = PegawaiKhas::where('id_ahli', $id)->get();

        Log_Aktiviti::create([
            'module_id'     => json_encode($peg_khas->id_pegkhas),
            'module_type'   => class_basename(get_class($pks)),
            'before'        => null,
            'after'         => json_encode($peg_khas),
            'action'        => $request->route()->getActionMethod(),
            'action_byid'   => $request->user()->id,
            'action_name'   => $request->user()->name,
        ]);

        return back()
            ->with(compact('ahli_mesyuarat', 'ahli', 'senarai_pegkhas'))
            ->with('status', 'Pegawai Khas berjaya ditambah');
    }

    public function storeSetiausahaPejabat($id, Request $request, SetiausahaPejabat $sup)
    {
        $ahli_mesyuarat = AhliMesyuarat::where('id_ahli', $id)->firstOrFail();

        // Setiausaha Pejabat
        $supej = new SetiausahaPejabat(array(
            'id_ahli'          => $id,
            'supej_nama'       => $request->get('supej_nama'),
            'supej_emel'       => $request->get('supej_emel'),
            'supej_hp'         => $request->get('supej_hp'),
            'supej_telpej'     => $request->get('supej_telpej'),
            'supej_faks'       => $request->get('supej_faks'),
            'created_by'       => Auth::user()->name,
            'created_at'       => Carbon::now()->toDateTimeString(),
        ));

        $supej->save();

        $ahli = AhliMesyuarat::all();

        $senarai_supej = SetiausahaPejabat::where('id_ahli', $id)->get();

        Log_Aktiviti::create([
            'module_id'     => json_encode($supej->id_supej),
            'module_type'   => class_basename(get_class($sup)),
            'before'        => null,
            'after'         => json_encode($supej),
            'action'        => $request->route()->getActionMethod(),
            'action_byid'   => $request->user()->id,
            'action_name'   => $request->user()->name,
        ]);

        return back()
            ->with(compact('ahli_mesyuarat', 'ahli', 'senarai_supej'))
            ->with('status', 'Setiausaha Pejabat berjaya ditambah');
    }

    public function softDelete($id, Request $request, AhliMesyuarat $AhliM)
    {
        $data   = AhliMesyuarat::find($id);
        $nama = $data->nama_ahli;
        $userN = $request->user()->name;
        $original = $data->getOriginal();

        DB::transaction(function () use ($id, $userN) {
            // Update `deleted_by` column before deleting
            ButiranAhliMesyuarat::where('id_ahli', $id)->update(['action_by' => $userN]);
            LantikanAhliMesyuarat::where('id_ahli', $id)->update(['action_by' => $userN]);
            PegawaiKhas::where('id_ahli', $id)->update(['action_by' => $userN]);
            SetiausahaPejabat::where('id_ahli', $id)->update(['action_by' => $userN]);
            Pemandu_Bguard::where('id_ahli', $id)->update(['action_by' => $userN]);

            // Proceed with the deletion
            AhliMesyuarat::where('id_ahli', $id)->delete();
            ButiranAhliMesyuarat::where('id_ahli', $id)->delete();
            LantikanAhliMesyuarat::where('id_ahli', $id)->delete();
            PegawaiKhas::where('id_ahli', $id)->delete();
            SetiausahaPejabat::where('id_ahli', $id)->delete();
            Pemandu_Bguard::where('id_ahli', $id)->delete();
        });

        $changes = $data->getChanges();

        Log_Aktiviti::create([
            'module_id' => json_encode($data->id_ahli),
            'module_type' => class_basename(get_class($data)),
            'before' => json_encode(array_intersect_key($original, $changes)),
            'after' => json_encode($changes),
            'action' => $request->route()->getActionMethod(),
            'action_byid' => $request->user()->id,
            'action_name' => $userN,
        ]);

        return redirect()->back()->with('status', "Rekod $nama telah berjaya dihapuskan.");
    }

    public function destroyPegkhas($id_pegkhas, Request $request)
    {
        $peg_khas = PegawaiKhas::find($id_pegkhas);
        $original = $peg_khas->getOriginal();
        $peg_khas->delete();

        $changes    =    $peg_khas->getChanges();

        Log_Aktiviti::create([
            'module_id'     => json_encode($peg_khas->id_pegkhas),
            'module_type'   => class_basename(get_class($peg_khas)),
            'before'        => json_encode(array_intersect_key($original, $changes)),
            'after'         => json_encode($changes),
            'action'        =>  $request->route()->getActionMethod(),
            'action_byid'   =>  $request->user()->id,
            'action_name'   =>  $request->user()->name,

        ]);

        return back()->with('status', 'Pegawai Khas berjaya dihapuskan.');
    }

    public function destroySupej($id_supej, Request $request)
    {
        $supej = SetiausahaPejabat::find($id_supej);
        $original = $supej->getOriginal();
        $supej->delete();

        $changes    =    $supej->getChanges();

        Log_Aktiviti::create([
            'module_id'     => json_encode($supej->id_supej),
            'module_type'   => class_basename(get_class($supej)),
            'before'        => json_encode(array_intersect_key($original, $changes)),
            'after'         => json_encode($changes),
            'action'        =>  $request->route()->getActionMethod(),
            'action_byid'   =>  $request->user()->id,
            'action_name'   =>  $request->user()->name,

        ]);

        return back()->with('status', 'Setiausaha Pejabat berjaya dihapuskan.');
    }

    public function cetak(Request $request)
    {
        $tableName = 'ahli_mesyuarat';

        // Join the tables and select required columns
        $ahliMesyuarat = \DB::table($tableName)
            ->leftJoin('butiran_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'butiran_ahli_mesyuarat.id_ahli')
            ->leftJoin('lantikan_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'lantikan_ahli_mesyuarat.id_ahli')
            ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
            ->leftJoin('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
            ->leftJoin('kekananan_gred', 'lantikan_ahli_mesyuarat.id_gred', '=', 'kekananan_gred.id_gred')
            ->select(
                'ahli_mesyuarat.nama_ahli',
                'ahli_mesyuarat.id_ahli',
                \DB::raw('COALESCE(ref_kementerian.nama_kementerian, "") as nama_kementerian'),
                'ref_jawatan.nama_jawatan',
                'kekananan_gred.nama_gred',
                'lantikan_ahli_mesyuarat.tarikh_lantikan'
            )
            ->orderByRaw('FIELD(lantikan_ahli_mesyuarat.kekananan_mesy_manual, 4, 3, 2, 1) DESC')
            ->orderBy('lantikan_ahli_mesyuarat.id_gred', 'ASC')
            ->orderBy('lantikan_ahli_mesyuarat.tarikh_lantikan', 'ASC')
            ->get();

        return view('penyelenggaraan.p_CetakSenaraiAhli')->with(compact('ahliMesyuarat'));
    }

    public function cetakMaklumatAhli(Request $request, $id)
    {
        // Retrieve data from the first table ahli_mesyuarat
        $ahli_mesyuarat = AhliMesyuarat::where('id_ahli', $id)->firstOrFail();

        // Retrieve data from the second table butiran_ahli_mesyuarat
        $butiran = ButiranAhliMesyuarat::where('id_ahli', $id)->firstOrFail();

        $id_jawatan = $butiran->id_jawatan;
        $id_kementerian = $butiran->id_kementerian;
        $id_status = $butiran->id_status_ahli;

        $jawatan = ref_jawatan::where('id_jawatan', $id_jawatan)
            ->firstOrFail();

        $kementerian = ref_kementerian::find($id_kementerian);

        $status_ahli = ref_status_ahli::where('id_status_ahli', $id_status)
            ->firstOrFail();

        // Retrieve data from the third table lantikan_ahli_mesyuarat
        $lantikan = LantikanAhliMesyuarat::where('id_ahli', $id)->firstOrFail();

        $id_gred = $lantikan->id_gred;
        $gred_bersara = $lantikan->id_gred;

        $gred = kekananan_gred::find($id_gred);

        $GredBersara = kekananan_gred::find($gred_bersara);

        // Retrieve data from the fourth table pegkhas_ahli_mesyuarat
        $peg_khas = PegawaiKhas::where('id_ahli', $id)->get();

        // Retrieve data from the fifth table supej_ahli_mesyuarat
        $supej = SetiausahaPejabat::where('id_ahli', $id)->get();

        // Retrieve data from the six table pemandu_bguard
        $pemandu_bguard = Pemandu_Bguard::where('id_ahli', $id)->firstOrFail();

        // Pass the data to the view
        return view('penyelenggaraan.p_CetakMaklumatAhli')
            ->with(compact('ahli_mesyuarat', 'butiran', 'jawatan', 'kementerian', 'status_ahli', 'lantikan', 'gred', 'GredBersara', 'peg_khas', 'supej', 'pemandu_bguard'));
    }

    public function semak(Request $request)
    {
        $title = $request->get('title');
        $tableName = 'ahli_mesyuarat';
        $ahliMesyuarat = collect(); // Initialize as an empty collection
        $eventTitle = null;

        if ($title == "KSUKP") {
            $ahliMesyuarat = \DB::table($tableName)
                ->leftJoin('butiran_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'butiran_ahli_mesyuarat.id_ahli')
                ->leftJoin('lantikan_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'lantikan_ahli_mesyuarat.id_ahli')
                ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
                ->leftJoin('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
                ->leftJoin('kekananan_gred', 'lantikan_ahli_mesyuarat.id_gred', '=', 'kekananan_gred.id_gred')
                ->where('butiran_ahli_mesyuarat.mesyuarat_ksukp', '=', '1')
                ->where('butiran_ahli_mesyuarat.status', 1)  // Filter for active members
                ->select(
                    'ahli_mesyuarat.id_ahli',
                    'ahli_mesyuarat.nama_ahli',
                    \DB::raw('COALESCE(ref_kementerian.nama_kementerian, "") as nama_kementerian'),
                    'ref_jawatan.nama_jawatan',
                    'ref_kementerian.singkatan_kementerian',
                    'butiran_ahli_mesyuarat.alamat',
                    'butiran_ahli_mesyuarat.emel',
                    'butiran_ahli_mesyuarat.no_hp_peribadi',
                    'kekananan_gred.nama_gred',
                    'lantikan_ahli_mesyuarat.kekananan_mesy_manual',
                    'lantikan_ahli_mesyuarat.tarikh_lantikan'
                )
                ->orderByRaw('
                    CASE
                        WHEN lantikan_ahli_mesyuarat.kekananan_mesy_manual BETWEEN 1 AND 100 AND butiran_ahli_mesyuarat.status = 1 THEN 1
                        WHEN lantikan_ahli_mesyuarat.kekananan_mesy_manual IS NULL THEN 2
                        WHEN butiran_ahli_mesyuarat.status = 0 THEN 3
                        ELSE 4
                    END
                ')
                ->orderBy('lantikan_ahli_mesyuarat.kekananan_mesy_manual', 'ASC')
                ->get();

            $eventTitle = (object)[
                'TajukMesyuarat' => (object)['nama_tajuk' => 'Mesyuarat Ketua Setiausaha Kementerian dan Ketua Perkhidmatan'],
                'title' => 'KSUKP'
            ];
        } elseif ($title == "MBKM") {
            $ahliMesyuarat = \DB::table($tableName)
                ->leftJoin('butiran_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'butiran_ahli_mesyuarat.id_ahli')
                ->leftJoin('lantikan_ahli_mesyuarat', 'ahli_mesyuarat.id_ahli', '=', 'lantikan_ahli_mesyuarat.id_ahli')
                ->leftJoin('ref_kementerian', 'butiran_ahli_mesyuarat.id_kementerian', '=', 'ref_kementerian.id_kementerian')
                ->leftJoin('ref_jawatan', 'butiran_ahli_mesyuarat.id_jawatan', '=', 'ref_jawatan.id_jawatan')
                ->leftJoin('kekananan_gred', 'lantikan_ahli_mesyuarat.id_gred', '=', 'kekananan_gred.id_gred')
                ->where('butiran_ahli_mesyuarat.mesyuarat_mbkm', '=', '1')
                ->where('butiran_ahli_mesyuarat.status', 1)  // Filter for active members
                ->select(
                    'ahli_mesyuarat.id_ahli',
                    'ahli_mesyuarat.nama_ahli',
                    \DB::raw('COALESCE(ref_kementerian.nama_kementerian, "") as nama_kementerian'),
                    'ref_jawatan.nama_jawatan',
                    'ref_kementerian.singkatan_kementerian',
                    'butiran_ahli_mesyuarat.alamat',
                    'butiran_ahli_mesyuarat.emel',
                    'butiran_ahli_mesyuarat.no_hp_peribadi',
                    'kekananan_gred.nama_gred',
                    'lantikan_ahli_mesyuarat.kekananan_mesy_manual',
                    'lantikan_ahli_mesyuarat.tarikh_lantikan'
                )
                ->orderByRaw('
                                CASE
                                    WHEN lantikan_ahli_mesyuarat.kekananan_mesy_manual BETWEEN 1 AND 100 AND butiran_ahli_mesyuarat.status = 1 THEN 1
                                    WHEN lantikan_ahli_mesyuarat.kekananan_mesy_manual IS NULL THEN 2
                                    WHEN butiran_ahli_mesyuarat.status = 0 THEN 3
                                    ELSE 4
                                END
                            ')
                ->orderBy('lantikan_ahli_mesyuarat.kekananan_mesy_manual', 'ASC')
                ->get();

            $eventTitle = (object)[
                'TajukMesyuarat' => (object)['nama_tajuk' => 'Mesyuarat Menteri Besar dan Ketua Menteri'],
                'title' => 'MBKM'
            ];
        }

        return view('penyelenggaraan.p_SemakSenaraiAhli', compact('eventTitle', 'ahliMesyuarat'));
    }

    public function updateKekananan(Request $request)
    {
        $ahliData = $request->input('ahli');

        foreach ($ahliData as $id_ahli => $data) {
            \DB::table('lantikan_ahli_mesyuarat')
                ->where('id_ahli', $id_ahli)
                ->update(['kekananan_mesy_manual' => $data['kekananan_mesy_manual']]);
        }

        return redirect()->back()->with('status', 'Kekananan mesyuarat updated successfully!');
    }
}
