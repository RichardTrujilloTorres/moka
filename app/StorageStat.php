<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StorageStat extends Model
{
    protected $fillable = [
        'name',
        'type',
        'size',
        'last_modified',
    ];
}
