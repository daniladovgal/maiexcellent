<?php

namespace App\Modules\Hotel\V1\Http\Requests\Hotel;

use App\Common\V1\Http\Requests\PaginationRequest;

class IndexHotelRequest extends PaginationRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            ...parent::rules(),
            'search' => 'string'
        ];
    }
}
