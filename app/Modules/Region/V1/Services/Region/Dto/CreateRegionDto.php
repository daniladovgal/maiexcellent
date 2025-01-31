<?php

namespace App\Modules\Region\V1\Services\Region\Dto;

use App\Common\V1\Enums\ExternalOperatorEnum;

class CreateRegionDto
{
    public function __construct(
        public readonly ExternalOperatorEnum $externalOperator,
        public readonly string $externalId,
        public readonly string $code,
        public readonly string $country
    ) {
    }
}
