<?php

namespace App\Modules\Synchronize\V1\Services\Synchronize\Adapters;

class Region
{
    public function __construct(
        public readonly string $id,
        public readonly string $code,
        public readonly string $country,
    ) {
    }
}
