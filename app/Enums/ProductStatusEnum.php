<?php

namespace App\Enums;

enum ProductStatusEnum: string
{
    case Available = 'Available';
    case SoldOut = 'SoldOut';
    case FewLeft = 'FewLeft';

    public static function getStatus($quantity){
        if($quantity >= 10){ return self::Available;}
        elseif($quantity == 0){ return self::SoldOut;}
        elseif($quantity < 10){ return self::FewLeft;}
    }
}
