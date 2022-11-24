<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *z
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();

        return view('home',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add_post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'nullable',
        ]);

        $post = new Post;
        $post->title = $request->input('title');
        $post->description = $request->input('description');


        if($request->has('completed')){
            $post->completed = true;
        }
        $post->user_id = Auth::user()->id;

        $post->save();

        return back()->with('success', 'Post Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::where('id',$id)->where('user_id',Auth::user()->id)->first();
        if(!$post){
            abort(404);
        }
        return view('delete_post',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::where('id',$id)->where('user_id',Auth::user()->id)->first();
        if(!$post){
            abort(404);
        }
        return view('edit_post',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'nullable',
        ]);

        $post = Post::where('id',$id)->where('user_id',Auth::user()->id)->first();
        $post->title = $request->input('title');
        $post->description = $request->input('description');


        if($request->has('completed')){
            $post->completed = true;
        }
        else{
            $post->completed = false;
        }

        $post->save();

        return back()->with('success', 'Post Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::where('id',$id)->where('user_id',Auth::user()->id)->first();
        $post->delete();
        return redirect()->route('todo.index')->with('success', 'Post is deleted Successfully');
    }
}
