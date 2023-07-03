<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class MinAge implements Rule
{
    protected $minAge;  //최소나이를 저장하기 위한 변수

    public function __construct($minAge)
    {
        $this->minAge = $minAge;    //최소나이를 매개변수로 받아서 $minAge에 할당
    }

    public function passes($attribute, $value)  //주어진 날짜 값이 최소 나이 이상인지 확인
    {
        $date = Carbon::createFromFormat('Y-m-d', $value);  // 'Y-M-d'형식으로 
        $minAgeDate = Carbon::now()->subYears($this->minAge);   //현재 날짜에서 최소 나이만큼의 연도를 빼서 계산

        return $date->lessThanOrEqualTo($minAgeDate);   //date가 minAgeDate보다 작거나 같은지 확인, 최소 나이 이상이면 true, 아니면 false
    }

    public function message()
    {
        return '가입은 만14세 이상부터 가능합니다.';
    }
}
