<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

use App\Models\ref_kementerian;
use App\Models\Log_Aktiviti;

class KementerianController extends Controller
{
    // Auth need to login first
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $ref_kementerian=ref_kementerian::All();
        return view('penyelenggaraan.p_Kementerian')->with(compact('ref_kementerian'));
    }

    public function cetakankementerian(Request $request)
    {
        $ref_kementerian=ref_kementerian::All();

        return view('penyelenggaraan.p_CetakanKementerian')->with(compact('ref_kementerian'));
    }

    public function create()
    {
        $ref_kementerian     = ref_kementerian::all();
        return view('penyelenggaraan.p_TambahKementerian')->with(compact('ref_kementerian'));;
    }


    public function store(Request $request, ref_kementerian $kem)
    {
        if (ref_kementerian::where('nama_kementerian', '=', $request->get('nama_kementerian'))->exists()) {
            $nama_kementerian = $request->get('nama_kementerian');
            return back()
                ->with('message', "Kementerian: $nama_kementerian sudah direkodkan, sila masukkan rekod lain.");
        } else {        
            $kementerian = new ref_kementerian(array(
            'nama_kementerian'        => $request->get('nama_kementerian'),
            'singkatan_kementerian'   => $request->get('singkatan_kementerian'),
            'created_by'              => Auth::user()->name,            
            ));

            $kementerian-> save();

            $nama = Str::ucfirst($kementerian->nama_kementerian);

            Log_Aktiviti::create([
                'module_id'     => json_encode($kementerian->id_kementerian),
                'module_type'   => class_basename(get_class($kem)),
                'before'        => null,
                'after'         => json_encode($kementerian),
                'action'        => $request->route()->getActionMethod(),
                'action_byid'   => $request->user()->id,
                'action_name'   => $request->user()->name,
            ]);        

            return redirect('/p_Kementerian')->with('status', "Kementerian: $nama telah direkodkan");
        }
    }


    public function edit($id, Request $request)
    {
        $ref_kementerian     = ref_kementerian::whereid_kementerian($id)->firstOrFail();
        return view('penyelenggaraan.p_EditKementerian')->with(compact('ref_kementerian'));;
    }


    public function update(Request $request, $id, ref_kementerian $kem)
    {   
        $refkementerian = ref_kementerian::where('id_kementerian', '=', $id)->firstOrFail();
        $original       = $refkementerian->getOriginal();
        
        $refkementerian->nama_kementerian           = $request->get('nama_kementerian'); 
        $refkementerian->singkatan_kementerian      = $request->get('singkatan_kementerian'); 
        $refkementerian->action_by                  = Auth::user()->name;
        $refkementerian->update();

        // $kementerian = ref_kementerian::find($id);
        // $kementerian2 = ref_kementerian::all();

        $nama       =   $refkementerian->nama_kementerian;
        $changes    =   $refkementerian->getChanges();

        Log_Aktiviti::create([
            'module_id'     => json_encode($refkementerian->id_kementerian),
            'module_type'   => class_basename(get_class($kem)),
            'before'        => json_encode(array_intersect_key($original, $changes)),
            'after'         => json_encode($changes),
            'action'        => $request->route()->getActionMethod(),
            'action_byid'   => $request->user()->id,
            'action_name'   => $request->user()->name,

        ]);

        return redirect ('/p_Kementerian')
            ->with('status', "Maklumat $nama telah dikemaskini");

        // return view('penyelenggaraan.p_EditKementerian')->with(compact('kementerian2','kementerian', 'ref_kementerian'));   
    }

    public function delete($id, Request $request, ref_kementerian $kem)

    {
        $data   = ref_kementerian::find($id);
        $original = $data->getOriginal();
        $nama   = $data->nama_kementerian;

        $data->delete();

        $changes    =   $data->getChanges();

        Log_Aktiviti::create([
            'module_id'     => json_encode($data->id_kementerian),
            'module_type'   => class_basename(get_class($kem)),
            'before'        => json_encode($original),
            'after'         => null,
            'action'        => $request->route()->getActionMethod(),
            'action_byid'   => $request->user()->id,
            'action_name'   => $request->user()->name,

        ]);

        return redirect()->back()->with('status', "Rekod $nama telah berjaya dihapuskan.");
    }

}
