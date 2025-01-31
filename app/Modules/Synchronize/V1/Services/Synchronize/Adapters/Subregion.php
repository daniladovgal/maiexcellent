<?php

namespace App\Modules\Synchronize\V1\Services\Synchronize\Adapters;

class Subregion
{
    public function __construct(
        public readonly int $id,
        public readonly string $code,
        public readonly int $regionId,
    ) {
    }
}
