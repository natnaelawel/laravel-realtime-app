<?php

namespace App\Http\Resources;

use App\Model\Question;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

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
            'id' => $this->id,
            'reply' => $this->body,
            'question' => $this->question->title,
            'slug' => $this->question->slug,
            'user_id' => $this->user->id,
            'user' => $this->user->name,
            'liked_count' => $this->likes()->where('status', 1)->count(),
            'disliked_count' => $this->likes()->where('status', -1)->count(),
            'like_status' => $this->likeStatus(),
            'created_at' => $this->created_at->diffForHumans()

        ];
    }
}
