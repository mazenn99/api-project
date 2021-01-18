<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticlesResource extends JsonResource
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
            'id'          => $this->id,
            'environment' => $this->environment,
            'specialize'  => $this->specialize,
            'companyName' => $this->companyName,
            'requirements'=> $this->requirements,
            'contactRule' => $this->contactRule,
            'period'      => $this->period,
            'num_Like'    => $this->numLikes,
            'description' => $this->description,
            'category'    => $this->category,
            'title'       => $this->title,
            'tags'        => $this->tags,
            'draft'       => $this->draft,
            'view_count'  => $this->view_count,
            'picture'     => $this->photo_url,
        ];
    }
}
