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

        $totalEvents = Event::all()->count();

        $rawStalls = EventStall::all()->groupBy('time_slot_id')->first();

        $totalStalls = 0;
        if ($rawStalls) {
            $totalStalls = $rawStalls->count();
        }


        $totalSales = SalesOrder::where('status', 'paid')->get()->sum('total_price');
        $totalSales = number_format((float)$totalSales, 2, '.', '');


        return view('pages.dashboard.demo_one', compact('title', 'description', 'totalEvents', 'totalStalls', 'totalSales'));
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
