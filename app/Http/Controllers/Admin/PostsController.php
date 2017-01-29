<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Requests\PostFormRequest;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('backend.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('backend.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PostFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostFormRequest $request)
    {
        $user_id = Auth::user()->id;

        $post = new Post([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'slug' => Str::slug($request->get('title'), '-'),
            'user_id' => $user_id
        ]);

        $post->save();

        $post->categories()->sync($request->get('categories'));

        return redirect('admin/posts/create')->with('status', 'New post has been created!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::whereId($id)->firstOrFail();
        $categories = Category::all();
        $selectedCategories = $post->categories->pluck('id')->toArray();

        return view('backend.posts.edit', compact('post', 'categories', 'selectedCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PostFormRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostFormRequest $request, $id)
    {
        $post = Post::whereId($id)->firstOrFail();
        $post->title = $request->get('title');
        $post->content = $request->get('content');
        $post->slug = Str::slug($post->title, '-');

        $post->save();

        $post->categories()->sync($request->get('categories'));

        return redirect(action('Admin\PostsController@edit', $id))->with('status', 'Post has been udpated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
        return redirect('admin/posts')->with('status', 'Post has been deleted!');
    }
}
