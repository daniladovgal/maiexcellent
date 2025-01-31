<?php

namespace App\Common\V1\Services\Maiexcellent;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class MaiexcellentService
{
    private int|null $recId = null;

    public function __construct(
        private readonly string $username,
        private readonly string $password,
    ) {}

    private function getRecId(): int
    {
        if ($this->recId) {
            return $this->recId;
        }

        $url = 'http://online.catttour.com/Sednaapi/api/Integratiion/AgencyLogin';

        $response = Http::get($url, [
            'username' => $this->username,
            'password' => $this->password
        ]);

        $data = $response->json();

        $this->recId = $data['RecId'];

        return $this->recId;
    }

    public function getHotels(): Collection
    {
        $url = 'http://online.catttour.com/Sednaapi/api/Integratiion/GetHotelList?operatorId=' . $this->getRecId() . '&isActive=true';

        $response = Http::post($url);

        $data = $response->json();

        $collection = collect();
        foreach ($data as $hotel) {
            $collection->push(new Hotel(
                id: $hotel['Id'],
                code: $hotel['Code'],
                latitude: $hotel['Latitude'],
                longitude: $hotel['Longitude'],
                address1: $hotel['Address1'],
                address2: $hotel['Address2'],
                address3: $hotel['Address3'],
            ));
        }

        return $collection;
    }

    public function getRegions(): Collection
    {
        $url = 'http://online.catttour.com/Sednaapi/api/Integratiion/GetMainRegions?operatorId=' . $this->getRecId();

        $response = Http::post($url);

        $data = $response->json();

        $collection = collect();
        foreach ($data as $region) {
            $collection->push(new Region(
                id: $region['Id'],
                code: $region['Code'],
                country: $region['Country'],
            ));
        }

        return $collection;
    }

    public function getSubregions(): Collection
    {
        $url = 'http://online.catttour.com/Sednaapi/api/Integratiion/GetSubRegions?operatorId=' . $this->getRecId();

        $response = Http::post($url);

        $data = $response->json();

        $collection = collect();
        foreach ($data as $subregion) {
            $collection->push(new Subregion(
                id: $subregion['Id'],
                code: $subregion['Code'],
                regionId: $subregion['MainRegionId'],
            ));
        }

        return $collection;
    }
}
