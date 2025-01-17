<?php

namespace App\Http\Controllers;

// function use
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use DateTime;
use Alert;

use App\Models\AhliMesyuarat;
use App\Models\Event;
use App\Models\ButiranAhliMesyuarat;
use App\Models\AhliEvent;
use App\Models\ref_tajuk_mesyuarat;
use Illuminate\Http\Request;

class FullCalendarController extends Controller
{
    // Auth need to login first
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $request)
    {
        // $event=Event::Latest()->get();
        // return response()->json($event);

        if ($request->ajax()) {

            $event = Event::whereDate('start', '>=', $request->start)
                ->whereDate('end',   '<=', $request->end)
                ->get(['id', 'title', 'start', 'end', 'time1', 'time2', 'meeting_numbers', 'location', 'agenda', 'linkhadir', 'year', 'color', 'textColor', 'status', 'pindaan', 'pindaan_ke']);

            return response()->json($event);
        }

        $ref_tajuk_mesyuarat = ref_tajuk_mesyuarat::all();

        $event = Event::all();

        // return view('/mesyuarat/mesyuarat_tambah2')->with(compact ('ref_tajuk_mesyuarat', 'event'));

        return view('/mesyuarat/fullcalendar')->with(compact('ref_tajuk_mesyuarat', 'event'));
    }

    public function destroy($id)
    {
        $event   = Event::find($id);
        $title   = $event->title;        

        DB::transaction(function () use ($id) {
            // Deleting from the event table
            Event::where('id', $id)->delete();

            // Deleting from the ahli_event table
            AhliEvent::where('mesyuarat_id', $id)->delete();
        });
           
        return redirect('/mesyuarat/fullcalendar')->with('status', "Rekod $title telah berjaya dipadam");
    }

    public function show($id)
    {
        $ref_tajuk_mesyuarat = ref_tajuk_mesyuarat::all();
        $event = Event::whereid($id)->firstOrFail();
        $event_time1 = $event->time1 ? new DateTime($event->time1) : null;
        $event_time2 = $event->time2 ? new DateTime($event->time2) : null;
        return view('mesyuarat.m_SelenggaraKalendar')->with(compact('event', 'ref_tajuk_mesyuarat', 'event_time1', 'event_time2'));
    }
    
    public function update($id, Request $request)
    {
        $event = Event::where('id', $id)->firstOrFail();
        
        $event->title             = $request->get('title');
        $event->start             = $request->get('start');
        $event->end               = $request->get('end');
        $event->time1             = $request->get('time1');
        $event->time2             = $request->get('time2');
        $event->meeting_numbers   = $request->get('meeting_numbers');
        $event->location          = $request->get('location');
        $event->agenda            = $request->get('agenda');
        $event->linkhadir         = $request->get('linkhadir');
        $event->year              = $request->get('year');
        $event->color             = $request->get('color');
        $event->textColor         = $request->get('textColor');
        $event->aktiviti          = $request->get('aktiviti');
        $event->statuspin         = $request->get('statuspin');
        $event->pindaan           = $request->get('pindaan');
        $event->pindaan_ke        = $request->get('pindaan_ke'); 
        $event->updated_by        = Auth::User()->name;
        $ahli->updated_at         = Carbon::now()->toDateTimeString();           
        
        $event->update();

        $ringkasan = $request->title;

        return redirect('/mesyuarat/fullcalendar')->with('status', "Rekod $ringkasan telah berjaya dikemaskini");
    }

    // public function ajax(Request $request)
    // {
    //     switch ($request->type) {
    //         case 'add':
    //             if ($request->pindaan == 'Y') {
    //                 $event = Event::create([
    //                     'title' => $request->title,
    //                     'start' => $request->start,
    //                     'end' => $request->end,
    //                     'time1' => $request->time1,
    //                     'time2' => $request->time2,
    //                     'meeting_numbers' => $request->meeting_numbers,
    //                     'location' => $request->location,
    //                     'agenda' => $request->agenda,
    //                     'linkhadir' => $request->linkhadir,
    //                     'year' => $request->year,
    //                     'color' => $request->color,
    //                     'textColor' => $request->textColor,
    //                     'status' => $request->status,
    //                     'pindaan' => 'Y',
    //                     'pindaan_ke' => $request->pindaan_ke,
    //                 ]);
    //             } else {
    //                 $event = Event::create([
    //                     'title' => $request->title,
    //                     'start' => $request->start,
    //                     'end' => $request->end,
    //                     'time1' => $request->time1,
    //                     'time2' => $request->time2,
    //                     'meeting_numbers' => $request->meeting_numbers,
    //                     'location' => $request->location,
    //                     'agenda' => $request->agenda,
    //                     'linkhadir' => $request->linkhadir,
    //                     'year' => $request->year,
    //                     'color' => $request->color,
    //                     'textColor' => $request->textColor,
    //                     'pindaan' => 'N',
    //                     'pindaan_ke' => '-',
    //                 ]);
    //             }
    //             return response()->json($event);
    //             break;

    //         case 'update':
    //             if ($request->pindaan == 'Y') {
    //                 $event = Event::find($request->id)->update([
    //                     'title' => $request->title,
    //                     'start' => $request->start,
    //                     'end' => $request->end,
    //                     'time1' => $request->time1,
    //                     'time2' => $request->time2,
    //                     'meeting_numbers' => $request->meeting_numbers,
    //                     'location' => $request->location,
    //                     'agenda' => $request->agenda,
    //                     'linkhadir' => $request->linkhadir,
    //                     'year' => $request->year,
    //                     'color' => $request->color,
    //                     'textColor' => $request->textColor,
    //                     'status' => $request->status,
    //                     'pindaan' => 'Y',
    //                     'pindaan_ke' => $request->pindaan_ke,
    //                 ]);
    //             } else {
    //                 $event = Event::find($request->id)->update([
    //                     'title' => $request->title,
    //                     'start' => $request->start,
    //                     'end' => $request->end,
    //                     'time1' => $request->time1,
    //                     'time2' => $request->time2,
    //                     'meeting_numbers' => $request->meeting_numbers,
    //                     'location' => $request->location,
    //                     'agenda' => $request->agenda,
    //                     'linkhadir' => $request->linkhadir,
    //                     'year' => $request->year,
    //                     'color' => $request->color,
    //                     'textColor' => $request->textColor,
    //                     'status' => $request->status,
    //                     'pindaan' => 'N',
    //                     'pindaan_ke' => '-',
    //                 ]);
    //                 return response()->json($event);
    //                 break;
    //             }

    //         default:
    //             # code...
    //             break;
    //     }
    // }
}
