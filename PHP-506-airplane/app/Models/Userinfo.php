<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Userinfo extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'u_no';
    protected $fillable = [
        'u_name',
        'u_email',
        'u_pw',
        'u_birth',
        'u_gender',
        'qa_no',
        'qa_answer'
    ];

    protected $hidden = [
        'u_pw',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = 'user_info';
}
