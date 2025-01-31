<?php

namespace App\Modules\Synchronize\V1\Services\Synchronize\Adapters;

use Illuminate\Support\Collection;

interface AdapterInterface
{
    public function getRegions(): Collection;
    public function getSubregions(): Collection;
    public function getHotels(): Collection;
}
