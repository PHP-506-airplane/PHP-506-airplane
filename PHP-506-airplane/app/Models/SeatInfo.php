<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeatInfo extends Model
{
    use HasFactory;
    protected $table = 'seat_info';
    protected $primaryKey = 'seat_no';

    protected $casts = [
        'seat_no' => 'string'
    ];

    public $timestamps = false;
}
