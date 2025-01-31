<?php

namespace App\Modules\Hotel\V1\Models;

use App\Common\V1\Models\Model;

class Hotel extends Model
{
    protected $fillable = [
        'external_operator',
        'external_id',
        'code',
        'address',
    ];
}
