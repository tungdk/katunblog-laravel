<?php

namespace App\Http\Controllers\Admin;


use App\User;
use App\Http\Controllers\Controller;
use App\Post;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthorController extends Controller
{

    public function all(){
        $authors = User::where('tk',1)->orWhere('tk',2)->orderByDesc('id')->get();
        return view('admin.author.all',['authors'=> $authors]);
    }
    public function detail($id){
        $author = User::find($id);
        $comments = Comment::where('user_id','=',$id)->get();
        return view('admin.author.detail',['author'=> $author,'comments'=>$comments]);
    }
    public function delete_comment($id){
        $delete = Comment::where('id',$id)->delete();
        if($delete){
            return redirect::back()->with('success','Xoá thành công');
        }
        else{
            return redirect::back()->with('error','Xoá không thành công');
        }
    }

    public function edit($id){
        if (Auth::user()->tk != 2) {
            return Redirect::to('admin/author/all')->with('error', 'Liên hệ quản trị viên để sửa tác giả này');
        }
        $author = User::find($id);
        return view('admin.author.edit',['author'=> $author]);
    }

    //update
    public function update(Request $request, $id){
        if (Auth::user()->tk != 2) {
            return Redirect::to('admin/author/all')->with('error', 'Liên hệ quản trị viên để sửa tác giả này');
        }
        $author = User::find($id);
        $validator = Validator::make($request->all(),
            [
                'name' => 'required|max:50',
                'story' => 'required|max:255',
                'contact' => 'required|max:255',
                'email' => 'required',
            ],

            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute không được lớn hơn :max kí tự',
                'min' => ':attribute không được nhỏ hơn :min kí tự',
                'unique' => ':attribute đã tồn tại'
            ],

            [
                'name' => 'Tên',
                'story' => 'Giới thiệu',
                'contact' => 'Liên hệ',
                'email' => 'Email',
            ]
        );
        if($validator->fails())
            return Redirect::to('admin/author/edit/'.$id)->withErrors($validator);
        else{
            $author->name = $request->name;
            $author->story = $request->story;
            $author->contact = $request->contact;
            $author->email = $request->email;

            $status = 0;
            if(isset($request->status)){
                $status = $request->status;
            }
            $author->status = $status;
            if($request->hasFile('avatar')){
                $file = $request->file('avatar');
                $format = $file->getClientOriginalExtension();
                if ($format != 'jpg' && $format != 'png' && $format != 'jpeg'){
                    return Redirect::to('admin/author/add')->with('error','Định dang ảnh chỉ có thể là jpg, png, jpeg');
                }
                $name = $file->getClientOriginalName();
                $avatar = Str::random(4)."_".$name;
                while(file_exists("uploads/imageAuthor/".$avatar)){
                    $avatar = Str::random(4)."_".$name;
                }
                $file->move(public_path().'/uploads/imageAuthor/',$avatar);
                unlink("public/uploads/imageAuthor/".$author->avatar);
                $author->avatar = $avatar;
            }

            $author->save();
            return Redirect::to('admin/author/all')->with('success','Sửa tác giả thành công');
        }
    }

    public function delete($id){
        if (Auth::user()->tk != 2) {
            return Redirect::to('admin/author/all')->with('error', 'Liên hệ quản trị viên để sửa tác giả này');
        }
        $post = Post::where('user_id',$id)->first();
        if(!$post){
            $delete = User::where('id',$id)->delete();
            if($delete){
                return Redirect::to('admin/author/all')->with('success','Xoá thành công');
            }
            else{
                return Redirect::to('admin/author/all')->with('error','Xoá không thành công');
            }
        }
        else{
            return Redirect::to('admin/author/all')->with('error','Không thành công! Bài viết của tác giả này vẫn tồn tại');
        }
    }
}
