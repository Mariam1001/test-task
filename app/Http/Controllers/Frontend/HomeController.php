<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;

class HomeController extends Controller
{
    /**
     * @param Post $posts
     */
    public function __construct(public Post $posts)
    {

    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index(): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $posts = $this->getHomePosts();

        return view('frontend.posts.posts', compact('posts'));
    }

    /**
     * @return mixed
     */
    public function getHomePosts(): mixed
    {
        return $this->posts->orderBy('id', 'DESC')->get();
    }
}
