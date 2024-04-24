<?php

namespace App\Enums\Employee;


use App\Supports\Enum;
enum EmployeeRole: int
{
    use Enum;
    case QuanLy = 1;
    case NhanVien = 2;

}

