<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Stall;
use Illuminate\Http\Request;

class StallController extends Controller
{
    public function index()
    {
        $title = "Stall List";
        $description = "Some description for the page";


        $activeEvents = Event::where('status', 'active')->get();
//        $expiredEvents = Event::where('status', 'expired')->get();
        $activeStalls = [];
        $expiredStalls = [];
        $stalls = Stall::all();

//        dd($activeEvents);

        return view('pages.applications.stall.stall', compact('title', 'description', 'stalls', 'activeStalls', 'expiredStalls', 'activeEvents'));
    }

    public function store(Request $request)
    {



        $request->validate([
            'event_id' => 'required',
            'stall_name' => 'required',
            'stall_detail' => 'required',
            'stall_location' => 'required',
        ]);


        $stall = new Stall([
            'event_id' => $request->get('event_id'),
            'name' => $request->get('stall_name'),
            'detail' => $request->get('stall_detail'),
            'location' => $request->get('stall_location'),
//            'pic_name' => '',
//            'pic_contact' => '',
            'status' => 'available',
        ]);

        $stall->save();


        if ($request->file('stall_image')) {
            $image = $request->file('stall_image');
            $image->move('images', $image->getClientOriginalName());
            $imageName = $image->getClientOriginalName();
            $stall->image = $imageName;
            $stall->save();
        }

        return redirect(route('stall.stall_list', ['language' => app()->getLocale()]))->with('success', 'Stall created successfully!');
//        return redirect(route('event.event_list', app()->getLocale()))->with('success', 'Event created successfully!');
    }


    public function stallDetail()
    {
        $title = "Stall Detail";
        $description = "Some description for the page";
        return view('pages.applications.stall.stall_detail', compact('title', 'description'));
    }

    public function editStall($id)
    {
        $stall = Stall::find($id);
        return response()->json($stall);
    }

    public function updateStall($id, Request $request)
    {
        $request->validate([
            'event_id' => 'required',
            'stall_name' => 'required',
            'stall_detail' => 'required',
            'stall_location' => 'required',
        ]);

        $stall = Stall::find($id);
        $stall->event_id = $request->get('event_id');
        $stall->name = $request->get('stall_name');
        $stall->detail = $request->get('stall_detail');
        $stall->location = $request->get('stall_location');

        $stall->save();

        if ($request->file('stall_image')) {
            $image = $request->file('stall_image');
            $image->move('images', $image->getClientOriginalName());
            $imageName = $image->getClientOriginalName();
            $stall->image = $imageName;
            $stall->save();
        }

        return response()->json(['success' => 'Stall updated successfully!']);

    }

    public function removeStall($id)
    {
        $stall = Stall::find($id);

        $result = $stall->delete();

        if ($result) {
            return response()->json(['success' => 'Stall deleted successfully!']);
        } else {
            return response()->json(['error' => 'Stall not deleted!']);
        }
    }
}
