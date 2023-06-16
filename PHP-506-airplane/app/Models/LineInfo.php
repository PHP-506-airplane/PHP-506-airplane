<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineInfo extends Model
{
    use HasFactory;
    protected $table = 'airline_info';
    protected $primaryKey = 'line_no';
}
