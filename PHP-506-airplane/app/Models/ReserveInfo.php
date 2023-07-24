<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReserveInfo extends Model
{
    use HasFactory;
    protected $table = 'reserve_info';
    protected $primaryKey = 'reserve_no';

    protected $fillable = [
        'u_no'
        ,'seat_no'
        ,'fly_no'
        ,'plane_no'
        ,'p_name'
        ,'p_gender'
        ,'p_birth'
    ];

    public $timestamps = false;
}
