<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketInfo extends Model
{
    use HasFactory;
    protected $table = 'ticket_info';
    protected $primaryKey = 't_no';

    public $timestamps = false;
}
