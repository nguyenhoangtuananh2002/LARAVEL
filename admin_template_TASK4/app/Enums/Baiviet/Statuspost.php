<?php
namespace App\Enums\Baiviet;
use App\Supports\Enum;
enum Statuspost: int
{
    use Enum;
    case XuatBan = 1;
    case Nhap = 2;
    public function badge(){
        return match($this) {
            Statuspost::XuatBan => 'bg-green',
            Statuspost::Nhap => '',
        };
    }
}
