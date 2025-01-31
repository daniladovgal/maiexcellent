<?php

namespace App\Modules\Hotel\V1\Services\Hotel;

use App\Common\V1\Enums\SortOrderEnum;
use App\Modules\Hotel\V1\Models\Hotel;
use App\Modules\Hotel\V1\Services\Hotel\Dto\CreateHotelDto;
use App\Modules\Hotel\V1\Services\Hotel\Dto\IndexHotelDto;
use Illuminate\Pagination\CursorPaginator;
use Illuminate\Support\Collection;

class HotelService
{
    public function __construct() {}

    public function index(IndexHotelDto $dto): CursorPaginator
    {
        return Hotel::orderBy('id', $dto->sortOrder->value)->cursorPaginate(5);
    }

    public function create(CreateHotelDto $dto): Hotel
    {
        $hotel = Hotel::firstOrCreate([
            'code' => $dto->code,
        ], [
            'external_operator' => $dto->externalOperator,
            'external_id' => $dto->externalId,
            'address' => $dto->address,
            'lat' => $dto->lat,
            'lng' => $dto->lng,
        ]);

        return $hotel;
    }

    /**
     * @param Collection<CreateHotelDto> $users
     */
    public function createMany(Collection $dtos): void
    {
        foreach ($dtos as $dto) {
            $this->create($dto);
        }
    }
}
