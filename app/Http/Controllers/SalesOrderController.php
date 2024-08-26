<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventStall;
use App\Models\EventTimeSlot;
use App\Models\SalesOrder;
use App\Models\SalesOrderStall;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesOrderController extends Controller
{

    public function searchCustomer(Request $request)
    {

        $search = $request->input('search');

        $data = User::query()
            ->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            })
            ->where('type', 1)
            ->limit(20)
            ->get();

//        dd($data);

        return response()->json($data);

    }

    public function index()
    {
        $title = "Sales Order List";
        $description = "List of all sales orders";
        $salesOrders = SalesOrder::all();
        $events = Event::all();

        return view('pages.applications.sales_order.sales_order', compact('title', 'description', 'salesOrders', 'events'));
    }

    public function getTimeslots($eventId)
    {
        try {
            // Assuming you have a model `Timeslot` related to `Event`
            $timeslots = EventTimeSlot::where('event_id', $eventId)->get(); // Fetch timeslots by event ID
            return response()->json($timeslots, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error loading timeslots'], 500);
        }
    }

    public function getEventStall($time_slot_id)
    {
        try {
            // Assuming you have a model `Timeslot` related to `Event`
            $eventStall = EventStall::where('time_slot_id', $time_slot_id)->get(); // Fetch timeslots by event ID
            return response()->json($eventStall, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error loading eventStall'], 500);
        }
    }


    public function store(Request $request)
    {
        // Generate a unique order number
        $orderNumber = 'SO-' . strtoupper(uniqid());

        // Start the transaction
        DB::beginTransaction();

        // Create a new SalesOrder instance with basic details
        $salesOrder = new SalesOrder([
            'order_number' => $orderNumber,
            'customer_name' => $request->get('customer_name'),
            'customer_id' => $request->get('customer_id'),
            'status' => $request->get('status'),
            'total_price' => $request->get('total_price'),
            'event' => $request->get('event'), // New event field
            'timeslot' => $request->get('timeslot'), // New timeslot field
            'stall_info' => $request->get('stall_info'),
        ]);

        // Save the sales order first to get the ID
        $salesOrder->save();

        // Handle event stalls if provided
        $eventStalls = $request->get('event_stalls');
        // return $eventStalls;
        if (!empty($eventStalls)) {
            foreach ($eventStalls as $stall) {
                // Assuming EventStall is the related model
                $eventStall = new SalesOrderStall([
                    'stall_id' => $stall['stall_id'],
                    'sales_order_id' => $salesOrder->id,
                ]);
                $eventStall->save();

            }
        }

        // Commit the transaction
        DB::commit();

        // return redirect()->route('sales_orders.index')->with('success', 'Sales order created successfully!');
    }


    public function update(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_id' => 'required|integer',
            'status' => 'required|string',
            'total_price' => 'required|numeric',
            'event' => 'required|string', // New event field validation
            'timeslot' => 'required|string', // New timeslot field validation
            'stall_info' => 'required|string',
        ]);

        $salesOrder = SalesOrder::find($request->get('id'));
        $salesOrder->update($request->all());

        return redirect()->route('sales_orders.index', ['language' => app()->getLocale()])->with('success', 'Sales order updated successfully!');
    }

    public function destroy(SalesOrder $salesOrder)
    {
        $result = $salesOrder->delete();

        if ($result) {
            return redirect()->route('sales_orders.index', ['language' => app()->getLocale()])->with('success', 'Sales order deleted successfully!');
        } else {
            return redirect()->route('sales_orders.index', ['language' => app()->getLocale()])->with('error', 'Sales order not deleted!');
        }
    }
}
