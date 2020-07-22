<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class AuditResource extends JsonResource
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
            'event' => $this->event,
            'old_values' => $this->old_values,
            'new_values' => $this->new_values,
            $this->mergeWhen(Auth::user()->isAdmin(), [
                'url' => $this->url,
                'ip_address' => $this->ip_address,
                'user_agent' => $this->user_agent,
            ]),
        ];
    }
}
