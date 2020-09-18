<?php


namespace App\Http\Controllers\Pages;


use App\Http\Controllers\PagesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class ContactController extends PagesController
{
    public function contact()
    {
        return view('pages.contact');
    }

    public function postcontact(Request $request)
    {
        $ruler = [
            'name' => 'required',
            'email' => 'required|email',
            'contents' => 'required|max:255'
        ];
        $message = [
            'name.required' => 'Bạn chưa nhập tên',
            'email.required' => 'Bạn chưa nhập Email',
            'email.email' => 'Định dạng email không hợp lệ',
            'contents.max' => 'Nội dung không quá 255 ký tự',

        ];
        $validator = Validator::make($request->all(), $ruler, $message);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ]);
        } else {
            Mail::send('emails.email_contact', [
                'name' => $request->name,
                'email' => $request->email,
                'contents' => $request->contents,
            ], function ($mail) use ($request) {
                $mail->to('tungdk228@gmail.com', $request->name);
                $mail->from($request->email);
                $mail->subject('Phản hồi về trang web');
            });
            $success = new MessageBag(['contact' => 'Gửi phản hồi thành công!']);
            return response()->json([
                'error' => false,
                'message' => $success
            ]);
        }
    }
}
