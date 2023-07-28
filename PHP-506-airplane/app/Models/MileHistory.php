<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MileHistory extends Model
{
    use HasFactory;
    protected $table = 'mile_history';
    protected $primaryKey = 'u_no';
    protected $fillable = [
        'u_no'
        ,'mile_his'
    ];
}
