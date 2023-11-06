<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Http;
use JetBrains\PhpStorm\NoReturn;
use MarkSitko\LaravelUnsplash\Unsplash;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $posts = Post::orderBy('id', 'desc')->get();
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): \Illuminate\Http\RedirectResponse
    {
        try {
            if ($this->imageGeneration()) {
                $request->request->add(['image' => $this->imageGeneration()]);
                $post = Post::create($request->all());
                return redirect()->route('posts.edit', $post->id)->with('success', 'Post created successfully');
            }
            return redirect()->route('posts.create')->with('error', 'Image not generated');
        } catch (\Exception $e) {
            return redirect()->route('posts.create')->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $posts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $posts, $id): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $post = $posts::findOrFail($id);

        return view('admin.post.edit', compact('post'));
    }

    /**
     * @param $request
     * @return false|mixed
     */
    #[NoReturn] public function imageGeneration(): mixed
    {
        $response = Http::get(Post::POST_IMAGE_URL . 'random', [
            'client_id' => env('UNSPLASH_ACCESS_KEY'),
            'orientation' => 'landscape',
        ]);
//        dd($response->json());
        if ($response->successful()) {
            $imageData = $response->json();
//            dd($imageData['urls']['regular']);
            return $imageData['urls']['regular'];
        } else {
            return false;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $posts): \Illuminate\Http\RedirectResponse
    {
        try {
            $post = $posts::findOrFail($request->id);

            if (isset($request->generate_new_img)) {
                $response = Http::get(Post::POST_IMAGE_URL . 'random', [
                    'client_id' => env('UNSPLASH_ACCESS_KEY'),
                    'orientation' => 'landscape',
                ]);

                if ($response->successful()) {
                    $imageData = $response->json();
                    $request->request->add(['image' => $imageData['urls']['regular']]);
                }
            }

            $post->update($request->all());
            return redirect()->route('posts.edit', $request->id)->with('success', 'Post updated successfully');
        } catch (\Exception $th) {
            return redirect()->route('posts.edit', $request->id)->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $posts, $id): \Illuminate\Http\RedirectResponse
    {
        try {
            $post = $posts::findOrFail($id);
            $post->delete();
            return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
        } catch (\Exception $th) {
            return redirect()->route('posts.index')->with('error', 'Something went wrong');
        }

    }
}
