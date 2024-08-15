<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\StallController;
use App\Http\Controllers\UserController; // Add this line to include UserController
use Illuminate\Support\Facades\Route;


/************************ Application Routes Start ******************************/
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

});
/************************ Application Routes Ends ******************************/
