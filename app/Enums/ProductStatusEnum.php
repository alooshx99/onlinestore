<?php

namespace App\Enums;

enum ProductStatusEnum: string
{
    case Draft = 'draft';
    case Scheduled = 'scheduled';
    case Published = 'published';

}
