<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AdminPageMiddleware;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // 미들웨어로 관리자권한 체크
    public function __construct()
    {
        $this->middleware(AdminPageMiddleware::class);
    }

    public function index() {
        return view('admin');
    }
}
