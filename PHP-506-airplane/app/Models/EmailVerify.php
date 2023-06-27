<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailVerify extends Model
{
    use HasFactory;
    protected $table = 'email_verify';
    protected $primaryKey = 'u_no';
    protected $fillable = ['u_no'];

    public $timestamps = false;
    protected $dates = ['deleted_at'];
}
