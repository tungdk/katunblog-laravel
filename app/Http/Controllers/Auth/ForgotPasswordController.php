<?php


namespace App\Http\Controllers\Auth;


use App\User;
use App\Http\Controllers\PagesController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Mail;

class ForgotPasswordController extends PagesController
{
    public function getFormEmailResetPassword()
    {
        return view('pages.forgot_password');
    }

    public function postFormEmailResetPassword(Request $request)
    {
        $email = $request->email;
        $existEmail = User::where('email', '=', $email)->first();
        if ($existEmail) {
            $code = bcrypt(md5(time() . $email));

            $existEmail->code = $code;
            $existEmail->time_code = Carbon::now();
            $existEmail->save();

            $url = route('get.link.reset.password', ['code' => $existEmail->code, 'email' => $email]);
            $data = [
                'route' => $url
            ];
            Mail::send('emails.email_forgot_pwd', $data, function ($mail) use ($request) {
                $mail->to($request->email);
                $mail->from('khactungdinh.228@gmail.com');
                $mail->subject('Quên mật khẩu');
            });
            return Redirect::back()->with('success', 'Truy cập email để tiếp tục lấy lại tài khoản');
        } else {
            return Redirect::back()->with('error', 'Email không tồn tại');
        }
    }

    public function getFormResetPassword(Request $request)
    {
        $code = $request->code;
        $email = $request->email;
        $checkUser = User::where(['code' => $code, 'email' => $email])->first();
        if (!$checkUser) {
            return redirect('password/email')->with('msg', 'Đường dẫn không hợp lệ. bạn vui lòng điền email để lấy lại mật khẩu');
        }
        return view('pages.reset_password');
    }

    public function postFormResetPassword(Request $request)
    {
        $code = $request->code;
        $email = $request->email;
        $checkUser = User::where(['code' => $code, 'email' => $email])->first();
        if (!$checkUser) {
            return redirect('password/email')->with('msg', 'Đường dẫn không hợp lệ. bạn vui lòng điền email để lấy lại mật khẩu');
        }
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6',
            'comfirm_password' => 'required|same:password'
        ],
            [
                'password.required' => 'Bạn vui lòng nhập mật khẩu',
                'password.min' => 'Mật khẩu mới tối thiểu 6 kí tự',
                'comfirm_password.required' => 'Bạn vui lòng nhập xác nhận mật khẩu mới',
                'comfirm_password.same' => 'Xác nhận mật khẩu không chính xác'
            ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {
            $checkUser->password = bcrypt($request->password);
            $checkUser->save();
            return Redirect::back()->with('success', 'Đổi mật khẩu thành công. Mời đăng nhập lại');
        }
    }
}
