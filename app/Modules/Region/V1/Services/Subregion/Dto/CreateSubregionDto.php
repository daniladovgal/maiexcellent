<?php

namespace App\Modules\Region\V1\Services\Subregion\Dto;

use App\Common\V1\Enums\ExternalOperatorEnum;

class CreateSubregionDto
{
    public function __construct(
        public readonly ExternalOperatorEnum $externalOperator,
        public readonly int $regionId,
        public readonly string $externalId,
        public readonly string $code,
    ) {
    }
}
