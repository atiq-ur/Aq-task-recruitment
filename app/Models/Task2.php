<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task2 extends Model
{
    use HasFactory;

    protected $fillable = [
        'packet_id',
        'device_id',
        'sensometer_id',
        'device_timestamp',
        'data_count',
        'meter_param_id',
        'meter_id',
        'phase',
        'sensor_type',
        'type',
        'value',
    ];
}
