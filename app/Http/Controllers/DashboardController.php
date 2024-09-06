<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventStall;
use App\Models\SalesOrder;

class DashboardController extends Controller
{

    public function redirectToIndex()
    {
        return redirect()->route('dashboard.demo_one');
    }

    /**
     * Display dashbnoard demo one of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $title = "Dashboard";
        $description = "Some description for the page";
    
        // Count of all events
        $totalEvents = Event::all()->count();
    
        // Count of all stalls and their booked/available status
        $totalStalls = EventStall::all()->groupBy('time_slot_id')->map(function ($stalls) {
            return [
                'total' => $stalls->count(),
                'booked' => $stalls->where('status', 1)->count(),
                'available' => $stalls->where('status', 0)->count(),
            ];
        });
    
        // Total sales and sales per event
        $totalSales = SalesOrder::where('status', 'paid')->get()->sum('total_price');
        $totalSales = number_format((float)$totalSales, 2, '.', '');
    

        

        

        $salesPerEvent = SalesOrder::where('status', 'paid')
            ->selectRaw('event_id, SUM(total_price) as total_sales')
            ->groupBy('event_id')
            ->get()
            ->map(function ($sale) {
                return [
                    'event_id' => $sale->event_id,
                    'total_sales' => number_format((float)$sale->total_sales, 2, '.', ''),
                    'event_name' => Event::find($sale->event_id)->name ?? 'Unknown Event',
                ];
            });
    
        // Count of active events
        $activeEvent = Event::where('status', 'active')->count();
    
        // Count of expired events
        $expiredEvent = Event::where('end_date', '<', now())->count();
    
        return view('pages.dashboard.demo_one', compact(
            'title', 'description', 'totalEvents', 'totalStalls', 'totalSales', 'salesPerEvent', 'activeEvent', 'expiredEvent'
        ));
    }
    

    /**
     * Display dashbnoard demo two of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function demoTwo()
    {
        $title = "Dashboard Demo Two";
        $description = "Some description for the page";
        return view('pages.dashboard.demo_two', compact('title', 'description'));
    }

    /**
     * Display dashbnoard demo three of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function demoThree()
    {
        $title = "Dashboard Demo Three";
        $description = "Some description for the page";
        return view('pages.dashboard.demo_three', compact('title', 'description'));
    }

    /**
     * Display dashbnoard demo four of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function demoFour()
    {
        $title = "Dashboard Demo Four";
        $description = "Some description for the page";
        return view('pages.dashboard.demo_four', compact('title', 'description'));
    }

    /**
     * Display dashbnoard demo five of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function demoFive()
    {
        $title = "Dashboard Demo Five";
        $description = "Some description for the page";
        return view('pages.dashboard.demo_five', compact('title', 'description'));
    }

    /**
     * Display dashbnoard demo six of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function demoSix()
    {
        $title = "Dashboard Demo Six";
        $description = "Some description for the page";
        return view('pages.dashboard.demo_six', compact('title', 'description'));
    }

    /**
     * Display dashbnoard demo seven of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function demoSeven()
    {
        $title = "Dashboard Demo Seven";
        $description = "Some description for the page";
        return view('pages.dashboard.demo_seven', compact('title', 'description'));
    }

    /**
     * Display dashbnoard demo eight of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function demoEight()
    {
        $title = "Dashboard Demo Eight";
        $description = "Some description for the page";
        return view('pages.dashboard.demo_eight', compact('title', 'description'));
    }

    /**
     * Display dashbnoard demo nine of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function demoNine()
    {
        $title = "Dashboard Demo Nine";
        $description = "Some description for the page";
        return view('pages.dashboard.demo_nine', compact('title', 'description'));
    }

    /**
     * Display dashbnoard demo ten of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function demoTen()
    {
        $title = "Dashboard Demo Ten";
        $description = "Some description for the page";
        return view('pages.dashboard.demo_ten', compact('title', 'description'));
    }
}
