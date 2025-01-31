<?php

namespace App\Modules\Synchronize\V1\Services\Synchronize\Adapters;

use App\Common\V1\Services\Maiexcellent\MaiexcellentFacade;
use Illuminate\Support\Collection;

class MaiexcellentAdapter implements AdapterInterface
{
    public function getRegions(): Collection
    {
        $regions = MaiexcellentFacade::getRegions();

        $collection = collect();
        foreach ($regions as $region) {
            $collection->push(new Region(
                id: $region->id,
                code: $region->code,
                country: $region->country,
            ));
        }

        return $collection;
    }

    public function getSubregions(): Collection
    {
        $subregions = MaiexcellentFacade::getSubregions();

        $collection = collect();
        foreach ($subregions as $subregion) {
            $collection->push(new Subregion(
                id: $subregion->id,
                code: $subregion->code,
                regionId: $subregion->regionId,
            ));
        }

        return $collection;
    }

    public function getHotels(): Collection
    {
        $hotels = MaiexcellentFacade::getHotels();

        $collection = collect();
        foreach ($hotels as $hotel) {
            $collection->push(new Hotel(
                id: $hotel->id,
                code: $hotel->code,
                lat: $hotel->latitude,
                lng: $hotel->longitude,
                address: $hotel->address1 . ' ' . $hotel->address2 . ' ' . $hotel->address3,
            ));
        }

        return $collection;
    }
}
