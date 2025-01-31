<?php

namespace App\Common\V1\Http\Requests;

class PaginationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cursor' => 'string|nullable'
        ];
    }
}
