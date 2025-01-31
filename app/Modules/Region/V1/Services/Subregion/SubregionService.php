<?php

namespace App\Modules\Region\V1\Services\Subregion;

use App\Modules\Region\V1\Models\Subregion;
use App\Modules\Region\V1\Services\Subregion\Dto\CreateSubregionDto;
use Illuminate\Support\Collection;

class SubregionService
{
    public function __construct() {}

    public function create(CreateSubregionDto $dto): Subregion
    {
        $subregion = Subregion::firstOrCreate([
            'code' => $dto->code,
        ], [
            'region_id' => $dto->regionId,
            'external_operator' => $dto->externalOperator,
            'external_id' => $dto->externalId,
        ]);

        return $subregion;
    }

    /**
     * @param Collection<CreateSubregionDto> $users
     */
    public function createMany(Collection $dtos): void
    {
        foreach ($dtos as $dto) {
            $this->create($dto);
        }
    }
}
