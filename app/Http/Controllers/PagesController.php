<?php

namespace App\Http\Controllers;



use App\Post;

use Illuminate\Http\Request;
use App\Htt\Requests;
use App\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Mail;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    function __construct()
    {
        $categories = Category::all();
        $count_post_cate = DB::table('posts')
            ->rightJoin('categories', 'posts.category_id', '=', 'categories.id')
            ->select('categories.id', 'categories.title', 'categories.color', DB::raw('COUNT(posts.category_id) as count'))
            ->groupBy('categories.id', 'categories.title', 'categories.color')
            ->get();
        $nav_three_post = Post::where('status', 1)->orderByDesc('view')->limit(3)->get();
        view()->share('count_post_cate', $count_post_cate);
        view()->share('categories', $categories);
        view()->share('nav_three_post', $nav_three_post);
    }

    public function search(Request $request){
        $search = $request->search;
        $most_read_posts = Post::where('status', 1)->orderByDesc('view')->limit(3)->get();
        $posts = Post::where('status',1)->where('title','LIKE',"%$search%")
            ->orWhere('description','like',"%$search%")
            ->orWhere('contents','like',"%$search%")
            ->paginate(10);
//        $posts = DB::table('posts')
//            ->rightJoin('categories', 'posts.category_id', '=', 'categories.id')
//            ->rightJoin('users', 'posts.user_id', '=', 'users.id')
//            ->orWhere('posts.description','like',"%$search%")
//            ->orWhere('posts.contents','like',"%$search%")
//            ->orWhere('users.name','like',"%$search%")
//            ->orWhere('categories.title','like',"%$search%")
//            ->paginate(10);
        return view('pages.search', [
            'posts'=>$posts,
            'search'=>$search,
            'most_read_posts'=>$most_read_posts
        ]);
    }

    public function search_auto(Request $request){
        $output = "";
        $search = $request->search;
        $posts = Post::where('status',1)->where('title','LIKE',"%$search%")->get();
//            ->orWhere('description','like',"%$search%")
//            ->orWhere('contents','like',"%$search%")
//            ->paginate(10);
//        $posts = DB::table('posts')
//            ->rightJoin('categories', 'posts.category_id', '=', 'categories.id')
//            ->rightJoin('users', 'posts.user_id', '=', 'users.id')
//            ->orWhere('posts.description','like',"%$search%")
//            ->orWhere('posts.contents','like',"%$search%")
//            ->orWhere('users.name','like',"%$search%")
//            ->orWhere('categories.title','like',"%$search%")
//            ->paginate(10);
        if($posts){
            foreach ($posts as $post){
                $output.= "<a href='".URL::to('/'.$post->id.'-'.str_replace(' ','-',$post->title))."' class='list-group-item'>".$post->title."</a>";
            }
        }
        return response($output);
    }
    public function email_footer(Request $request)
    {
        $ruler = [
            'email' => 'required|email',
        ];
        $message = [
            'email.required' => 'Bạn chưa nhập Email',
            'email.email' => 'Nhập đúng định dạng email',
        ];
        $validator = Validator::make($request->all(), $ruler, $message);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ]);
        } else {
            Mail::send('emails.email_thankyou', [
                'email' => $request->email,
            ], function ($mail) use ($request) {
                $mail->to($request->email);
                $mail->from('khactungdinh.228@gmail.com');
                $mail->subject('Thư cảm ơn');
            });
            $success = new MessageBag(['newsletter' => 'Đăng ký nhận tin thành công!']);
            return response()->json([
                'error' => false,
                'message' => $success
            ]);
        }
    }
    public function error_page(){
        return view('errors.404');
    }
}
