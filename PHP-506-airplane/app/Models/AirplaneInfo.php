<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirplaneInfo extends Model
{
    use HasFactory;
    protected $table = 'airplane_info';
    protected $primaryKey = 'plane_no';
}
