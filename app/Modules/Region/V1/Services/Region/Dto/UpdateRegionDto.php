<?php

namespace App\Modules\Region\V1\Services\Region\Dto;

use App\Common\V1\Enums\ExternalOperatorEnum;
use App\Common\V1\Helpers\Type;

class UpdateRegionDto
{
    public function __construct(
        public readonly int $id,
        public readonly ExternalOperatorEnum|Type $externalOperator = Type::UNDEFINED,
        public readonly string|Type $code = Type::UNDEFINED,
        public readonly string|type $country = Type::UNDEFINED,
    ) {
    }
}
