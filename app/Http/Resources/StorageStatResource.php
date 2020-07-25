<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class StorageStatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'size' => $this->sizeInKB($this->size),
            'lastModifiedAt' => $this->last_modified,
        ];
    }

    protected function sizeInKB(int $size)
    {
        return round(($size / 1000), 2);
    }
}
