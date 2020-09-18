<?php


namespace App\Http\Controllers\Pages;


use App\Comment;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PagesController;
use App\Post;
use App\Rating;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class BlogpostController extends PagesController
{
    public function blogpost($id)
    {
        Post::find($id)->increment('view');
        $blogpost = Post::find($id);
        $comments = Comment::where('post_id', $id)->orderByDesc('created_at')->paginate(5);
        $count_comments = Comment::where('post_id',$id)->count('id');
        $count_rating = Rating::where('post_id', $id)->count('post_id');
        $five_relate_posts = Post::where('category_id', '=', $blogpost->category_id)->where('id', '!=', $id)->orderByDesc('view')->take(5)->get();
        if (Auth::user()) {
            $user = Auth::user();
            $user_rating = Rating::where('user_id', $user->id)->where('post_id', $id)->first();
            if ($user_rating) {
                return view('pages.blog-post', [
                    'post' => $blogpost,
                    'comments' => $comments,
                    'five_relate_posts' => $five_relate_posts,
                    'count_rating' => $count_rating,
                    'user_rating' => $user_rating,
                    'count_comments' =>$count_comments
                ]);
            } else {
                return view('pages.blog-post', [
                    'post' => $blogpost,
                    'comments' => $comments,
                    'five_relate_posts' => $five_relate_posts,
                    'count_rating' => $count_rating,
                    'count_comments' =>$count_comments
                ]);
            }
        }
        return view('pages.blog-post', [
            'post' => $blogpost,
            'comments' => $comments,
            'five_relate_posts' => $five_relate_posts,
            'count_rating' => $count_rating,
            'count_comments' =>$count_comments
        ]);
    }

    public function postComment(Request $request)
    {
        $ruler = [
//            'name' => 'required',
//            'email' => 'required|email',
            'message' => 'required|max:255'
        ];
        $message = [
//            'name.required' => 'Bạn chưa nhập tên',
//            'email.required' => 'Bạn chưa nhập Email',
//            'email.email' => 'Nhập đúng định dạng email',
            'message.required' => 'Bạn chưa nhập Mật khẩu',
            'message.max' => 'Mật khẩu không lớn hơn 255 ký tự'

        ];
        $validator = Validator::make($request->all(), $ruler, $message);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ]);
        } else {
            $comment = new Comment;
            $comment->post_id = $request->post_id;
            $comment->user_id = $request->user_id;
//            $comment->name = $request->name;
//            $comment->email = $request->email;
            $comment->message = $request->message;
            $comment->save();
            $success = new MessageBag(['comment' => 'Bình luận thành công!']);
            return response()->json([
                'error' => false,
                'message' => $success
            ]);
        }
    }

    public function postRating(Request $request)
    {
        $rate = new Rating();
        $rate->post_id = $request->post_id;
        $rate->user_id = $request->user_id;
        $rate->rate = $request->rate;
        $result = $rate->save();
        if ($result) {
            $post = Post::find($request->post_id);
            $avg_rate = Rating::where('post_id',$request->post_id)->avg('rate');
            $post->rate = $avg_rate;
            $post->save();
            return response()->json([
                'error' => false,
                'message'=> $avg_rate
            ]);
        } else {
            return response()->json([
                'error' => true,
            ]);
        }

    }
}
