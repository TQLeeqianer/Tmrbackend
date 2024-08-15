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
        if (Schema::hasTable('events')){
            Schema::table('events', function (Blueprint $table) {
                $table->string('event_address_1')->default('');
                $table->string('event_address_2')->default('');
                $table->string('event_postal_code')->default('');
                $table->string('event_map_image')->default('');
            });

        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
