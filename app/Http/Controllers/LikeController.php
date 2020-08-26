<?php

namespace App\Http\Controllers;

use App\Events\LikeEvent;
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
    public function likeUpdate($reply_id, Request $request)
    {

        switch ($request->status) {
            case "1": {
                    $like = new Like([
                        'reply_id' => (int) $reply_id,
                        'user_id' => auth()->id(),
                        'status' => "1",

                    ]);
                    $like->save();
                    broadcast(new LikeEvent($reply_id, 'like', 1))->toOthers();
                    return $like;
                }
            case "-1": {
                    $like = new Like([
                        'reply_id' => (int) $reply_id,
                        'user_id' => auth()->id(),
                        'status' => "-1",

                    ]);

                    $like->save();
                    broadcast(new LikeEvent($reply_id, 'dislike', 1))->toOthers();
                    return $like;
                }
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function unLikeIt(Reply $reply, $type)
    {
        // $reply->likes()->where([
        //     'user_id' => 1
        // ])->first()->delete();

        $reply->likes()->where([
            'user_id' => auth()->id()
        ])->first()->delete();

        if($type === 'like'){
            broadcast(new LikeEvent($reply->id, 'like', -1))->toOthers();

        }elseif ($type === 'dislike') {
            broadcast(new LikeEvent($reply->id, 'dislike', -1))->toOthers();

        }
        return $reply;

    }
}
