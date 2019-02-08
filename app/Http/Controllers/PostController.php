<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.id as id', 'posts.title as title', 'users.name as name', 'posts.created_at as created_at')
            ->orderByDesc('created_at')
            ->paginate(8);//get()
        return view('home', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:posts|max:100',
            'description' => 'required|min:50',
        ]);
        $post = new Post();
        $post->title = $request->get('title');
        $post->description = $request->get('description');

        $post->user_id = Auth::user()->id;
        $post->save();

        /** Method 2
        $user=Auth::user();
        $user->posts()->save($post);
         */

        return redirect(route('posts.show', ['id' => $post->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $author = User::find($post->user_id);
        return view('show', ['post' => $post, 'author' => $author]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('edit',['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|unique:posts|max:100',
            'description' => 'required|min:50',
        ]);
        $post = Post::find($id);
        $post->title=$request->get('title');
        $post->description=$request->get('description');
        $post->save();
        return redirect(route('posts.show', ['id' => $post->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
        return redirect()->route('posts.index');
    }
}
