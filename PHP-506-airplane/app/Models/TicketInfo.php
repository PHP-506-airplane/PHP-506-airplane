<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketInfo extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'ticket_info';
    protected $primaryKey = 't_no';

    protected $fillable = [
        'reserve_no'
        ,'t_price'
    ];

    public $timestamps = false;
}
