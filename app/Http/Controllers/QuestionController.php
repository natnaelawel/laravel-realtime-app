<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionResource;
use App\Model\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class QuestionController extends Controller
{

    public function __construct()
    {
        $this->middleware('jwt.verify', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return QuestionResource::collection(Question::latest()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Question::create($request->all());
        validator($request->toArray(), [
            'title'=> 'required|string',
            'body' => 'required|string|max:255',
            'category_id' => 'required'
        ]);

        // dd($request);
        $question = new Question([
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
            'body' => $request->body,
            'category_id' => $request->category_id,
            'user_id' => auth()->user()->id,
        ]);
        $question->save();
        return response(new QuestionResource($question), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return new QuestionResource($question);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        validator($request->toArray(), [
            'title'=> 'required',
            'body' => 'required|max:255',
            'category_id' => 'required'
        ]);
        $question->update([
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
            ]);

        return response('Updated', Response::HTTP_ACCEPTED);
            // session()->flash('success','Post Updated Successfully');
            // return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
