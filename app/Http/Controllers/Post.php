<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post as PostModel;
use App\Models\Category;
use App\Models\Tag;
use App\Models\PostTag;

class Post extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('post.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('id', 'verbose_name')
            ->get();

        return view('post.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->file('thumbnail')->storeAs('thumbnails', $request->file('thumbnail')->getClientOriginalName(), 'public');

        $postName = strtolower($request->input('title'));
        $postName = preg_replace('/[^a-z0-9]/', '-', $postName);
        $postName = preg_replace('/-+/', '-', $postName);

        $post = PostModel::create([
            'user_id' => $request->user()->id,
            'category_id' => $request->input('category'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'thumbnail' => $request->file('thumbnail')->getClientOriginalName(),
            'content' => $request->input('content'),
            'priority' => $request->input('priority'),
            'name' => $postName,
        ]);

        if ($request->filled('tags')) {
            foreach (array_filter(explode('#', $request->input('tags'))) as $tag) {
                $tag = trim($tag);

                if (!Tag::where('name', $tag)->exists()) {
                    Tag::create(['name' => $tag, 'category_id' => $request->input('category')]);
                }

                PostTag::create([
                    'post_id' => $post->id,
                    'tag_id' => Tag::firstWhere('name', $tag)->id,
                ]);

            }
        }

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::select('id', 'verbose_name')
            ->get();

        $post = PostModel::find($id);

        return view('post.edit', [
            'categories' => $categories,
            'post' => $post,
        ]);
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
        $post = PostModel::find($id);

        $postName = strtolower($request->input('title'));
        $postName = preg_replace('/[^a-z0-9]/', '-', $postName);
        $postName = preg_replace('/-+/', '-', $postName);

        $post->user_id = $request->user()->id;
        $post->category_id = $request->input('category');
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->content = $request->input('content');
        $post->priority = $request->input('priority');
        $post->name = $postName;

        if ($request->hasFile('thumbnail')) {
            $request->file('thumbnail')->storeAs('thumbnails', $request->file('thumbnail')->getClientOriginalName(), 'public');

            $post->thumbnail = $request->file('thumbnail')->getClientOriginalName();

        }

        $post->save();

        if ($request->filled('tags') && $request->input('tags') !== sprintf('#%s', $post->postTags->pluck('tag.name')->join('#'))) {
            PostTag::where('post_id', $id)->delete();

            foreach (array_filter(explode('#', $request->input('tags'))) as $tag) {
                $tag = trim($tag);

                if (!Tag::where('name', $tag)->exists()) {
                    Tag::create(['name' => $tag, 'category_id' => $request->input('category')]);
                }

                PostTag::create([
                    'post_id' => $post->id,
                    'tag_id' => Tag::firstWhere('name', $tag)->id,
                ]);

            }
        }

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = PostModel::find($id);

        $post->delete();

        return redirect()->route('posts.index');
    }
}
