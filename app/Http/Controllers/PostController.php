<?php

namespace App\Http\Controllers;

use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use SebastianBergmann\CodeUnit\Exception;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('blog.all_posts',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create_post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
           // Retrieve the validated input data...
            $validated = $request->validated();

            try{
				$post = new Post();
                $post->title = $validated['title'];
                $post->author = $validated['author'];
				$post->content = $validated['content'];
				$post->date = date_form($validated['date'],'Y/m/d H:i:s');
                $post->image = uploadImage($validated['image']);
				$post->save();
				return redirect('Dashboard/posts')->with('status',"Insert successfully");
			}
			catch(Exception $e){
				return redirect('Dashboard/posts')->with('failed',"operation failed");
			}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('blog.edit_post',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::find($id);
        $validated = $request->validated();

        try{
            
            $post->title = $validated['title'];
            $post->author = $validated['author'];
            $post->content = $validated['content'];
            $post->date = date_form($validated['date'],'Y/m/d H:i:s');
            if(!empty($request->image)){
                File::delete('images/' .$post->image);
                $post->image = uploadImage($validated['image']);
            }
            $post->save();
            return redirect('Dashboard/posts')->with('status',"update successfully");
        }
        catch(Exception $e){
            return redirect('Dashboard/posts')->with('failed',"operation failed");
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::find($id);
        if(file_exists('images/' .$post->image)){
            File::delete('images/' .$post->image);

        }
        $post->delete();
        return redirect('Dashboard/posts')->with('status',"delete successfully");

    }
}
