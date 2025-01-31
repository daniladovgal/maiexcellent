<?php

namespace App\Modules\Hotel\V1\Http\Controllers;

use App\Common\V1\Http\Controllers\Controller;
use App\Modules\Hotel\V1\Http\Requests\Hotel\IndexHotelRequest;
use App\Modules\Hotel\V1\Services\Hotel\Dto\IndexHotelDto;
use App\Modules\Hotel\V1\Services\Hotel\HotelService;

class HotelController extends Controller
{
    public function __construct(
        private readonly HotelService $hotelService
    ) {}

    public function index(IndexHotelRequest $request)
    {
        $paginator = $this->hotelService->index(new IndexHotelDto());

        return view('hotel.index', [
            'hotels' => $paginator,
            'pagination' => [
                'type' => 'cursor',
                'path' => $paginator->path(),
                'per_page' => $paginator->perPage(),
                'next_cursor' => $paginator->nextCursor()?->encode(),
                'next_page_url' => $paginator->nextPageUrl(),
                'prev_cursor' => $paginator->previousCursor()?->encode(),
                'prev_page_url' => $paginator->previousPageUrl(),
                'total' => $paginator->total() ?? null,
            ]
        ]);
    }
}
