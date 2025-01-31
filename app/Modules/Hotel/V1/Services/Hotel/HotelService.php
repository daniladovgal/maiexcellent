<?php

namespace App\Modules\Hotel\V1\Services\Hotel;

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
        $query = Hotel::query();

        if (is_string($dto->search)) {
            $query->where('id', $dto->search)
                ->orWhere('address', 'like', '%' . $dto->search . '%')
                ->orWhere('code', 'like', '%' . $dto->search . '%');
        }

        return $query->orderBy('id', $dto->sortOrder->value)->cursorPaginate(6);
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
