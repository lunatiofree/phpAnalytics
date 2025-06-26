<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WebsiteResource extends JsonResource
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
            'id' => $this->id,
            'domain' => $this->domain,
            'privacy' => $this->privacy,
            'email' => $this->email,
            'password' => ($this->password ? true : false),
            'exclude_bots' => $this->exclude_bots,
            'exclude_ips' => $this->exclude_ips,
            'favorite' => $this->favorited_at ? true : false,
            'favorited_at' => $this->favorited_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    /**
     * Get any additional data that should be returned with the resource array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        return [
            'status' => 200
        ];
    }
}
