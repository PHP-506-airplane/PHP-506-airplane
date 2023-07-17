<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailVerify extends Model
{
    use HasFactory;
    protected $table = 'regist_verify';
    protected $primaryKey = 'u_no';
    protected $fillable = [
        'u_no'
        ,'verification_code'
        ,'validity_period'
        ,'email_verified_at'
    ];

    public $timestamps = false;
}
