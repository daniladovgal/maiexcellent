<?php

namespace App\Common\V1\Helpers;

class FilterHelper
{
    /**
     * @param array $value
     * @return array
     */
    public static function getDefinedData(array $value): array
    {
        return array_filter($value, function ($field) {
            return $field !== Type::UNDEFINED;
        });
    }
}
