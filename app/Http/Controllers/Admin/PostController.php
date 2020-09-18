<?php

namespace App\Http\Controllers\Admin;

use App\Author;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use App\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PostController extends Controller
{

    public function all()
    {
        $post = Post::all()->sortByDesc('id');
        return view('admin.post.all', ['posts' => $post]);
    }

    //detail post
    public function detail($id)
    {
        $post = Post::find($id);
        $comments = Comment::where('post_id', '=', $id)->get();
        return view('admin.post.detail', ['post' => $post, 'comments' => $comments]);
    }

    // add post
    public function add()
    {
        $categories = Category::all();
        return view('admin.post.add', ['categories' => $categories]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'title' => 'required|max:100',
                'description' => 'required|max:500',
                'contents' => 'required',
                'category_id' => 'required',
                'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ],

            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute không được lớn hơn :max kí tự',
                'min' => ':attribute không được nhỏ hơn :min kí tự',
                'image' => ':attribute phải là file ảnh',
                'mimes' => ':attribute định dạng ảnh là :mine'
            ],

            [
                'title' => 'Tiêu đề',
                'description' => 'Mô tả',
                'contents' => 'Nội dung',
                'category_id' => 'Danh mục',
                'thumbnail' => 'Ảnh',
            ]
        );
        if ($validator->fails())
            return Redirect::to('admin/post/add')->withErrors($validator);
        else {
            $post = new Post;
            $post->title = $request->title;
            $post->description = $request->description;
            $post->contents = $request->contents;
            $post->category_id = $request->category_id;
            $post->created_at = date('Y-m-d H:i:s');
            $status = (isset($request->status)) ? 1 : 0;
            $post->status = $status;
            $post->user_id = Auth::user()->id;
            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $format = $file->getClientOriginalExtension();
                if ($format != 'jpg' && $format != 'png' && $format != 'jpeg') {
                    return Redirect::to('admin/post/add')->with('error', 'Định dang ảnh chỉ có thể là jpg, png, jpeg');
                }
                $name = $file->getClientOriginalName();
                $thumbnail = Str::random(4) . "_" . $name;
                while (file_exists("uploads/imagePost/" . $thumbnail)) {
                    $thumbnail = Str::random(4) . "_" . $name;
                }
                $file->move(public_path() . '/uploads/imagePost/', $thumbnail);
                $post->thumbnail = $thumbnail;
            } else {
                return Redirect::to('admin/post/add')->with('error', 'Bạn chưa nhập ảnh');
            }
            $post->save();
            return Redirect::to('admin/post/all')->with('success', 'Thêm bài viết thành công');
        }
    }

    //edit post
    public function edit($id)
    {
        $post = Post::find($id);
        if (Auth::user()->tk == 2 || (Auth::user()->tk == 1 && Auth::user()->id == $post->user_id)) {
            $categories = Category::all();
            return view('admin.post.edit', ['post' => $post, 'categories' => $categories]);
        } else {
            return Redirect::to('admin/post/all')->with('error', 'Bạn không có quyền cập nhật bài viết này');
        }

    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        if (Auth::user()->tk == 2 || (Auth::user()->tk == 1 && Auth::user()->id == $post->user_id)) {

            $validator = Validator::make($request->all(),
                [
                    'title' => 'required|max:255',
                    'description' => 'required|max:500',
                    'contents' => 'required',
                    'category_id' => 'required',
                    'thumbnail' => 'image|mimes:jpeg,png,jpg|max:2048'
                ],

                [
                    'required' => ':attribute không được để trống',
                    'max' => ':attribute không được lớn hơn :max kí tự',
                    'image' => ':attribute phải là file ảnh',
                    'mimes' => ':attribute định dạng ảnh là :mimes'
                ],

                [
                    'title' => 'Tiêu đề',
                    'description' => 'Mô tả',
                    'contents' => 'Nội dung',
                    'category_id' => 'Danh mục',
                    'thumbnail' => 'Ảnh',
                ]
            );
            if ($validator->fails()) {
                return Redirect::to('admin/post/edit/' . $id)->withErrors($validator);
            } else {
                $post->title = $request->title;
                $post->description = $request->description;
                $post->contents = $request->contents;
                $post->category_id = $request->category_id;
                $status = (isset($request->status)) ? 1 : 0;
                $post->status = $status;
                if ($request->hasFile('thumbnail')) {
                    $file = $request->file('thumbnail');
                    $format = $file->getClientOriginalExtension();
                    if ($format != 'jpg' && $format != 'png' && $format != 'jpeg') {
                        return Redirect::to('admin/post/edit/' . $id)->with('error', 'Định dang ảnh chỉ có thể là jpg, png, jpeg');
                    }
                    $name = $file->getClientOriginalName();
                    $thumbnail = Str::random(4) . "_" . $name;
                    while (file_exists("uploads/imagePost/" . $thumbnail)) {
                        $thumbnail = Str::random(4) . "_" . $name;
                    }
                    $file->move(public_path() . '/uploads/imagePost/', $thumbnail);
                    $post->thumbnail = $thumbnail;
                }
                $post->save();
                return Redirect::to('admin/post/all')->with('success', 'Cập nhật bài viết thành công');
            }
        } else {
            return Redirect::to('admin/post/all')->with('error', 'Thất bại! Bạn không có quyền cập nhật bài viết này');
        }
    }

    //Delete post
    public function delete($id)
    {
        if (Auth::user()->tk != 2) {
            return Redirect::to('admin/post/all')->with('error', 'Liên hệ quản trị viên để xoá bài viết này');
        }
        $post = Post::find($id);
        if(file_exists('public/uploads/imagePost/'.$post->thumbnail) AND !empty($post->thumbnail)){
            unlink("public/uploads/imagePost/" . $post->thumbnail);
        }
        Rating::where('post_id', $id)->delete();
        Comment::where('post_id', $id)->delete();
        $post->delete();
        return Redirect::to('admin/post/all')->with('success', 'Xoá bài viết thành công');
    }

    //Delete comment
    public function delete_comment($id)
    {
        $delete = Comment::where('id', $id)->delete();
        if ($delete) {
            return redirect::back()->with('msg', 'Xoá thành công');
        } else {
            return redirect::back()->with('msg', 'Xoá không thành công');
        }
    }
}
