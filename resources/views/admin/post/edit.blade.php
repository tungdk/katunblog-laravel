@extends('admin.admin_layout')
@section('title','Sửa bài viết')
@section('head')
    <script src="{{asset('public/admin/ckeditor/ckeditor.js')}}"></script>
@endsection
@section('admin_content')
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Sửa bài viết
            </header>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session('msg'))
            <div class="alert alert-warning">
                {{session('msg')}}
            </div>
        @endif
            <div class="panel-body">
                <div class="position-center">
        <form action="{{URL::to('admin/post/edit/'.$post->id)}}" method="POST" role="form" name="foo" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="">
            <div class="form-group">
                <label for="">Tiêu đề bài viết</label>
                <input type="text" class="form-control" id="" value="{{$post->title}}" placeholder="" name="title" required="required">
            </div>

            <div class="form-group">
                <label for="">Ảnh bìa</label><br>
                <img  src="{{URL::to('public/uploads/imagePost/'.$post->thumbnail)}}" width="600px" height="300px">
                <input type="file"  id=""  placeholder="" name="thumbnail">
            </div>

            <div class="form-group">
                <label for="">Trạng thái hiển thị</label>
                <input {!! ($post->status==1)?'checked':'' !!} type="checkbox" id="" placeholder="" value="1" name="status"> <em>Check để hiển thị bài viết</em>
            </div>

            <div class="form-group">
                <label for="">Danh mục</label>
                <select name="category_id" class="form-control">
                    @foreach ($categories as $cate)
                        <option {!! ($post->category_id == $cate->id)?'selected':''!!} value="{{$cate->id}}">{{$cate->title}}</option>
                    @endforeach
                </select>

            </div>

            <div class="form-group">
                <label for="">Mô tả</label><br>
                <textarea id="description" name="description" rows="3" cols="150" required="required">{{$post->description}}
                </textarea>
                <script>CKEDITOR.replace('description');</script>
            </div>

            <div class="form-group">
                <label for="">Nội dung</label><br>
                <textarea id="contents" name="contents" rows="20" cols="150" required="required">{{$post->contents}}
                </textarea>
                <script>CKEDITOR.replace('contents');</script>
            </div>

            <button type="submit" class="btn btn-primary" title="Huỷ" style="margin-bottom: 50px">Cập nhật</button>
            <a href="{{URL::to('admin/post/all')}}" type="button" class="btn btn-warning" title="Huỷ"
               style="margin-bottom: 50px">Huỷ</a>
        </form>
                </div>
            </div>
        </section>
    </div>
@endsection
