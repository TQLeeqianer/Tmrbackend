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

    public function updateStatus(Request $request)
    {
        $salesOrderId = $request->get('order_id');
        $status = $request->get('status');

        $salesOrder = SalesOrder::find($salesOrderId);
        $salesOrder->status = $status;
        $salesOrder->save();

        return response()->json(['message' => 'Sales order status updated successfully!'], 200);
    }

    public function saveSalesOrder(Request $request)
    {
        $customerId = $request->get('customer_id');
        $eventId = $request->get('event_id');
        $timeSlotId = $request->get('timeslot_id');
        $rawStallList = $request->get('event_stalls');


        $stallList = [];
        foreach ($rawStallList as $stall) {
            $stallList[] = [
                'stallId' => $stall['stall_id'],
                'timeSlotId' => $stall['time_slot_id'],
                'price' => $stall['price'],
            ];
        }



        $payAmount = 0;

        if (count($stallList) > 0) {
            foreach ($stallList as $stall) {
                $payAmount += $stall['price'];
            }
        }

        $customer = User::find($customerId);

        $salesOrder = new SalesOrder([
            'order_number' => 'SO-' . time() . '-' . rand(10, 100),
            'total_price' => $payAmount,
            'status' => 'pending',
            'customer_id' => $customerId,
            'customer_name' => $customer->name,
            'event_id' => $eventId,
            'time_slot_id' => $timeSlotId,
            'stall_info' => json_encode($stallList),
        ]);


        foreach ($stallList as $stall) {
            $stall = EventStall::where('stall_id', $stall['stallId'])->first();
            $stall->status = 1;
            $stall->stall_owner_id = $customerId;
            $stall->booked_at = now();
            $stall->save();
        }


        $salesOrder->save();

        return response()->json(['message' => 'Sales order created successfully!'], 200);
    }

    public function getStalls(Request $request)
    {
        $time_slot_id = $request->get('timeslot_id');

        try {
            // Assuming you have a model `Timeslot` related to `Event`
            $eventStall = EventStall::query()
                ->where('time_slot_id', $time_slot_id)
                ->where('status', 0)
                ->get(); // Fetch timeslots by event ID
            return response()->json($eventStall, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error loading eventStall'], 500);
        }
    }


    public function getEventList(Request $request)
    {
        $events = Event::all();

        return response()->json($events);
    }

    public function getSalesOrderList(Request $request)
    {
        $filterData = $request->get('filterData');

        switch ($filterData) {
            case 'pending':
                $status = 'pending';
                break;
            case 'paid':
                $status = 'paid';
                break;
            case 'cancel':
                $status = 'cancel';
                break;
            default:
                $status = null;
                break;
        }

        $salesOrders = SalesOrder::query()
            ->where('status', 'LIKE', "%{$status}%")
            ->get();


        return response()->json($salesOrders);


    }

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

    public function getTimeslots(Request $request)
    {
        $eventId = $request->get('event_id');


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
