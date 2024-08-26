<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesOrderStallsTable extends Migration
{
    public function up()
    {
        Schema::create('sales_order_stalls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sales_order_id');
            $table->unsignedBigInteger('stall_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sales_order_stalls');
    }
}

