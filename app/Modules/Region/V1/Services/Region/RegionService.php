<?php

namespace App\Modules\Region\V1\Services\Region;

use App\Common\V1\Enums\ExternalOperatorEnum;
use App\Modules\Region\V1\Models\Region;
use App\Modules\Region\V1\Services\Region\Dto\CreateRegionDto;
use Illuminate\Support\Collection;

class RegionService
{
    public function __construct() {}

    public function getByOperator(ExternalOperatorEnum $operator): Collection
    {
        return Region::where('external_operator', $operator)->get();
    }

    public function create(CreateRegionDto $dto): Region
    {
        $region = Region::firstOrCreate([
            'code' => $dto->code,
        ], [
            'external_operator' => $dto->externalOperator,
            'external_id' => $dto->externalId,
            'country' => $dto->country,
        ]);

        return $region;
    }

    /**
     * @param Collection<CreateRegionDto> $users
     */
    public function createMany(Collection $dtos): void
    {
        foreach ($dtos as $dto) {
            $this->create($dto);
        }
    }
}
