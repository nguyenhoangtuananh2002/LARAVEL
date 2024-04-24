<?php

namespace App\Enums\Employee;


use App\Supports\Enum;
enum EmployeeGender: int
{
    use Enum;

    case Nam = 1;
    case Nu = 2;
    case Khac = 3;


}
