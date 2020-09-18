@extends('admin.admin_layout')
@section('title','Chi tiết bài viết')
@section('admin_content')

    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Xem chi tiết bài viết
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <div class="col-md-12">
                        <div class="col-md-8">
                            <h2>Tiêu đề: {{$post->title}}</h2>
                            <h3>Mô tả: {!! $post->description !!}</h3>
                            <h3>Danh mục: {{$post->category->title}}</h3>
                            <h3>Tác giả: {{$post->user->name}}</h3>
                            <h3>Lượt xem: {{$post->view}}</h3>
                            <h3>
                                Trạng thái:
                                @if($post->status==1)
                                    <span style="color: green">Hiển thị</span>
                                @else
                                    <span style="color: #8c8c8c">Ẩn</span>
                                @endif
                            </h3>
                        </div>
                        <div class="col-md-4">

                            <a href="{{URL::to('admin/post/edit/'.$post->id)}}" type="button"
                               class="btn btn-success @if(Auth::user()->tk == 0 && ((Auth::user())->id != ($post->user_id))) disabled @endif">Sửa</a>
                            <a href="{{URL::to('admin/post/delete/'.$post->id)}}" type="button"
                               class="btn btn-warning @if(Auth::user()->tk == 0 && ((Auth::user())->id != ($post->user_id))) disabled @endif">xoá</a>
                            <a href="{{URL::to('admin/post/all')}}" type="button" class="btn btn-primary">Trở về</a>
                        </div>

                    </div>
                    <div class="col-md-12" align="center" style="margin: 30px 0 30px 0">
                        <img src="{{URL::to('public/uploads/imagePost/'.$post->thumbnail)}}" width="50%" height="50%">
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <h3>Nội dung bài viết</h3><br>
                        <div style="background-color: white">
{{--                            <div class="container" >--}}
                                {!! $post->contents !!}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <h2>Lịch sử bình luận</h2>
                    <div class="container-fluid">
                        @if(session('msg'))
                            <div class="alert alert-info">
                                {{session('msg')}}
                            </div>
                        @endif
                        <table id="example" class="table table-bordered b-t b-light"
                               style="width:100%; background-color: white">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Họ tên</th>
                                <th>Nội dung</th>
                                <th>Thời gian</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($comments as $cmt)
                                <tr>
                                    <td>{{$cmt->id}}</td>
                                    <td>{{$cmt->user->name}}</td>
                                    <td>{{$cmt->message}}</td>
                                    <td>{{$cmt->created_at}}</td>
                                    <td>
                                        {{--                        <a href="admin/post/detail/{{$post->id}}" type="button" class="btn btn-primary">Xem</a>--}}
                                        {{--                        <a href="admin/post/edit{{$post->id}}" type="button" class="btn btn-success">Sửa</a>--}}
                                        <a href="admin/post/delete_comment/{{$cmt->id}}" type="button"
                                           onclick="return confirm('Bạn có chắc chắn xóa không ?')"
                                           class="btn btn-warning">Xoá</a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
