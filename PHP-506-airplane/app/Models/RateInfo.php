<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RateInfo extends Model
{
    use HasFactory;
    protected $table = 'rate_info';
    protected $primaryKey = 'rate_no';
    public $timestamps = false;
}
