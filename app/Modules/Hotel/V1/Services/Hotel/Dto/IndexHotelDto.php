<?php

namespace App\Modules\Hotel\V1\Services\Hotel\Dto;

use App\Common\V1\Enums\SortOrderEnum;
use App\Common\V1\Helpers\Type;

class IndexHotelDto
{
    public function __construct(
        public readonly SortOrderEnum $sortOrder = SortOrderEnum::DESC,
        public readonly string|Type $search = Type::UNDEFINED,
    ) {}
}
