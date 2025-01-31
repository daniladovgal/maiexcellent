<?php

namespace App\Common\V1\Services\Maiexcellent;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class MaiexcellentService
{
    private int|null $operatorId = null;

    public function __construct(
        private readonly string $username,
        private readonly string $password,
    ) {
    }

    private function getOperatorId(): int
    {
        if ($this->operatorId) {
            return $this->operatorId;
        }

        $url = 'http://online.catttour.com/Sednaapi/api/Integration/AgencyLogin';

        $response = Http::withUrlParameters(
            [
                'username' => $this->username,
                'password' => $this->password
            ]
        )->get($url);

        $data = $response->json();

        $this->operatorId = $data->RecId;

        return $this->operatorId;
    }

    public function getHotels(): Collection
    {
        $url = 'http://online.catttour.com/Sednaapi/api/Integratiion/GetHotelList';

        $response = Http::withUrlParameters(
            [
                'operatorId' => $this->getOperatorId(),
                'isActive' => true,
            ]
        )->get($url);

        $data = $response->json();

        $collection = collect();
        foreach ($data as $hotel) {
            $collection->push(new Hotel(
                id: $hotel->Id,
                code: $hotel->Code,
                latitude: $hotel->Latitude,
                longitude: $hotel->Longitude,
                address1: $hotel->Address1,
                address2: $hotel->Address2,
                address3: $hotel->Address3,
            ));
        }

        return $collection;
    }

    public function getRegions(): Collection
    {
        $url = 'http://online.catttour.com/Sednaapi/api/Integratiion/GetMainRegions';

        $response = Http::withUrlParameters(
            [
                'operatorId' => $this->getOperatorId(),
            ]
        )->get($url);

        $data = $response->json();

        $collection = collect();
        foreach ($data as $region) {
            $collection->push(new Region(
                id: $region->Id,
                code: $region->Code,
                country: $region->Country,
            ));
        }

        return $collection;
    }

    public function getSubregions(): Collection
    {
        $url = 'http://online.catttour.com/Sednaapi/api/Integratiion/GetSubRegions';

        $response = Http::withUrlParameters(
            [
                'operatorId' => $this->getOperatorId(),
            ]
        )->get($url);

        $data = $response->json();

        $collection = collect();
        foreach ($data as $subregion) {
            $collection->push(new Subregion(
                id: $subregion->Id,
                code: $subregion->Code,
                regionId: $subregion->MainRegionId,
            ));
        }

        return $collection;
    }
}
