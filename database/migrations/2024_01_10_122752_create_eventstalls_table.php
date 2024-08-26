<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_stall', function (Blueprint $table) {
            $table->id('stall_id');
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('time_slot_id');
            $table->decimal('price', 8, 2);
            $table->string('category');
            $table->string('stall_type');
            $table->integer('stall_count');
            $table->date('date_from');
            $table->date('date_to');
            $table->time('time_from');
            $table->time('time_to');
            $table->unsignedBigInteger('stall_owner_id')->nullable(); // null able
            $table->integer('status');
            $table->timestamp('booked_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_stall');
    }
};
