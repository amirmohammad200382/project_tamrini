<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CategoryController;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;


class PostController extends Controller
{

    public function index()
    {
        $posts = Post::all();

        return view('post.index', ['posts' => $posts]);
    }

    public function create()
    {
        $categories = Category::orderby('id')->get();
        return view('post.create' , ['categories' => $categories]);

    }

    public function show($id)
    {
        $post=Post::find($id);
        return view('post.show', ['post' => $post]);
    }

    public function store(StorePostRequest $request)
    {
        Post::create([
            'title'=>$request->title,
            'body' =>$request->body,
        ]);

        return redirect()->route('posts.index');
    }

    public function edit($id)
    {
        $post=Post::find($id);
        $categories = Category::orderby('id')->get();
        return view('post.edit' , ['categories' => $categories , 'post' => $post]);
    }

    public function update(UpdatePostRequest $request, $id)
    {
        $post=Post::find($id);
        $post->update([
            'title'=>$request->title,
            'body' =>$request->body,
        ]);
        $post->categories()->detach();

        foreach ($request->category_id as $category)
            $post->categories()->attach($category);

        return redirect()->route('posts.index');
    }

    public function destroy($id)
    {
        Post::find($id)->delete();

        return redirect()->route('posts.index');
    }
}
