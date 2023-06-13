<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Userinfo extends Model
{
    use HasFactory, SoftDeletes;

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
