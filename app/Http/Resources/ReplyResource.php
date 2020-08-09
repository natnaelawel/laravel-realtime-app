<?php

namespace App\Http\Resources;

use App\Model\Question;
use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource
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
            'reply' => $request->body,
            'question' => $this->question->title,
            'user' => $this->user->name,
            'created_at' => $this->created_at->diffForHumans()

        ];
    }
}
