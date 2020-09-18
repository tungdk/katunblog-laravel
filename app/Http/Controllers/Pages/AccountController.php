<?php

namespace App\Http\Controllers\Pages;

use App\User;
use App\Comment;
use App\Http\Controllers\PagesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;

class AccountController extends PagesController
{
    public function getAccount(){
        if(Auth::check()){
            $user_id =  Auth::id();
            $user = User::where('id',$user_id)->first();
            return view('pages.account',['user'=>$user]);
        }
        return view('pages.account');
    }
    public function postAccount(Request $request){
        $user_id = Auth::user()->id;
        $user = user::find($user_id);
        $validator = Validator::make($request->all(),
            [
                'name' => 'required|max:50|min:3',
            ],

            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute không được lớn hơn :max kí tự',
                'min' => ':attribute không được nhỏ hơn :min kí tự',
            ],

            [
                'name' => 'Tên',
            ]
        );
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {
            $user->name = $request->name;
            $user->story = $request->story;
            $user->contact = $request->contact;

            if($request->hasFile('avatar')){
                $file = $request->file('avatar');
                $format = $file->getClientOriginalExtension();
                if ($format != 'jpg' && $format != 'png' && $format != 'jpeg'){
                    return Redirect::back()->with('msg','Định dang ảnh chỉ có thể là jpg, png, jpeg!');
                }
                $name = $file->getClientOriginalName();
                $avatar = Str::random(4)."_".$name;
                while(file_exists("uploads/imageAuthor/".$avatar)){
                    $avatar = Str::random(4)."_".$name;
                }
                $file->move(public_path().'/uploads/imageAuthor/',$avatar);
                //unlink("public/uploads/imageAuthor/".$user->avatar);
                $user->avatar = $avatar;
            }

            $user->save();
            return Redirect::to('user/account')->with('success','Đổi thông tin thành công');

        }
    }
    public function getUserComment(){
        if(Auth::check()){
            $user_id =  Auth::id();
            $user = User::where('id',$user_id)->first();
            $comments = Comment::where('user_id',Auth::user()->id)->orderByDesc('created_at')->paginate(10);
            return view('pages.usercomment',[
                'comments'=>$comments,
                'user'=>$user
            ]);
        }
        return view('pages.usercomment');
    }
}
