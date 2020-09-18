<?php


namespace App\Http\Controllers\Pages;


use App\Category;
use App\Http\Controllers\PagesController;
use App\Post;

class CategoryController extends PagesController
{
    public function category($id)
    {
        $category = Category::find($id);
        $one_recent_post = Post::where('category_id', '=', $id)->where('status', 1)->orderByDesc('created_at')->first();
        $two_recent_posts_next = Post::where('category_id', '=', $id)->where('status', 1)->orderByDesc('created_at')->skip(1)->take(2)->get();
        $four_recent_posts_next = Post::where('category_id', '=', $id)->where('status', 1)->orderByDesc('created_at')->skip(3)->take(4)->get();
        $five_read_most_posts = Post::where('category_id', '=', $id)->where('status', 1)->orderByDesc('view')->take(5)->get();
        return view('pages.category', [
            'cate' => $category,
            'one_recent_post' => $one_recent_post,
            'two_recent_posts_next' => $two_recent_posts_next,
            'four_recent_posts_next' => $four_recent_posts_next,
            'five_read_most_posts' => $five_read_most_posts
        ]);
    }
}
