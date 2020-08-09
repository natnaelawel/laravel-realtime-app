<?php

namespace App\Model;

use App\Like;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{

    protected $fillable = ['body', 'user_id'];
    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }
    public function question(){
        return $this->belongsTo(Question::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

}
