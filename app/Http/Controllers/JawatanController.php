<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

use App\Models\ref_jawatan;
use App\Models\Log_Aktiviti;

class JawatanController extends Controller
{
    // Auth need to login first
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $ref_jawatan=ref_jawatan::All();
        return view('penyelenggaraan.p_Jawatan')->with(compact('ref_jawatan'));
    }

    public function cetakanjawatan(Request $request)
    {
        $ref_jawatan=ref_jawatan::All();

        return view('penyelenggaraan.p_CetakanJawatan')->with(compact('ref_jawatan'));
    }

    public function create()
    {
        $ref_jawatan     = ref_jawatan::all();
        return view('penyelenggaraan.p_TambahJawatan')->with(compact('ref_jawatan'));;
    }


    public function store(Request $request, ref_jawatan $jwtn)
    {
        if (ref_jawatan::where('nama_jawatan', '=', $request->get('nama_jawatan'))->exists()) {
            $nama_jawatan = $request->get('nama_jawatan');
            return back()
                ->with('message', "Jawatan: $nama_jawatan sudah direkodkan, sila masukkan rekod lain.");
        } else {        
            $add = new ref_jawatan(array(
                'nama_jawatan'      => $request->get('nama_jawatan'),
                'created_by'        => Auth::user()->name,
            ));
            $add -> save();

            $nama = Str::ucfirst($add->nama_jawatan);

            Log_Aktiviti::create([
                'module_id'     => json_encode($add->id_jawatan),
                'module_type'   => class_basename(get_class($jwtn)),
                'before'        => null,
                'after'         => json_encode($add),
                'action'        => $request->route()->getActionMethod(),
                'action_byid'   => $request->user()->id,
                'action_name'   => $request->user()->name,
            ]);

            return redirect('p_Jawatan')->with('status', "Jawatan: $nama telah berjaya direkodkan.");
        }
    }

    public function edit($id, Request $request)
    {
        $ref_jawatan     = ref_jawatan::whereid_jawatan($id)->firstOrFail();
        return view('penyelenggaraan.p_EditJawatan')->with(compact('ref_jawatan'));;
    }


    public function update($id, Request $request, ref_jawatan $jwtn)
    {   
        $refjawatan = ref_jawatan::where('id_jawatan', '=', $id)->firstOrFail();
        $original   = $refjawatan->getOriginal();

        $refjawatan->nama_jawatan   = $request->get('nama_jawatan'); 
        $refjawatan->action_by      = Auth::user()->name;
        $refjawatan->update();

        $nama = $refjawatan->nama_jawatan;
        $changes    =   $refjawatan->getChanges();

        Log_Aktiviti::create([
            'module_id'     => json_encode($refjawatan->id_jawatan),
            'module_type'   => class_basename(get_class($jwtn)),
            'before'        => json_encode(array_intersect_key($original, $changes)),
            'after'         => json_encode($changes),
            'action'        => $request->route()->getActionMethod(),
            'action_byid'   => $request->user()->id,
            'action_name'   => $request->user()->name,
        ]);

        return redirect ('p_Jawatan')
            ->with('status', "Rekod jawatan: $nama telah berjaya diubah suai.");
    }

    public function delete($id, Request $request, ref_jawatan $jwtn)
    {
        $data   = ref_jawatan::find($id);
        $original   = $data->getOriginal();        
        $data->delete();

        $nama   = $data->nama_jawatan;

        $changes    =   $data->getChanges();

        Log_Aktiviti::create([
            'module_id'     => json_encode($data->id_jawatan),
            'module_type'   => class_basename(get_class($jwtn)),
            'before'        => json_encode($original),
            'after'         => null,
            'action'        => $request->route()->getActionMethod(),
            'action_byid'   => $request->user()->id,
            'action_name'   => $request->user()->name,
        ]);

        return redirect()->back()->with('status', "Rekod jawatan: $nama telah berjaya dihapuskan.");
    }   
}