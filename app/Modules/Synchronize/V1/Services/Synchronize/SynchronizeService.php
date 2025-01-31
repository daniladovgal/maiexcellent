<?php

namespace App\Modules\Synchronize\V1\Services\Synchronize;

use App\Common\V1\Enums\ExternalOperatorEnum;
use App\Modules\Hotel\V1\Services\Hotel\Dto\CreateHotelDto;
use App\Modules\Hotel\V1\Services\Hotel\HotelService;
use App\Modules\Region\V1\Services\Region\Dto\CreateRegionDto;
use App\Modules\Region\V1\Services\Region\RegionService;
use App\Modules\Region\V1\Services\Subregion\Dto\CreateSubregionDto;
use App\Modules\Region\V1\Services\Subregion\SubregionService;
use App\Modules\Synchronize\V1\Services\Synchronize\Adapters\AdapterFactory;

class SynchronizeService
{
    public function __construct(
        private readonly RegionService $regionService,
        private readonly SubregionService $subregionService,
        private readonly HotelService $hotelService,
        private readonly AdapterFactory $adapterFactory,
    ) {}

    public function synchronize(ExternalOperatorEnum $operator): void
    {
        $this->synchronizeRegions($operator);
        $this->synchronizeSubregions($operator);
        $this->synchronizeHotels($operator);
    }

    private function synchronizeRegions(ExternalOperatorEnum $operator): void
    {
        $adapter = $this->adapterFactory->build($operator);
        $items = $adapter->getRegions();

        $dtos = collect();
        foreach ($items as $item) {
            $dtos->push(new CreateRegionDto(
                externalOperator: $operator,
                externalId: $item->id,
                code: $item->code,
                country: $item->country,
            ));
        }

        $this->regionService->createMany($dtos);
    }

    private function synchronizeSubregions(ExternalOperatorEnum $operator): void
    {
        $adapter = $this->adapterFactory->build($operator);
        $items = $adapter->getSubregions();

        $regions = $this->regionService->getByOperator($operator);

        $dtos = collect();
        foreach ($items as $item) {
            $region = $regions->first(function ($region) use ($item) {
                return $region->external_id == $item->regionId;
            });

            $dtos->push(new CreateSubregionDto(
                externalOperator: $operator,
                regionId: $region->id,
                externalId: $item->id,
                code: $item->code,
            ));
        }

        $this->subregionService->createMany($dtos);
    }

    private function synchronizeHotels(ExternalOperatorEnum $operator): void
    {
        $adapter = $this->adapterFactory->build($operator);
        $items = $adapter->getHotels();

        $dtos = collect();
        foreach ($items as $item) {
            $dtos->push(new CreateHotelDto(
                externalOperator: $operator,
                externalId: $item->id,
                code: $item->code,
                address: $item->address,
                lat: $item->lat,
                lng: $item->lng,
            ));
        }

        $this->hotelService->createMany($dtos);
    }
}
