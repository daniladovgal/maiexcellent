<?php

namespace App\Modules\Hotel\V1\Services\Hotel\Dto;

use App\Common\V1\Enums\ExternalOperatorEnum;

class CreateHotelDto
{
    public function __construct(
        public readonly ExternalOperatorEnum $externalOperator,
        public readonly string $externalId,
        public readonly string $code,
        public readonly float $lat,
        public readonly float $lng,
        public readonly string $address,
    ) {
    }
}
