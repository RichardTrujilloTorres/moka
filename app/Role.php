<?php

namespace App;

use App\Traits\Nameable;
use Laravel\Scout\Searchable;
use OwenIt\Auditing\Contracts\Auditable;

class Role extends \Spatie\Permission\Models\Role implements Auditable
{
    use \OwenIt\Auditing\Auditable, Searchable, Nameable;

    protected $appends = [
        'resourceName',
    ];
}
