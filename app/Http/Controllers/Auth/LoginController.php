<?php

namespace App\Http\Controllers\Auth;

use App\Author;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use App\Rules\Captcha;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function getLogin()
    {
        return view('pages.login');
    }

    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:3|max:32',
        ],
        [
            'email.required' => 'Bạn chưa nhập Email',
            'email.email' => 'Nhập đúng định dạng email',
            'password.required' => 'Bạn chưa nhập Mật khẩu',
            'password.min' => 'Mật khẩu không được nhỏ hơn 3 ký tự',
            'password.max' => 'Mật khẩu không lớn hơn 32 ký tự',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ]);
        } else {
            $email = $request->email;
            $password = $request->password;
            $login = Auth::attempt(['email' => $email, 'password' => $password,'status' => 1]);
            if ($login) {
                return response()->json([
                    'error' => false,
                    'message' => 'Success'
                ]);
            } else {
                $errors = new MessageBag(['errorLogin' => 'Email hoặc mật khẩu không đúng!']);
                return response()->json([
                    'error' => true,
                    'message' => $errors
                ]);
            }
        }
    }



}
