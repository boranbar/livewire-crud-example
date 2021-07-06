<?php

namespace App\Http\Traits;
use Hashids;

trait Hashidable
{
    public function getRouteKey()
    {
        return Hashids::connection(get_called_class())->encode($this->getKey());
    }
}
