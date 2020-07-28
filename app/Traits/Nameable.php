<?php

namespace App\Traits;

trait Nameable
{
    public function getResourceNameAttribute()
    {
        return (new \ReflectionClass(get_class($this)))->getShortName();
    }
}
