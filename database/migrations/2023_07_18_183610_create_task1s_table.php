<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('task1s', function (Blueprint $table) {
            $table->id();
            $table->string('packet_id');
            $table->string('device_id');
            $table->string('sensometer_id');
            $table->timestamp('device_timestamp');
            $table->unsignedInteger('sensor_id');
            $table->unsignedInteger('slave_address');
            $table->float('value', 8, 1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task1s');
    }
};
