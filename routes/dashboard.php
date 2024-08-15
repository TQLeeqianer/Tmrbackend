<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

/************************ Dashboard Routes Start ******************************/
Route::group(['middleware'=>'auth'],function(){
    Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard.demo_one');
//    Route::group(['prefix'=>'{language}'],function(){
//        Route::group(['prefix'=>'dashboards','as'=>'dashboard.'],function(){
//            Route::get('demo-one',[DashboardController::class,'index'])->name('demo_one');
//        });
//    });
});
/************************ Dashboard Routes Ends ******************************/
