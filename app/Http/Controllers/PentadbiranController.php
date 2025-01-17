<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pentadbiran;
use App\Models\KodGelaran;
use App\Models\KodGelaranDarjah;
use App\Models\KodAgama;
use App\Models\KodStatusPerkahwinan;
use App\Models\KodJantina;
use App\Models\KodKelulusanAkademik;
use App\Models\KodNegeri;
use App\Models\KodParlimen;
use App\Models\KodDun;
use App\Models\KodParti;
use App\Models\KodPartiKomponen;
use App\Models\KodPartiJawatan;
use App\Models\KodJawatan;
use App\Models\KodKementerian;
use App\Models\KodJenisLantikanSenator;
use App\Models\SejarahApButiranPeribadi;

class PentadbiranController extends Controller
{
    // Auth need to login first
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    public function index(Request $request)
    {
        // $pentadbiran=Pentadbiran::All();

        $pentadbiran=Pentadbiran::where('kod_jawatan', '=', '1')
                        ->orWhere('kod_jawatan', '=', '2')
                        ->orWhere('kod_jawatan', '=', '3')
                        ->get();

        $custom_timestamp = date('YmdHis');
        return view('pentadbiran.pen_AhliJemaahMenteri')->with(compact('pentadbiran', 'custom_timestamp'));
    }

    public function indexTim(Request $request)
    {
        // $pentadbiran=Pentadbiran::All();

        $pentadbiran=Pentadbiran::where('kod_jawatan', '=', '5')->get();

        $custom_timestamp = date('YmdHis');
        return view('pentadbiran.pen_TimMenteri')->with(compact('pentadbiran', 'custom_timestamp'));
    }

    public function indexMBKM(Request $request)
    {
        // $pentadbiran=Pentadbiran::All();

        $pentadbiran=Pentadbiran::where('kod_jawatan', '=', '4')->get();

        $custom_timestamp = date('YmdHis');
        return view('pentadbiran.pen_MBKM')->with(compact('pentadbiran', 'custom_timestamp'));
    }

    public function indexSUPOL(Request $request)
    {
        // $pentadbiran=Pentadbiran::All();

        $pentadbiran=Pentadbiran::where('kod_jawatan', '=', '7')->get();

        $custom_timestamp = date('YmdHis');
        return view('pentadbiran.pen_SUPOL')->with(compact('pentadbiran', 'custom_timestamp'));
    }

    public function indexDR(Request $request)
    {
        $pentadbiran   = Pentadbiran::where('pentadbiran.adr_status','!=','')
                                                    ->orderBy(KodParlimen::select('parlimen')
                                                    ->whereColumn('kod_parlimen.id','pentadbiran.kod_parlimen')
                                                    )     
                                                    ->orderby('pentadbiran.kod_jawatan','asc')
                                                    ->orderby('pentadbiran.jawatan_kekananan', 'asc')                                           
                                                    ->get();

        $custom_timestamp = date('YmdHis');
        return view('pentadbiran.pen_DR')->with(compact('pentadbiran', 'custom_timestamp'));
    }
    

    public function indexDN(Request $request)
    {
        $pentadbiran   = Pentadbiran::where('pentadbiran.adn_status','!=','')
                                                   ->orderby('pentadbiran.adn_kekananan', 'asc')
                                                   ->get();

        $custom_timestamp = date('YmdHis');
        return view('pentadbiran.pen_DN')->with(compact('pentadbiran', 'custom_timestamp'));
    }





    public function indexDNLantikan(Request $request)
    {
        $var1='14';
        $var2='15';
        $var3='16';
        $var4='17';
        
        $pentadbiran   = Pentadbiran::where('pentadbiran.adn_status','!=','')
                                                    ->where(function($query) use ($var1,$var2,$var3,$var4){
                                                        $query->where('kod_jenis_lantikan_senator','=',$var1)
                                                        ->orWhere('kod_jenis_lantikan_senator','=',$var2)
                                                        ->orWhere('kod_jenis_lantikan_senator','=',$var3)
                                                        ->orWhere('kod_jenis_lantikan_senator','=',$var4);
                                                    }) 
                                                   ->orderby('pentadbiran.adn_kekananan', 'asc')
                                                   ->get(); 

        $custom_timestamp = date('YmdHis');
        return view('pentadbiran.pen_DN')->with(compact('pentadbiran', 'custom_timestamp'));
    }





    public function indexDNLantikanNegeri(Request $request)
    {
        $var1='1';
        $var2='2';
        $var3='3';
        $var4='4';
        $var5='5';
        $var6='6';
        $var7='7';
        $var8='8';
        $var9='9';
        $var10='10';
        $var11='11';
        $var12='12';
        $var13='13';
        
        $pentadbiran   = Pentadbiran::where('pentadbiran.adn_status','!=','')
                                                    ->where(function($query) use ($var1,$var2,$var3,$var4,$var5,$var6,$var7,$var8,$var9,$var10,$var11,$var12,$var13){
                                                        $query->where('kod_jenis_lantikan_senator','=',$var1)
                                                        ->orWhere('kod_jenis_lantikan_senator','=',$var2)
                                                        ->orWhere('kod_jenis_lantikan_senator','=',$var3)
                                                        ->orWhere('kod_jenis_lantikan_senator','=',$var4)
                                                        ->orWhere('kod_jenis_lantikan_senator','=',$var5)
                                                        ->orWhere('kod_jenis_lantikan_senator','=',$var6)
                                                        ->orWhere('kod_jenis_lantikan_senator','=',$var7)
                                                        ->orWhere('kod_jenis_lantikan_senator','=',$var8)
                                                        ->orWhere('kod_jenis_lantikan_senator','=',$var9)
                                                        ->orWhere('kod_jenis_lantikan_senator','=',$var10)
                                                        ->orWhere('kod_jenis_lantikan_senator','=',$var11)
                                                        ->orWhere('kod_jenis_lantikan_senator','=',$var12)
                                                        ->orWhere('kod_jenis_lantikan_senator','=',$var13);
                                                    }) 
                                                   ->orderby('pentadbiran.adn_kekananan', 'asc')
                                                   ->get(); 

        $custom_timestamp = date('YmdHis');
        return view('pentadbiran.pen_DNLantikanNegeri')->with(compact('pentadbiran', 'custom_timestamp'));
    }








    public function delete($id)

    {
        $data   = Pentadbiran::find($id);
        $nama   = $data->nama_kad_pengenalan;

        $data->delete();

        return redirect()->back()->with('status', "Rekod kementerian $nama telah berjaya dihapuskan.");
    }

    public function show($id)
    {
        $pentadbiran=Pentadbiran::whereid($id)->firstOrFail();
        $custom_timestamp = date('YmdHis');
        return view('pentadbiran.pen_ShowJemaah')->with(compact('pentadbiran', 'custom_timestamp'));
    }
}
