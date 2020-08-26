<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReplyResource;
use App\Model\Question;
use App\Model\Reply;
use App\Notifications\NewReplyNotification;
use App\Events\DeleteReplyEvent;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.verify', ['except' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Question $question)
    {
        // $question = Question::where('slug', $question)->replies;
        // dd($question);
        // return ->replies();
        return ReplyResource::collection($question->replies()->latest()->get());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, Request $request)
    {
        validator($request->all(),[
            'body'=> 'required|string',
        ]);
        // $request->question_id = $question->id;
        // $request->user_id = auth()->user()->id;
       $reply = $question->replies()->create([
            'body' => $request->body,
            'user_id' => auth()->user()->id,
        ]);
        $user = $question->user;
        if($reply->user_id !== $question->user_id){
            $user->notify(new NewReplyNotification($reply));
        }
        return response(new ReplyResource($reply), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question, Reply $reply)
    {
        return new ReplyResource($reply);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Question $question, Request $request, Reply $reply)
    {
        validator($request->all(),[
            'body'=> 'required|string',
            'user_id' => 'required'
        ]);

        $reply->update($request->all());
        return response(new ReplyResource($reply), Response::HTTP_ACCEPTED);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Reply $reply)
    {
        $reply->delete();
        broadcast(new DeleteReplyEvent($reply->id))->toOthers();
        return response($reply, Response::HTTP_NO_CONTENT);
    }
}
