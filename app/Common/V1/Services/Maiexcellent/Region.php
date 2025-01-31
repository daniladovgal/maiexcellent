<?php

namespace App\Common\V1\Services\Maiexcellent;

class Region
{
    public function __construct(
        public readonly string $id,
        public readonly string $code,
        public readonly string $country,
    ) {
    }
}
