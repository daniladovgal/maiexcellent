<?php

namespace App\Common\V1\Services\Maiexcellent;

class Hotel
{
    public function __construct(
        public readonly int $id,
        public readonly string $code,
        public readonly float $latitude,
        public readonly float $longitude,
        public readonly string $address1,
        public readonly string $address2,
        public readonly string $address3,
    ) {
    }
}
