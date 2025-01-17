<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use File;
use Auth;
use App\Models\Event;
use App\Models\AhliMesyuarat;
use App\Models\AhliEvent;

class CetakanKehadiranController extends Controller
{
    // Auth need to login first
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function cetakankehadiran($id, Request $request)
    {   
        $nama             = $request->get('nama_ahli');  
        $jawatan          = $request->get('jawatan'); 
        
    }
}
