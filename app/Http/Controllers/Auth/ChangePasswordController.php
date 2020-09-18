<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\PagesController;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class ChangePasswordController extends PagesController
{
    public function getChangePassword(){
        if(Auth::check()){
            $user_id =  Auth::id();
            $user = User::where('id',$user_id)->first();
            return view('pages.change_password',[
                'user'=>$user
            ]);
        }
        return view('pages.change_password');
    }

    public function postChangePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password_old' => 'required',
            'password_new' => 'required|min:6',
            'password_confirm' => 'required|same:password_new'
        ],
            [
                'password_old.required' => 'Bạn vui lòng nhập mật khẩu cũ',
                'password_new.required' => 'Bạn vui lòng nhập mật khẩu mới',
                'password_new.min'=>'Mật khẩu mới tối thiểu 6 kí tự',
                'password_confirm.required' => 'Bạn vui lòng nhập xác nhận mật khẩu mới',
                'password_confirm.same' => 'Xác nhận mật khẩu không chính xác'
            ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ]);
        } else {
            $pass_old = $request->password_old;
            $pass_new = $request->password_new;

            $user_password = Auth::User()->password;
            if (Hash::check($pass_old, $user_password)) {
                $user_id = Auth::User()->id;
                $user = user::find($user_id);
                $user->password = Hash::make($pass_new);
                $user->save();
                $success = new MessageBag(['successChangePassword' => 'Đổi mật khẩu thành công']);
                return response()->json([
                    'error' => false,
                    'message' => $success
                ]);
            } else {
                $errors = new MessageBag(['password_old' => 'Mật khẩu cũ không đúng']);
                return response()->json([
                    'error' => true,
                    'message' => $errors
                ]);
            }
        }
    }
}
