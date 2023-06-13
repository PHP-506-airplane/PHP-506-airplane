<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// SoftDeletes를 사용
use Illuminate\Database\Eloquent\SoftDeletes;

class NoticeInfo extends Model
{
    use HasFactory, softDeletes;
    protected $table = 'notice_info';

    // 갱신되지않게 블랙리스트 설정
    protected $guarded = ['id', 'created_at'];

    protected $dates = ['deleted_at'];
}
