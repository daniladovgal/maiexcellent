<?php

namespace App\Modules\Synchronize\V1\Services\Synchronize\Adapters;

use App\Common\V1\Enums\ExternalOperatorEnum;

class AdapterFactory
{
    protected $map;

    public function __construct()
    {
        $this->map = [
            ExternalOperatorEnum::MAIEXCELLENT->value => MaiexcellentAdapter::class,
        ];
    }

    public function build(ExternalOperatorEnum $operator): AdapterInterface
    {
        if (!$this->map[$operator->value]) {
            return app()->make(MaiexcellentAdapter::class);
        }
        return app()->make($this->map[$operator->value]);
    }
}
