<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FlightInfo extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'flight_info';
    protected $primaryKey = 'fly_no';
    public $timestamps = false;
}
