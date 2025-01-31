<?php

namespace App\Modules\Synchronize\V1\Services\Synchronize\Adapters;

class Hotel
{
    public function __construct(
        public readonly int $id,
        public readonly string $code,
        public readonly float $lat,
        public readonly float $lng,
        public readonly string $address,
    ) {
    }
}
