<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayAuth extends Model
{
    use HasFactory;
    protected $table = 'pay_auth';
    public $timestamps = false;
    protected $fillable = [
        'merchant_uid',
    ];
}
