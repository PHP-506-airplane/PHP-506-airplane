<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class MinAge implements Rule
{
    protected $minAge;

    public function __construct($minAge)
    {
        $this->minAge = $minAge;
    }

    public function passes($attribute, $value)
    {
        $date = Carbon::createFromFormat('Y-m-d', $value);
        $minAgeDate = Carbon::now()->subYears($this->minAge);

        return $date->lessThanOrEqualTo($minAgeDate);
    }

    public function message()
    {
        return '가입은 14세 이상만 가능합니다.';
    }
}
