<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task1 extends Model
{
    use HasFactory;

    protected $fillable = [
        'packet_id',
        'device_id',
        'sensometer_id',
        'device_timestamp',
        'sensor_id',
        'slave_address',
        'value'
    ];
}
