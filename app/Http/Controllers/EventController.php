<?php

namespace App\Http\Controllers;

use Log;
use Alert;
use Validator;
use App\Models\Event;
use App\Models\AhliEvent;
use App\Models\Log_Aktiviti;

use Illuminate\Http\Request;
use App\Models\AhliMesyuarat;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\ref_tajuk_mesyuarat;
use App\Models\ButiranAhliMesyuarat;
use Illuminate\Support\Facades\Auth;
use App\Models\LantikanAhliMesyuarat;

class EventController extends Controller
{
    // Auth need to login first
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $events = Event::select(
        'id',
        'title',
        'allDay',
        'start',
        'end',
        'time1',
        'time2',
        'location',
        'agenda',
        'meeting_numbers',
        'year',
        'location',
        'color',
        'textColor',
        'aktiviti',
        'pindaan',
        'pindaan_ke',
        'statuspin'
        )->get();

        foreach ($events as $event) {
            $event->start = $event->start . ' ' . $event->time1;
            $event->end = $event->end . ' ' . $event->time2;

            // Check if it's an all-day event and add one day to the end date
            if ($event->allDay) {
            $event->end = date('Y-m-d', strtotime($event->end . ' +1 day'));
            }
        }
        return response()->json($events);
    }

    // Ensure this method is declared only once
    private function getColumnBasedOnTitle($ringkasan)
    {
        // This function determines the column name dynamically
        if (strtolower($ringkasan) === 'ksukp') {
            return 'mesyuarat_ksukp';
        } elseif (strtolower($ringkasan) === 'mbkm') {
            return 'mesyuarat_mbkm';
        } else {
            return null; // Return null for titles that don't require ahli event creation
        }
    }

    public function store(Request $request, Event $evt)
    {
        // Retrieve all necessary data
        $allDay = $request->input('allDay') ? 1 : 0; // Checkbox sends 'on' if checked
        $start = $request->input('start');
        $end = $request->input('end');
        $time1 = $request->input('time1');
        $time2 = $request->input('time2');

        // If the event is all day, set default times or adjust as needed
        if ($allDay) {
            $start .= ' 00:00:00'; // Set default start time
            $end .= ' 23:59:59'; // Set default end time
        } else {
            $start .= ' ' . $time1;
            $end .= ' ' . $time2;
        }

        $event = new Event([
            'title'             => $request->get('title'),
            'start'             => $start,
            'end'               => $end,
            'time1'             => $time1,
            'time2'             => $time2,
            'allDay'            => $allDay, // Store allDay as 1 or 0
            'meeting_numbers'   => $request->get('meeting_numbers'),
            'location'          => $request->get('location'),
            'agenda'            => $request->get('agenda'),
            'linkhadir'         => $request->get('linkhadir'),
            'year'              => $request->get('year'),
            'color'             => $request->get('color'),
            'textColor'         => $request->get('textColor'),
            'aktiviti'          => $request->get('aktiviti'),
            'pindaan'           => $request->get('pindaan'),
            'pindaan_ke'        => $request->get('pindaan') === 'Y' ? $request->get('pindaan_ke') : null,
            'statuspin'         => $request->get('pindaan') === 'Y' ? $request->get('statuspin') : null,
            'created_by'        => $request->user()->name,
        ]);

        $event->save();

        $ringkasan = $request->get('title');

        // Fetch the ref_tajuk_mesyuarat record based on ringkasan
        $tajuk = ref_tajuk_mesyuarat::where('ringkasan', $ringkasan)->first();

        // Determine the column name dynamically
        $column_name = $this->getColumnBasedOnTitle($tajuk->ringkasan);


        if ($column_name) {
            // Query ButiranAhliMesyuarat for relevant ahli_id
            $ahli_ids = ButiranAhliMesyuarat::where($column_name, 1)
                ->where('status', 1)
                ->pluck('id_ahli');

            // Only create AhliEvent records if ahli_ids are found
            if ($ahli_ids->isNotEmpty()) {
                foreach ($ahli_ids as $ahli_id) {

                    // Retrieve kekananan_mesy_manual for the current ahli_id
                    $kekananan = LantikanAhliMesyuarat::where('id_ahli', $ahli_id)->value('kekananan_mesy_manual');

                    AhliEvent::create([
                        'mesyuarat_id' => $event->id,
                        'ahli_id'      => $ahli_id,
                        'susunan'      => $kekananan, // Set susunan with kekananan_mesy_manual
                    ]);
                }
            }
        }

        Log_Aktiviti::create([
            'module_id'     => json_encode($event->id),
            'module_type'   => class_basename(get_class($evt)),
            'before'        => null,
            'after'         => json_encode($event),
            'action'        => $request->route()->getActionMethod(),
            'action_byid'   => $request->user()->id,
            'action_name'   => $request->user()->name,
        ]);

        // return redirect()->back()->with('status', "Rekod $ringkasan telah berjaya ditambah");
        return response()->json(['status' => "Rekod $ringkasan telah berjaya ditambah"]);
    }

    public function update(Request $request, Event $evt)
    {
        $event = Event::find($request->id);
        $title = $event->title;
        // Retrieve all necessary data
        $allDay = $request->input('allDay') ? 1 : 0; // Checkbox sends 'on' if checked
        $start = $request->input('start');
        $end = $request->input('end');
        $time1 = $request->input('time1');
        $time2 = $request->input('time2');

        // If the event is all day, set default times or adjust as needed
        if ($allDay) {
            $start .= ' 00:00:00'; // Set default start time
            $end .= ' 23:59:59'; // Set default end time
        } else {
            $start .= ' ' . $time1;
            $end .= ' ' . $time2;
        }

        $original   = $event->getOriginal();
        $event->update([
            'title'             => $request->get('title'),
            'start'             => $start,
            'end'               => $end,
            'time1'             => $request->get('time1'),
            'time2'             => $request->get('time2'),
            'allDay'            => $allDay,
            'meeting_numbers'   => $request->get('meeting_numbers'),
            'location'          => $request->get('location'),
            'agenda'            => $request->get('agenda'),
            'linkhadir'         => $request->get('linkhadir'),
            'year'              => $request->get('year'),
            'color'             => $request->get('color'),
            'textColor'         => $request->get('textColor'),
            'aktiviti'          => $request->get('aktiviti'),
            'pindaan'           => $request->get('pindaan'),
            'pindaan_ke'        => $request->get('pindaan') === 'Y' ? $request->get('pindaan_ke') : null,
            'statuspin'         => $request->get('pindaan') === 'Y' ? $request->get('statuspin') : null,
            'updated_at'        => Carbon::now()->toDateTimeString(),
            'action_by'         => Auth::user()->name,
        ]);

        $changes    =    $event->getChanges();
        Log_Aktiviti::create([
            'module_id'     => json_encode($event->id),
            'module_type'   => class_basename(get_class($evt)),
            'before'        => json_encode(array_intersect_key($original, $changes)),
            'after'         => json_encode($changes),
            'action'        => $request->route()->getActionMethod(),
            'action_byid'   => $request->user()->id,
            'action_name'   => $request->user()->name,
        ]);

        // Return a success response
        return response()->json(['status' => "Rekod $title telah berjaya dikemaskini"]);
    }

    public function destroy(Request $request, Event $evt)
    {
        // Validate request data
        $request->validate([
            'id' => 'required|integer|exists:events,id'
        ]);

        // Get the event id from the request
        $id = $request->id;

        // Find the event to get its title
        $event = Event::find($id);
        $title = $event->title;
        $original = $event->getOriginal();

        // Use a database transaction to ensure atomicity
        DB::transaction(function () use ($id) {
            // Deleting from the event table
            Event::where('id', $id)->delete();

            // Deleting from the ahli_event table
            AhliEvent::where('mesyuarat_id', $id)->delete();
        });

        $changes    =    $event->getChanges();

        Log_Aktiviti::create([
            'module_id'     => json_encode($event->id),
            'module_type'   => class_basename(get_class($event)),
            'before'        => json_encode(array_intersect_key($original, $changes)),
            'after'         => json_encode($changes),
            'action'        =>  $request->route()->getActionMethod(),
            'action_byid'   =>  $request->user()->id,
            'action_name'   =>  $request->user()->name,

        ]);

        // Return a success response
        return response()->json(['status' => "Rekod $title telah berjaya dipadam"]);
    }

}
