<?php

namespace App\Common\V1\Services\Maiexcellent;

class Subregion
{
    public function __construct(
        public readonly int $id,
        public readonly string $code,
        public readonly int $regionId,
    ) {
    }
}
