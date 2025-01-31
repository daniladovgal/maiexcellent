<?php

namespace App\Common\V1\Services\Maiexcellent;

use App\Common\V1\Facades\Facade;

class MaiexcellentFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'maiexcellent';
    }
}
