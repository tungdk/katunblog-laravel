<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class RegisterController extends Controller
{
    public function RegisterEmail(Request $request){
        $validator = Validator::make($request->all(),
            [
                'name' => 'required|max:50',
                'email' => 'required|unique:users|email',
                'password' => 'required|min:6',
                'password_confirmation'=>'required|same:password'
            ],

            [
                'required' => ':attribute không được để trống',
                'email' => ':attribute nhập đúng định dạng email',
                'max' => ':attribute không được lớn hơn :max kí tự',
                'min' => ':attribute không được nhỏ hơn :min kí tự',
                'unique' => ':attribute đã tồn tại',
                'same:password'=>'không chính xác'
            ],

            [
                'name' => 'Tên',
                'email' => 'Email',
                'password' => 'Mật khẩu',
                'password_confirmation'=>'Nhập lại mật khẩu'
            ]
        );
        if($validator->fails()){
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ]);
        }
        else{
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->avatar = "author.png";
            $register = $user->save();
            if ($register) {
                return response()->json([
                    'error' => false,
                    'message' => 'Success'
                ]);
            } else {
                $errors = new MessageBag(['errorLogin' => 'Có lỗi xảy ra, vui lòng thử lại!']);
                return response()->json([
                    'error' => true,
                    'message' => $errors
                ]);
            }
        }
    }
}
