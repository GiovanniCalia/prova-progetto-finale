<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

     private function getValidators($model) {
        return [
            'title'          => 'required|max:255',
            'slug'           => [
                'required',
                Rule::unique('posts')->ignore($model), // 'required|unique:posts|max:255',
                'max:255'
            ],
            'category_id'    => 'required|exists:App\Category,id',
            'creator'        => 'required|max:50',
            'description'    => 'required',
            'image'          => 'nullable|image',
            'date_creation'  => 'required|max:20',
            'tags'           => 'exists:App\Tag,id'
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        /*$posts = $this->composeQuery($request);

        $posts = $posts->paginate(20);

        $queries = $request->query();
        unset($queries['page']);
        $posts->withPath('?' . http_build_query($queries, '', '&'));

        $users = User::all();

        return view('admin.posts.index', [
            'posts'         => $posts,
            'users'         => $users,
            'request'       => $request
        ]);*/

        
        $posts = Post::paginate(30);

        return view('admin.posts.index', compact('posts'));
    }

    public function indexUser()
    {
        $posts = Post::where('user_id', Auth::user()->id)->paginate(30);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', [
            'categories' => $categories,
            'tags'       => $tags,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        $request->validate($this->getValidators(null));

        $data = $request->all();

        if (array_key_exists('image', $data)) {
            Storage::delete($post->image);
            $img_path = Storage::put('uploads', $data['image']);
            $saveData = [
                'user_id' => Auth::user()->id,
                'image'    => $img_path
            ] + $data;
            $save = Post::create($saveData);
            $save->tags()->attach($saveData['tags']);
            return redirect()->route('admin.posts.show', $save->slug);
        }

    
       /*$img_path = Storage::put('uploads', $data['image']);

        $saveData = [
            'user_id' => Auth::user()->id,
            'image'   => $img_path
        ] + $data;


        $save = Post::create($saveData);
        $save->tags()->attach($saveData['tags']);
        return redirect()->route('admin.posts.show', $save->slug);*/




        /*$request->validate($this->getValidators(null));
        $saveData = $request->all() + ['user_id' => Auth::user()->id];

        $save = Post::create($saveData);
        $save->tags()->attach($saveData['tags']);
        return redirect()->route('admin.posts.show', $save->id); //id*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.show', [
            'post'       => $post,
            'categories' => $categories,
            'tags'       => $tags,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if (Auth::user()->id !== $post->user_id) abort(403);

        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', [
            'post'       => $post,
            'categories' => $categories,
            'tags'       => $tags,

        ]); //compact('post')
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if (Auth::user()->id !== $post->user_id) abort(403);

        $request->validate($this->getValidators($post));
        $postData = $request->all();
        
        if (array_key_exists('image', $postData)) {
            Storage::delete($post->image);
            $img_path = Storage::put('uploads', $postData['image']);
            $postData = [
                'image'    => $img_path
            ] + $postData;
        }

        $post->update($postData);
        if (array_key_exists('tags', $postData)) $post->tags()->sync($postData['tags']);
        // $post->tags()->sync($postData['tags']);

        return redirect()->route('admin.posts.show', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (Auth::user()->id !== $post->user_id) abort(403);

        $post->tags()->detach();
        $post->delete();

        return redirect()->back();
    }
}
