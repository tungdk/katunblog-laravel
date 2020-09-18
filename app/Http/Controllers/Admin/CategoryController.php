<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use DB;
use App\Category;
use App\Author;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Session;
session_start();
use Illuminate\Support\Facades\Validator;
use Response;
use App\http\Requests;
use Symfony\Component\Console\Input\Input;

class CategoryController extends Controller
{
    public function add(){
        return view('admin.category.add');
    }
    public function all(){
        $categories = Category::all()->sortByDesc('id');
        return view('admin.category.all',['categories'=> $categories]);
    }
    public function create(Request $request){
//        die($request->all());
        $validator = Validator::make($request->all(),
            [
                'title' => 'required|max:255',
                'description' => 'required|max:255',
                'color' => 'required|integer|between:1,5'
            ],

            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute không được lớn hơn :max',
                'integer' => ':attribute chỉ được chọn trong đề xuất',
            ],

            [
                'title' => 'Tiêu đề',
                'description' => 'Mô tả',
                'color' => 'Màu hiển thị',
            ]
        );
        if($validator->fails())
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ]);
        else{
            $cate = new Category;
            $cate->title = $request->title;
            $cate->description = $request->description;
            $cate->color = $request->color;
            $cate->save();
            return response()->json([
                'error' => false,
                'message' => 'success'
            ]);
        }

    }
    //edit
    public function edit($id){
        $category_edit = Category::find($id);
        return view('admin.category.edit')->with('category_edit',$category_edit);
    }
    //update
    public function update(Request $request,$id){
        $cate = Category::find($id);
        $validator = Validator::make($request->all(),
            [
                'title' => 'required|max:255',
                'description' => 'required|max:255',
                'color' => 'required|integer|between:1,5'
            ],

            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute không được lớn hơn :max',
                'integer' => ':attribute chỉ được chọn trong đề xuất',
            ],

            [
                'title' => 'Tiêu đề',
                'description' => 'Mô tả',
                'color' => 'Màu hiển thị',
            ]
        );
        if($validator->fails())
            return Redirect::to('admin/category/edit/'.$id)->withErrors($validator);
        else{
            $cate->title = $request->title;
            $cate->description = $request->description;
            $cate->color = $request->color;
            $cate->save();
            return Redirect::to('admin/category/all')->with('msg','Cập nhật thành công');
        }
    }

    //delete
    public function delete($id){
        $post = Post::where('category_id',$id)->first();
        if(!$post){
            $delete = Category::where('id',$id)->delete();
            if($delete){
                return Redirect::to('admin/category/all')->with('msg','Xoá thành công');
            }
            else{
                return Redirect::to('admin/category/all')->with('msg','Xoá không thành công');
            }
        }
        else{
            return Redirect::to('admin/category/all')->with('msg','Thất bại! Danh mục này còn bài viết');
        }
    }
    public function search(Request $request){
        $output = "";
        $categories = Category::where('title', 'LIKE','%'.$request->search.'%')->get();
        if($categories){
            foreach ($categories as $cate){
                $output.='<tr>'.
                    '<td>'.$cate->id.'</td>'.
                    '<td>'.$cate->title.'</td>'.
                    '<td>'.$cate->description.'</td>'.
//                    '<td>'.
//                            if($cate->color==1){
//                                return '<p style="color: green;">Màu xanh lá</p>';
//                            }
//                            elseif($cate->color==2){
//                                return '<p style="color: orange;"> Màu cam</p>';
//                            }
//                            elseif($cate->color==3){
//                                return '<p style="color: blue;">Màu xanh dương</p>';
//                            }
//                            elseif($cate->color==4){
//                                return '<p style="color: violet;">Màu tím</p>';
//                            }
//                            elseif($cate->color==5){
//                                return '<p style="color: red;">Màu đỏ</p>';
//                            }
//                    '</td>'.
//                    '<td>
//                            <a href="'.router('category.edit'.$cate->id).'" class="active styling-edit" ui-toggle-class="">
//                                        <i class="fa fa-pencil-square-o text-success text-active"></i>
//                                    </a>
//                             <a href="'.router('category.delete'.$cate->id).'" class="active styling-edit" ui-toggle-class="" onclick="return confirm("Bạn có muốn xoá danh mục này không?")" >
//                                        <i class="fa fa-times text-danger text"></i>
//                                    </a>
//                    </td>'.
                    '</tr>';
            }
        }
        return response($output);
    }
}
