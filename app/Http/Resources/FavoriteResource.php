<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'story'                => new StoriesResource($this->stories),
            'readed'               => $this->readed,
            'added_to_favorite_at' => $this->created_at,
        ];
    }
}
