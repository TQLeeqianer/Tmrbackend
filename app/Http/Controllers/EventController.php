<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventStall;
use App\Models\EventTimeSlot;
use App\Models\Stall;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{

    public function index(Request $request)
    {
        $searchData = $request->get('search') ?? '';


        $title = "Event List";
        $description = "Some description for the page";

        if ($searchData) {
            $activeEvents = Event::where('name', 'like', '%' . $searchData . '%')
                ->orWhere('detail', 'like', '%' . $searchData . '%')
                ->where('status', 'active')->get();
            $expiredEvents = Event::where('name', 'like', '%' . $searchData . '%')
                ->orWhere('detail', 'like', '%' . $searchData . '%')
                ->where('status', 'expired')->get();

            $events = Event::where('name', 'like', '%' . $searchData . '%')
                ->orWhere('detail', 'like', '%' . $searchData . '%')
                ->orderBy('created_at', 'desc')->paginate(10);
        } else {
            $activeEvents = Event::where('status', 'active')->get();
            $expiredEvents = Event::where('status', 'expired')->get();
            $events = Event::orderBy('created_at', 'desc')->paginate(10);
        }

//        $activeEvents = Event::where('status', 'active')->get();
//        $expiredEvents = Event::where('status', 'expired')->get();
//        $events = Event::orderBy('created_at', 'desc')->get();
//        $events = Event::orderBy('created_at', 'desc')->paginate(10);

//        dd($searchData);

        return view('pages.applications.event.event', compact('title', 'description', 'events', 'activeEvents', 'expiredEvents', 'searchData'));
    }

    public function store(Request $request)
    {


        // Validate the request data
        $request->validate([
            'event_name' => 'required',
            'event_detail' => 'required',
            'event_location' => 'required',
        ]);

        $startDate = Carbon::parse($request->get('start_date'));
        $endDate = Carbon::parse($request->get('end_date'));

        // Create the event
        $event = new Event([
            'name' => $request->get('event_name'),
            'detail' => $request->get('event_detail'),
            'location' => $request->get('event_location'),
            'image' => '', // Placeholder, will be updated if image is uploaded
            'event_map_image' => '',
            'person_in_charge' => 1,
            'sponsor' => 1,

            'event_address_1' => $request->get('event_address1') ?? '',
            'event_address_2' => $request->get('event_address2') ?? '',
            'event_postal_code' => $request->get('event_postal') ?? '',


            'start_time' => $startDate,
            'end_time' => $endDate,
            'start_date' => $startDate,
            'end_date' => $endDate,

            'status' => 'active',
        ]);

        $event->save();

        // Handle the event image upload
        $eventImage = $request->file('upload-event-image');
        $eventMapImage = $request->file('upload-event-map-image');

        if ($eventImage) {
            $image = $eventImage;
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $event->image = $imageName;
            $event->save();
        }

        if ($eventMapImage) {
            $image = $eventMapImage;
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $event->event_map_image = $imageName;
            $event->save();
        }

        // Handle the time slots
        foreach ($request->time_slots as $timeSlotData) {
            $timeSlot = new EventTimeSlot([
                'event_id' => $event->id,
                'date_from' => Carbon::parse($timeSlotData['date_from']),
                'date_to' => Carbon::parse($timeSlotData['date_to']),
                'time_from' => Carbon::parse($timeSlotData['time_from']),
                'time_to' => Carbon::parse($timeSlotData['time_to']),
            ]);
            $timeSlot->save();
            // Handle the stalls
            foreach ($request->stalls as $stallData) {
                for ($i = 1; $i <= $stallData['count']; $i++) {
                    $stall = new EventStall([
                        'event_id' => $event->id,
                        'time_slot_id' => $timeSlot->time_slot_id,
                        'category' => $stallData['category'],
                        'stall_type' => $stallData['type'],
                        'stall_count' => $i,
                        'date_from' => Carbon::parse($timeSlotData['date_from']),
                        'date_to' => Carbon::parse($timeSlotData['date_to']),
                        'time_from' => Carbon::parse($timeSlotData['time_from']),
                        'time_to' => Carbon::parse($timeSlotData['time_to']),
                        'price' => $stallData['price'],
                        'status' => 0,
                    ]);
                    $stall->save();
                }
            }
        }


        return redirect(route('event.event_list', ['language' => app()->getLocale()]))->with('success', 'Event created successfully!');
    }


    public function activeEventList()
    {
        $event = Event::where('status', 'active')->get();
        return response()->json($event);
    }

    public function eventDetail()
    {
        $title = "Event Detail";
        $description = "Some description for the page";
        //get all stall count
        $stallCount = Stall::count();
        //get all event count
        $eventCount = Event::count();
        return view('pages.applications.event.event_detail', compact('title', 'description', 'stallCount', 'eventCount'));
    }

    public function editEvent($id)
    {
        $event = Event::find($id);
        return response()->json($event);
    }

    public function updateEvent(Request $request, $id)
    {
        $request->validate([
            'event_name' => 'required',
            'event_detail' => 'required',
            'event_location' => 'required',
            'event_address_1' => 'required',
            'event_address_2' => 'required',
            'event_postal_code' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $event = Event::find($id);
        $event->name = $request->get('event_name');
        $event->detail = $request->get('event_detail');
        $event->location = $request->get('event_location');
        $event->event_address_1 = $request->get('event_address_1');
        $event->event_address_2 = $request->get('event_address_2');
        $event->event_postal_code = $request->get('event_postal_code');
        $event->start_date = $request->get('start_date');
        $event->end_date = $request->get('end_date');
        $event->save();


        return response()->json(['success' => 'Event updated successfully!']);
    }

    public function stallList($id)
    {
        $title = "Stall List";
        $description = "Some description for the page";

        //get all time slot
        $timeSlot = EventTimeSlot::where('event_id', $id)->get();

        foreach ($timeSlot as $key => $value) {
            $timeSlot[$key]['stalls'] = EventStall::where('event_id', $id)
                ->where('time_slot_id', $value->time_slot_id)
                ->get();
        }

        //get one time slot
        $timeSlotFirst = EventTimeSlot::where('event_id', $id)->orderBy('date_from')->first();

        $stalls = EventStall::where('event_id', $id)
            ->where('time_slot_id', $timeSlotFirst->time_slot_id)
            ->get();

        $eventMapImage = Event::where('id', $id)->first()->event_map_image;

        return view('pages.applications.event_stall.event_stall', compact('title', 'description', 'stalls', 'timeSlot', 'eventMapImage'));

    }

    public function eventStalldestroy($id)
    {
        try {
            // Find the stall by ID
            $stall = EventStall::findOrFail($id);

            // Delete the stall
            $stall->delete();

            // Return a success response
            return response()->json([
                'message' => 'Stall removed successfully!'
            ], 200);

        } catch (\Exception $e) {
            // Handle any errors that occur
            return response()->json([
                'message' => 'Failed to remove stall. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function eventStallUpdate(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'stall_type' => 'required|string|max:255',
            'stall_count' => 'required|integer',
            'category' => 'required|string|max:255',
        ]);

        try {
            // Find the stall by ID
            $stall = EventStall::findOrFail($id);

            // Update the stall with the new data
            $stall->stall_type = $request->input('stall_type');
            $stall->stall_count = $request->input('stall_count');
            $stall->category = $request->input('category');

            // Save the updated stall data
            $stall->save();

            // Return a success response
            return response()->json([
                'message' => 'Stall updated successfully!',
                'stall' => $stall
            ], 200);

        } catch (\Exception $e) {
            // Handle any errors that occur
            return response()->json([
                'message' => 'Failed to update stall. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function removeEvent($id)
    {
        $event = Event::find($id);

        $result = $event->delete();
        if ($result) {
            return response()->json(['success' => 'Event deleted successfully!']);
        } else {
            return response()->json(['error' => 'Event not deleted!']);
        }


    }
}
