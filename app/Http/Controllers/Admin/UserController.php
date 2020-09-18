<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Post;
use App\Rating;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function all(){
        $users = User::where('tk',0)->orderByDesc('id')->get();
        return view('admin.user.all',['users'=> $users]);
    }
    public function detail($id){
        $user = User::find($id);
        $comments = Comment::where('user_id','=',$id)->get();
        return view('admin.user.detail', [
            'user'=> $user,
            'comments' =>$comments
        ]);
    }
    public function delete_comment($id){
        $delete = Comment::where('id',$id)->delete();
        if($delete){
            return redirect::back()->with('msg','Xoá thành công');
        }
        else{
            return Redirect::to('admin/comment/all')->with('msg','Xoá không thành công');
        }
    }
    public function edit($id){
        $user = User::find($id);
        return view('admin.user.edit',['user'=> $user]);
    }

    //update
    public function update(Request $request, $id){
        $user = User::find($id);
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
            return Redirect::to('admin/user/edit/'.$id)->withErrors($validator);
        else{
            $user->name = $request->name;
            $user->story = $request->story;
            $user->contact = $request->contact;
            $user->email = $request->email;
            $status = (isset($request->status)) ? 1 : 0;
            $user->status = $status;
            $user->tk = $request->tk;

            if($request->hasFile('avatar')){
                $file = $request->file('avatar');
//                echo($file);
//                die();
                $format = $file->getClientOriginalExtension();
                if ($format != 'jpg' && $format != 'png' && $format != 'jpeg'){
                    return Redirect::to('admin/user/add')->with('msg','Định dang ảnh chỉ có thể là jpg, png, jpeg');
                }
                $name = $file->getClientOriginalName();
                $avatar = Str::random(4)."_".$name;
                while(file_exists("uploads/imageAuthor/".$avatar)){
                    $avatar = Str::random(4)."_".$name;
                }
                $file->move(public_path().'/uploads/imageAuthor/',$avatar);
                unlink("public/uploads/imageAuthor/".$user->avatar);
                $user->avatar = $avatar;
            }

            $user->save();
            return Redirect::to('admin/user/all')->with('msg','Sửa bạn đọc thành công');
        }
    }

    public function delete($id){
        if (Auth::user()->tk != 2) {
            return Redirect::to('admin/user/all')->with('msg', 'Liên hệ quản trị viên để xoá bạn đọc này');
        }
        Rating::where('user_id', $id)->delete();
        Comment::where('user_id', $id)->delete();
        User::where('id',$id)->delete();
        return Redirect::to('admin/user/all')->with('msg','Xoá thành công');
    }
}
