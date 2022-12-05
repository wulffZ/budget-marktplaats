<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
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

        return Inertia::render(
            'Dashboard',
            [
                'posts' => $posts
            ]
        );
    }

    public function show($id)
    {
        $post = Post::with('images')->findOrFail($id);

        return Inertia::render(
            'Post/Show',
            [
                'post' => $post
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
            'user_id' => Auth::id(),
            'description' => $request->description,
            'category' => $request->category,
        ]);

        $photos = $request->file('photos');

        $this->storePhotos($photos[0], $post);

        return redirect('dashboard');
    }

    public function edit($id)
    {
        $post = Post::with('images')->findOrFail($id);

        return Inertia::render(
            'Post/Edit',
            [
                'post' => $post
            ]
        );
    }

    /**
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $post = Post::with('images')->findOrFail($id);

        Validator::make($request->all(), [
            'title' => ['required'],
            'description' => ['required', 'max:130'],
            'category' => ['required'],
        ])->validate();

        $post->title = $request->title;
        $post->description = $request->description;
        $post->thumbnail_uri = $request->thumbnail_uri;

        if ($request->toBeAdded !== []) {
            // Store new photos
            $this->storePhotos($request->toBeAdded[0], $post);
        }

        if (!is_null($request->toBeDeleted)) {
            // Delete existing photos if needed
            $this->deleteExistingPhotos($request->toBeDeleted, $post);
        }

        return redirect(route('post.show', $post->id));
    }

    public function destroy($id)
    {
        $post = Post::with('images')->findOrFail($id);

        if (Auth::id() != $post->user_id) {
            return '401';
        }

        foreach ($post->images as $postImage) {
            $postImage->delete();
        }
        $post->delete();

        return redirect('dashboard');
    }

    private function storePhotos($photos, $post): void
    {
        for ($i = 0; $i < sizeof($photos); $i++) {
            $uri = auth()->id() . '_' . $i . '_' . time();
            $file_uri = $uri . '.' . $photos[$i]->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('photos', $photos[$i], $file_uri);

            PostImage::create([
                'post_id' => $post->id,
                'file_uri' => $file_uri,
            ]);
        }
    }

    private function deleteExistingPhotos($images): void
    {
        for ($i = 0; $i < sizeof($images); $i++) {
            $postImage = PostImage::where('id', $images[$i]['id'])->delete();
        }
    }
}
