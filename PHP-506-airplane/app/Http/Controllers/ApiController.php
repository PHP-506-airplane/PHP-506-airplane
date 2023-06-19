<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    // public function userGet() { 
    //     $arrGet = $_GET;
    //     $arrData = [ "flg" => "0" ]; //flg라는 key의 값을 0으로 설정(=>의 기능)
    //     // model 호출
    //     $this->model = $this->getModel("User");

    //     $result = $this->model->getUser($arrGet, false);    //Model에서의 두번째를 false로 변경->작동 안함

    //     //유저 유무 체크
    //     if(count($result) == ""){
    //         $arrData["flg"] ="0";
    //         $arrData["msg"] = "Email을 입력하세요.";
    //     }elseif(count($result) !== 0) {
    //         $arrData["flg"] ="1"; 
    //         $arrData["msg"] = "입력하신 email가 사용중입니다.";
    //     }

    //     // 배열을 JSON으로 변경
    //     // json_encode : php array 또는 string 등을 JSON 문자열로 변환하는 php함수
    //     $json = json_encode($arrData);
    //     header('Content-type: application/json');
    //     echo $json;
    //     exit();
    // }
}
