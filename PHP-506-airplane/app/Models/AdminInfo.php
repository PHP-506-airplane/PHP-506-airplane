<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminInfo extends Authenticatable
{
    use HasFactory;
    protected $table = 'admin_info';
    protected $primaryKey = 'adm_no';

    protected $guarded = ['adm_no', 'created_at'];
    protected $dates = ['deleted_at'];
}
