<?php

namespace App\Common\V1\Pagination;

use Illuminate\Pagination\CursorPaginator as BaseCursorPaginator;

class CursorPaginator extends BaseCursorPaginator
{
    protected $total = null;

    public function setTotal(int|null $value): static
    {
        $this->total = $value;
        return $this;
    }

    public function total(): int|null
    {
        return $this->total;
    }
}
