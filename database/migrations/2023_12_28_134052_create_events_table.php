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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('detail');
            $table->string('status');
            $table->string('person_in_charge');
            $table->string('sponsor');
            $table->string('file_path')->nullable();
            $table->string('location');
            // $table->string('postal_code');
            // $table->string('address1');
            // $table->string('address2');
            $table->date('start_date');
            $table->date('end_date');
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->string('image')->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
};
