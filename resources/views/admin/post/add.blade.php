@extends('admin.admin_layout')
@section('title','Thêm bài viết')
@section('head')
    <script src="{{asset('public/admin/ckeditor/ckeditor.js')}}"></script>
@endsection
@section('admin_content')
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm mới bài viết
            </header>
            @if(session('msg'))
                <div class="alert alert-warning">
                    {{session('msg')}}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="panel-body">
                <div class="position-center">
                    <form action="{{URL::to('admin/post/add')}}" method="POST" role="form" name="foo"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="">
                        <div class="form-group">
                            <label for="">Tiêu đề bài viết</label>
                            <input type="text"  class="form-control" id="" value="" placeholder="" name="title"
                                   required="required">
                        </div>

                        <div class="form-group">
                            <label for="">Ảnh bìa</label>
                            <input type="file"  class="form-control" id="" value="" placeholder="" name="thumbnail"
                                   required="required">
                        </div>

                        <div class="form-group">
                            <label for="">Trạng thái hiển thị</label>
                            <input type="checkbox" id="" value="" placeholder="" name="status"><i>(Tích để hiển thị bài
                                viết)</i>
                        </div>

                        <div class="form-group">
                            <label for="">Danh mục</label>
                            <select id="" name="category_id">
                                @foreach ($categories as $cate)
                                    <option value="{{$cate->id}}">{{$cate->title}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Mô tả</label><br>
                            <textarea id="description" name="description" rows="3" cols="150" required="required">
                </textarea>
                            <script>CKEDITOR.replace('description');</script>
                        </div>

                        <div class="form-group">
                            <label for="">Nội dung</label><br>
                            <textarea id="contents" name="contents" rows="20" cols="150" required="required">
                </textarea>
                            <script>CKEDITOR.replace('contents');</script>
                        </div>

                        <button type="submit" class="btn btn-primary" title="Thêm" style="margin-bottom: 50px">Thêm
                        </button>
                        <a href="{{URL::to('admin/post/all')}}" type="button" class="btn btn-warning" title="Huỷ"
                           style="margin-bottom: 50px">Huỷ</a>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
