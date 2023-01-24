<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::all();
        return view('blog.all_comments',compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $posts = Post::all();

        return view('blog.create_comment',compact('users','posts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentRequest $request)
    {
         // Retrieve the validated input data...
         $validated = $request->validated();

         try{
             $comment = new Comment();
             $comment->user_id = $validated['user_id'];
             $comment->post_id = $validated['post_id'];
             $comment->comment = $validated['content'];
             $comment->date = date_form($validated['date'],'Y/m/d H:i:s');
             $comment->save();
             return redirect('Dashboard/comments')->with('status',"Insert successfully");
         }
         catch(Exception $e){
             return redirect('Dashboard/comments')->with('failed',$e->getMessage());
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        $users = User::all();
        $posts = Post::all();
        return view('blog.edit_comment',compact('comment','posts','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentRequest $request,$id)
    {
        $comment = Comment::find($id);
        $validated = $request->validated();

        try{
            
            $comment->user_id = $validated['user_id'];
            $comment->post_id = $validated['post_id'];
            $comment->comment = $validated['content'];
            $comment->date = date_form($validated['date'],'Y/m/d H:i:s');
           
            $comment->save();
            return redirect('Dashboard/comments')->with('status',"update successfully");
        }
        catch(Exception $e){
            return redirect('Dashboard/comments')->with('failed',"operation failed");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment=Comment::find($id);
        
        $comment->delete();
        return redirect('Dashboard/comments')->with('status',"delete successfully");
    }
}
