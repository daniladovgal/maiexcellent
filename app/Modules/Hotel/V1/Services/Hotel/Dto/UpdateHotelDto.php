<?php

namespace App\Modules\Hotel\V1\Services\Hotel\Dto;

use App\Common\V1\Enums\ExternalOperatorEnum;
use App\Common\V1\Helpers\Type;

class UpdateHotelDto
{
    public function __construct(
        public readonly int $id,
        public readonly ExternalOperatorEnum|Type $externalOperator = Type::UNDEFINED,
        public readonly string|Type $externalId = Type::UNDEFINED,
        public readonly string|Type $code = Type::UNDEFINED,
        public readonly float|Type $lat = Type::UNDEFINED,
        public readonly float|Type $lng = Type::UNDEFINED,
        public readonly string|Type $address = Type::UNDEFINED,
    ) {
    }
}
