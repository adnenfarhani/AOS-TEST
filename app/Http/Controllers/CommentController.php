<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , Post $post)
    {
        $request->validate([
            'body' => 'required|min:5'
        ]);

        $post->comments()->create([
            'body' => $request->body ,
            'user_id' => Auth::id()
        ]);


        return Redirect::to(URL::previous() . "#addCommentForm_".$post->id)->with('success' , 'comment created successfully');
        return back()->with('success' , 'comment created successfully');

        return redirect()->route('posts.show' , $post)->with('success' , 'comment created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return view('comments.show')->with([
            'comment' => $comment
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        if (! Gate::allows('edit-comment', $comment)) {
            abort(403);
        }
        return view('comments.edit' , compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        if (! Gate::allows('edit-comment', $comment)) {
            abort(403);
        }
        $request->validate([
            'body' => 'required|min:5'
        ]);

        $comment->update([
            'body' => $request->body 
        ]);
        
        return redirect()->route('comments.show' , $comment->id)->with('success' , 'comment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        if (! Gate::allows('delete-comment', $comment)) {
            abort(403);
        }
        $post = $comment->post_id;

        $comment->delete();

        return Redirect::to(URL::previous() . "#addCommentForm_". $post)->with('success' , 'comment created successfully');

        return redirect()->route('posts.show' , $post)->with('success' , 'comment deleted successfully');

        //
    }
}
