<?php


namespace App\Http\Controllers\Pages;


use App\Http\Controllers\PagesController;
use App\Post;

class AboutController extends PagesController
{
    public function about()
    {
        $most_read_posts = Post::all()->where('status', 1)->sortByDesc('view')->take(5);
        return view('pages.about', [
            'most_read_posts' => $most_read_posts
        ]);
    }
}
