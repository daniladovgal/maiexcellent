<?php

namespace App\Common\V1\Utils;

use Closure;
use Illuminate\Support\Facades\DB;
use Throwable;

trait Transaction
{
    public function transaction(Closure $callback)
    {
        DB::beginTransaction();

        try {
            $callbackResult = $callback($this);
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return $callbackResult;
    }
}
