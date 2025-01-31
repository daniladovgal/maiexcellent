<?php

namespace App\Modules\Region\V1\Models;

use App\Common\V1\Models\Model;

class Region extends Model
{
    protected $fillable = [
        'external_operator',
        'external_id',
        'code',
        'country',
    ];
}
