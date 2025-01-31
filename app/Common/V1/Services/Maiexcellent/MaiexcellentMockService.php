<?php

namespace App\Common\V1\Services\Maiexcellent;

use Illuminate\Support\Collection;

class MaiexcellentMockService
{
    private int|null $operatorId = 1;

    public function __construct(
        private readonly string $username,
        private readonly string $password,
    ) {
    }

    private function getOperatorId(): int
    {
        return $this->operatorId;
    }

    public function getHotels(): Collection
    {
        $collection = collect();
        for ($i = 1; $i <= 10; $i++) {
            $collection->push(new Hotel(
                id: $i,
                code: $i,
                latitude: 10,
                longitude: 10,
                address1: 'Line 1',
                address2: 'Line 2',
                address3: 'Line 3',
            ));
        }

        return $collection;
    }

    public function getRegions(): Collection
    {
        $collection = collect();
        for ($i = 1; $i <= 10; $i++) {
            $collection->push(new Region(
                id: $i,
                code: $i,
                country: 'Country',
            ));
        }

        return $collection;
    }

    public function getSubregions(): Collection
    {
        $collection = collect();
        for ($i = 1; $i <= 10; $i++) {
            $collection->push(new Subregion(
                id: $i,
                code: $i,
                regionId: $i,
            ));
        }

        return $collection;
    }
}
