<?php

namespace App;

use App\Traits\Nameable;
use Laravel\Scout\Searchable;
use OwenIt\Auditing\Contracts\Auditable;

class Permission extends \Spatie\Permission\Models\Permission implements Auditable
{
    use \OwenIt\Auditing\Auditable, Searchable, Nameable;

    protected $appends = [
        'resourceName',
    ];
}
