<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightInfo extends Model
{
    use HasFactory;
    protected $table = 'flight_info';
    protected $primaryKey = 'fly_no';
    public $timestamps = false;
}
