<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\SalesOrderController;
use App\Http\Controllers\StallController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'event', 'as' => 'event.'], function () {
        Route::get('list', [EventController::class, 'index'])->name('event_list');
        Route::get('event-detail', [EventController::class, 'eventDetail'])->name('event_detail');
        Route::get('active-list', [EventController::class, 'activeEventList'])->name('event_active_list');
        Route::post('store', [EventController::class, 'store'])->name('store_event');
        Route::get('info/{id}', [EventController::class, 'editEvent'])->name('event_detail_json');
        Route::put('info/{id}', [EventController::class, 'updateEvent'])->name('update_event');
        Route::delete('{id}', [EventController::class, 'removeEvent'])->name('delete_event');
        Route::get('stall-list/{id}', [EventController::class, 'stallList'])->name('stall_list');
        Route::put('event_stall/update/{id}', [EventController::class, 'eventStallUpdate']);
        Route::delete('/event_stall/remove/{id}', [EventController::class, 'eventStalldestroy']);
    });

    Route::group(['prefix' => 'stall', 'as' => 'stall.'], function () {
        Route::get('list', [StallController::class, 'index'])->name('stall_list');
        Route::get('stall-detail', [StallController::class, 'stallDetail'])->name('stall_detail');
        Route::get('info/{id}', [StallController::class, 'editStall'])->name('stall_detail_json');
        Route::put('info/{id}', [StallController::class, 'updateStall'])->name('update_stall');
        Route::post('store', [StallController::class, 'store'])->name('store_stall');
        Route::delete('{id}', [StallController::class, 'removeStall'])->name('delete_stall');
    });

    // User management routes
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('list', [UserController::class, 'index'])->name('user_list');
        Route::get('user-detail/{id}', [UserController::class, 'show'])->name('user_detail');
        Route::get('create', [UserController::class, 'create'])->name('create_user');
        Route::post('store', [UserController::class, 'store'])->name('store_user');
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('edit_user');
        Route::put('update/{id}', [UserController::class, 'update'])->name('update_user');
        Route::delete('delete/{id}', [UserController::class, 'destroy'])->name('delete_user');
    });

    Route::group(['prefix' => 'sales_orders', 'as' => 'sales_orders.'], function () {
        //Update sales order status
        Route::post('update-status', [SalesOrderController::class, 'updateStatus'])->name('update_status');

        //Save sales order
        Route::post('save', [SalesOrderController::class, 'saveSalesOrder'])->name('save');


        // Display the list of sales orders
        Route::get('/', [SalesOrderController::class, 'index'])->name('index');

        // Handle the creation of a new sales order
        Route::post('store', [SalesOrderController::class, 'store'])->name('store');

        // Handle the update of an existing sales order
        Route::post('update', [SalesOrderController::class, 'update'])->name('update');

        // Handle the deletion of a sales order
        Route::get('remove/{salesOrder}', [SalesOrderController::class, 'destroy'])->name('destroy');

        Route::post('/list', [SalesOrderController::class, 'getSalesOrderList'])->name('list');
        Route::get('/events', [SalesOrderController::class, 'getEventList'])->name('events');
        Route::get('/timeslots', [SalesOrderController::class, 'getTimeslots'])->name('timeslots');
        Route::get('/stalls', [SalesOrderController::class, 'getStalls'])->name('stalls');

//        Route::get('/events/{eventId}/timeslots', [SalesOrderController::class, 'getTimeslots']);
        Route::get('/timeslots/{time_slot_id}/event_stalls', [SalesOrderController::class, 'getEventStall']);

        //Search customer
        Route::post('/search-customer', [SalesOrderController::class, 'searchCustomer'])->name('search_customer');

    });
});
