<?php

namespace App\Model;

use App\Like;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Reply extends Model
{

    protected $fillable = ['body', 'user_id'];
    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function likeStatus()
    {
        if (is_null(auth()->id())) {
            return "0";
        } else {
            // $status = $this->likes()->where('user_id', auth()->id())->get();
            $result = Reply::find($this->id)->likes()->where('user_id', auth()->id())->first();
            if(is_null($result)){
                return "0";
            }
            return $result->status;
        }
    }
}
