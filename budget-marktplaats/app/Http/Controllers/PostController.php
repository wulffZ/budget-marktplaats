<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('images')->get();

//        dd($posts);

        return Inertia::render(
            'Dashboard',
            [
                'posts' => $posts
            ]
        );
    }

    public function create()
    {
        return Inertia::render(
            'Post/Create',
        );
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'title' => ['required', 'unique:posts'],
            'description' => ['required', 'max:130'],
            'category' => ['required'],
            'photos' => ['required'],
        ])->validate();

        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
        ]);

        $photos = $request->file('photos');

        $this->storePhotos($photos[0], $post);

        return redirect('dashboard');
    }

    public function edit()
    {
        return Inertia::render(
            'Posts/Edit',
        );
    }

    /**
     * @throws ValidationException
     */
    public function update(Request $request, Post $post)
    {
        Validator::make($request->all(), [
            'title' => ['required', 'unique:posts'],
            'description' => ['required', 'max:130'],
            'category' => ['required'],
            'thumbnail_uri' => ['required'],
        ])->validate();

        $post->title = $request->title;
        $post->description = $request->description;
        $post->thumbnail_uri = $request->thumbnail_uri;

        //TODO redirect to edited post.
        return;
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('blogs.index');
    }

    private function storePhotos($photos, $post): void {
        for($i = 0; $i < sizeof($photos); $i++) {
            $uri = auth()->id() . '_' . $i . '_' . time();
            $file_uri = $uri . '.'. $photos[$i]->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('photos', $photos[$i], $file_uri);

            PostImage::create([
                'post_id' => $post->id,
                'file_uri' => $file_uri,
            ]);
        }
    }
}
