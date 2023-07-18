<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mileage extends Model
{
    use HasFactory;
    protected $table = 'mileage';
    protected $primaryKey = 'u_no';
    public $timestamps = false;
    protected $fillable = [
        'u_no'
        ,'u_mile'
    ];
}
