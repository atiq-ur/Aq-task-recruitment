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
        Schema::create('task2s', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('packet_id');
            $table->unsignedBigInteger('device_id');
            $table->unsignedInteger('sensometer_id');
            $table->timestamp('device_timestamp');
            $table->unsignedInteger('data_count');
            $table->unsignedInteger('meter_param_id');
            $table->unsignedInteger('meter_id');
            $table->unsignedInteger('phase');
            $table->string('sensor_type');
            $table->string('type');
            $table->float('value', 8, 1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task2s');
    }
};
