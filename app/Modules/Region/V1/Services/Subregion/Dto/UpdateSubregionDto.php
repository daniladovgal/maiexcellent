<?php

namespace App\Modules\Region\V1\Services\Subregion\Dto;

use App\Common\V1\Helpers\Type;

class UpdateSubregionDto
{
    public function __construct(
        public readonly int $id,
        public readonly int|Type $regionId = Type::UNDEFINED,
        public readonly string|Type $externalId = Type::UNDEFINED,
        public readonly string|Type $code = Type::UNDEFINED,
    ) {
    }
}
