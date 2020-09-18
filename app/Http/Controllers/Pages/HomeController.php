<?php


namespace App\Http\Controllers\Pages;


use App\Http\Controllers\PagesController;
use App\Post;

class HomeController extends PagesController
{
    public function home()
    {
        $slides = Post::where('status', 1)->orderByDesc('created_at')->limit(3)->get();
        $six_posts = Post::where('status', 1)->orderByDesc('created_at')->skip(3)->limit(6)->get();
        $night_posts_next = Post::where('status', 1)->orderByDesc('created_at')->skip(9)->take(13)->get();
        $one_posts_next = $night_posts_next->shift();
        $most_rate_posts = Post::where('status', 1)->orderByDesc('rate')->take(10)->paginate(3);
        return view('pages.home', [
            'slides' => $slides,
            'six_posts' => $six_posts,
            'one_posts_next' => $one_posts_next,
            'night_posts_next' => $night_posts_next,
            'most_rate_posts' => $most_rate_posts,
        ]);

    }
}
