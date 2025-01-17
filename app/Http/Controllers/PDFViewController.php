<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PDFViewController extends Controller
{
    public function show($filename)
    {       
        $filename = 'manual_Prime2.pdf';
        $filepath = 'public/';
        $path = $filepath.$filename;

        return Response::make(file_get_contents($path), 200, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; '.$filename,
        ]);
    }
}
