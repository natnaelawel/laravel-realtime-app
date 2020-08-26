<?php

namespace App;

use App\Model\Reply;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['user_id', 'reply_id', 'status'];

    public function reply(){
        return $this->belongsTo(Reply::class);
    }

}
