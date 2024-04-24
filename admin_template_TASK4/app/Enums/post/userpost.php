<?php
namespace App\Enums\post;
use App\Supports\Enum;
enum userpost: int
{
    use Enum;
    case Published = 1;
    case Draft = 2;
    public function badge(){
        return match($this) {
            userpost::Published => 'bg-green',
            userpost::Draft => '',
        };
    }
}
