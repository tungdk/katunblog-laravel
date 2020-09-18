<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{
    public function all(){
        $comments = Comment::all();
    	return view('admin/comment/all')->with('comments',$comments);
    }
    public function delete($id){
        try {
            $delete = Comment::where('id',$id)->delete();
            return response()->json([
                'code'=>200,
                'message'=>'success'
            ], 200);
//            if($delete){
//                return Redirect::to('admin/comment/all')->with('msg','Xoá thành công');
//            }
//            else{
//                return Redirect::to('admin/comment/all')->with('msg','Xoá không thành công');
//            }
        }catch (\Exception $exception){
            Log::error('Message:' . $exception->getMessage().'----Line : '.$exception->getLine());
            return response()->json([
               'code'=>500,
               'message'=>'failed'
            ], 500);
        }
    }
}

