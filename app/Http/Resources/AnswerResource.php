<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
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
            'description'    => $this->description,
            'correct'        => $this->correct,
            'question'       => new QuestionResource($this->question),
            'notify_answer'  => $this->notify_answer,
            'notify_correct' => $this->notify_correct,
            'points_answer'  => $this->points_answer,
            'points_correct' => $this->points_correct	,
        ];
    }
}
