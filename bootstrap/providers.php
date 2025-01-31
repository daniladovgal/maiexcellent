<?php

use App\Common\V1\Providers\AppServiceProvider;
use App\Common\V1\Providers\MaiexcellentServiceProvider;
use App\Common\V1\Providers\TelescopeServiceProvider;

return [
    AppServiceProvider::class,
    TelescopeServiceProvider::class,
    MaiexcellentServiceProvider::class,
];
