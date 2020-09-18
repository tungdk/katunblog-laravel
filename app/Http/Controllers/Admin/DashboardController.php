<?php

namespace App\Http\Controllers\Admin;


use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $countView = Post::sum('view');
        $countPost = Post::count('id');
        $countCate = Category::count('id');
        $countAuthor = User::where('tk',1)->orWhere('tk',2)->count('id');
        $countUser = User::where('tk',0)->count('id');
        $count_post_cate = DB::table('posts')
            ->rightJoin('categories','posts.category_id','=','categories.id')
            ->select('categories.id','categories.title','categories.color', DB::raw('COUNT(posts.category_id) as count'))
            ->groupBy('categories.id','categories.title','categories.color')
            ->get();
        $count_post_author = DB::table('posts')
            ->rightJoin('users','posts.user_id','=','users.id')
            ->select('users.id','users.name', DB::raw('COUNT(posts.user_id) as count'))
            ->groupBy('users.id','users.name')
            ->where('users.tk','=',1)
            ->orWhere('users.tk','=', 2)
            ->get();
        $posts = Post::OrderByDesc('view')->paginate(20);
        return view('admin.dashboard',[
            'countView'=>$countView,
            'countPost'=>$countPost,
            'countCate'=>$countCate,
            'countAuthor'=>$countAuthor,
            'countUser'=>$countUser,
            'count_post_cate'=>$count_post_cate,
            'count_post_author'=>$count_post_author,
            'posts'=>$posts
        ]);
    }
}
