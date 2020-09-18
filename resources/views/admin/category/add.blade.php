@extends('admin.admin_layout')
@section('title','Thêm danh mục')
@section('admin_content')

    {{--<div class="container" style="margin-top: 50px">--}}
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm mới danh mục
            </header>
            @if(session('msg'))
                <div class="alert alert-warning">
                    {{session('msg')}}
                </div>
            @endif
            <div class="panel-body">
                <div class="position-center">
                    <form action="admin/category/add" method="POST" role="form" id="form_add">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">Tên danh mục</label>
                            <input type="text" class="form-control" id="title" placeholder="" name="title"
                                   required="required">
                            {{--            <p class="error-input" id="err-title">Bạn chưa nhập tên danh mục</p>--}}
                        </div>
                        <div class="form-group">
                            <label for="">Mô tả</label>
                            <input type="text" class="form-control" id="description" placeholder="" name="description"
                                   >
                            {{--            <p class="error-input" id="err-description">Bạn chưa nhập mô tả danh mục</p>--}}
                        </div>
                        <div class="form-group">
                            <label for="">Màu hiển thị</label>
                            <select id="" name="color">
                                <option value="1">Màu Xanh lá</option>
                                <option value="2">Màu cam</option>
                                <option value="3">Màu xanh dương</option>
                                <option value="4">Màu tím</option>
                                <option value="5">Màu đỏ</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" id="btn-submit">Thêm</button>
                        {{--        <a href="categories.php" type="submit"  class="btn btn-warning" >Huỷ</a>--}}
                    </form>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>

{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $("#form_add").validate({--}}
{{--                onfocusout: false,--}}
{{--                onkeyup: false,--}}
{{--                onclick: false,--}}
{{--                rules: {--}}
{{--                    "title": {--}}
{{--                        required: true,--}}
{{--                        maxlength: 255--}}
{{--                    },--}}
{{--                    "description": {--}}
{{--                        required: true,--}}
{{--                        maxlength: 255--}}
{{--                    },--}}
{{--                    "color": {--}}
{{--                        required: true,--}}
{{--                        isInteger: true,--}}
{{--                        // between: 1,5--}}
{{--                    },--}}

{{--                },--}}
{{--                messages: {--}}
{{--                    "title": {--}}
{{--                        required: "Bắt buộc nhập tiêu đề",--}}
{{--                        maxlength: "Tiều đề không quá 255 ký tự"--}}
{{--                    },--}}
{{--                    "description": {--}}
{{--                        required: "Bắt buộc nhập mô tả",--}}
{{--                        maxlength: "Mô tả không quá 255 ký tự"--}}
{{--                    },--}}
{{--                    "color": {--}}
{{--                        required: "Bắt buộc nhập màu hiển thị",--}}
{{--                        isInteger: "Màu hiển thị phải là số nguyên"--}}
{{--                    }--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
@endsection
