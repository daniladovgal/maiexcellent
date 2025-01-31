<?php

namespace App\Common\V1\Http\Requests;

use App\Common\V1\Helpers\Type;
use Illuminate\Foundation\Http\FormRequest as HttpFormRequest;

class FormRequest extends HttpFormRequest
{
    /**
     * Retrieve an input item from the request.
     *
     * @param  string|null  $key
     * @param  mixed  $default
     * @return mixed
     */

    public function input($key = null, $default = null): mixed
    {
        return data_get(
            $this->getInputSource()->all() + $this->query->all(),
            $key,
            Type::UNDEFINED,
        );
    }

    public function validated($key = null, $default = Type::UNDEFINED)
    {
        return parent::validated($key, $default);
    }
}
