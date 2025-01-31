<?php

namespace App\Modules\Region\V1\Models;

use App\Common\V1\Models\Model;

class Subregion extends Model
{
    protected $fillable = [
        'region_id',
        'external_operator',
        'external_id',
        'code',
    ];
}
