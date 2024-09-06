<div class="col-xxl-12">
    <div class="row">
        <!-- Total Stalls Card -->
        <div class="col-xxl-6 col-sm-6 mb-25">
            <div class="ap-po-details ap-po-details--2 p-25 radius-xl d-flex justify-content-between">
                <div class="overview-content w-100">
                    <div class="ap-po-details-content d-flex flex-wrap justify-content-between">
                        <div class="ap-po-details__titlebar">
                            <h1>{{ $totalStalls->sum('total') }}</h1>
                            <p>Total Stalls</p>
                            <ul>
                                @foreach($totalStalls as $stall)
                                    <li>Time Slot ID {{ $loop->index + 1 }}: Booked - {{ $stall['booked'] }}, Available - {{ $stall['available'] }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="ap-po-details__icon-area">
                            <div class="svg-icon order-bg-opacity-info color-info">
                                <i class="uil uil-shopping-cart-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Sales Card -->
        <div class="col-xxl-6 col-sm-6 mb-25">
            <div class="ap-po-details ap-po-details--2 p-25 radius-xl d-flex justify-content-between">
                <div class="overview-content w-100">
                    <div class="ap-po-details-content d-flex flex-wrap justify-content-between">
                        <div class="ap-po-details__titlebar">
                            <h1>RM {{ $totalSales }}</h1>
                            <p>Total Sales</p>
                            <ul>
                                @foreach($salesPerEvent as $sale)
                                    <li>{{ $sale['event_name'] }}: RM {{ $sale['total_sales'] }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="ap-po-details__icon-area">
                            <div class="svg-icon order-bg-opacity-secondary color-secondary">
                                <i class="uil uil-usd-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Other cards remain the same -->
        <!-- Active Events Card -->
        <div class="col-xxl-6 col-sm-6 mb-25">
            <div class="ap-po-details ap-po-details--2 p-25 radius-xl d-flex justify-content-between">
                <div class="overview-content w-100">
                    <div class="ap-po-details-content d-flex flex-wrap justify-content-between">
                        <div class="ap-po-details__titlebar">
                            <h1>{{ $activeEvent }}</h1>
                            <p>Active Event</p>
                        </div>
                        <div class="ap-po-details__icon-area">
                            <div class="svg-icon order-bg-opacity-secondary color-secondary">
                                <i class="uil uil-calendar-check"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Expired Events Card -->
        <div class="col-xxl-6 col-sm-6 mb-25">
            <div class="ap-po-details ap-po-details--2 p-25 radius-xl d-flex justify-content-between">
                <div class="overview-content w-100">
                    <div class="ap-po-details-content d-flex flex-wrap justify-content-between">
                        <div class="ap-po-details__titlebar">
                            <h1>{{ $expiredEvent }}</h1>
                            <p>Expired Event</p>
                        </div>
                        <div class="ap-po-details__icon-area">
                            <div class="svg-icon order-bg-opacity-danger color-danger">
                                <i class="uil uil-calendar-times"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
