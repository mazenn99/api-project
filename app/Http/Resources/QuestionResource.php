<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
            'title'       => $this->title,
            'description' => $this->description,
            'tags'        => $this->tags,
            'closed'      => $this->closed,
            'category'    => $this->category,
            'points'      => $this->points,
        ];
    }
}
