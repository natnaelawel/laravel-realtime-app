<?php

namespace App\Http\Controllers;

use App\Like;
use App\Model\Reply;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.verify', ['except' => ['likes']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function likes(Reply $reply)
    {
        return $reply->likes;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function likeIt(Reply $reply)
    {
        $reply->likes()->create([
            'user_id' => 1
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function unLikeIt(Reply $reply)
    {
        $reply->likes()->where([
            'user_id'=> 1
        ])->first()->delete();
    }
}
