@extends('admin.admin_layout')
@section('title','Chi tiết bạn đọc')
@section('head')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
@endsection
@section('admin_content')

        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Xem thông tin bạn đọc
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <div class="col-md-4">
                            <img src="public/uploads/imageAuthor/{{$user->avatar}}" width="100%">
                        </div>
                        <div class="col-md-8">
                            <h2>Tác giả: {{$user->name}}</h2>
                            <h2>Liên hệ: {{$user->contact}}</h2>
                            <h2>Email: {{$user->email}}</h2>
                            @If($user->status == 1)
                                <h2 style="color: green"> Trang thái tài khoản: Đang mở </h2>
                            @else
                                <h2 style="color: red"> Trang thái tài khoản: Đang khoá </h2>
                                @endif
                                <a href="admin/user/edit/{{$user->id}}" type="button"
                                   class="btn btn-warning">Sửa</a>
                            @if(Auth::user()->tk == 2)
                                <a href="admin/user/delete/{{$user->id}}" type="button"
                                   class="btn btn-danger"
                                   onclick="return confirm('Bạn có chắc chắn xóa không ?')">xoá</a>
                                @endif
                        </div>

                        <div class="col-md-12">
                            <h2>Giới thiệu: {{$user->story}}</h2>
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
                            <table id="example" class="table table-bordered b-t b-light"  style="width:100%; background-color: white" >
                                <thead>
                                <tr>
                                    <th>PostID</th>
                                    <th>Tiêu đề</th>
                                    <th>Nội dung</th>
                                    <th>Thời gian</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($comments as $cmt)
                                    <tr>
                                        <td>{{$cmt->post_id}}</td>
                                        <td>{{$cmt->post->title}}</td>
                                        <td>{{$cmt->message}}</td>
                                        <td>{{$cmt->created_at}}</td>
                                        <td>
                                            {{--                        <a href="admin/post/detail/{{$post->id}}" type="button" class="btn btn-primary">Xem</a>--}}
                                            {{--                        <a href="admin/post/edit{{$post->id}}" type="button" class="btn btn-success">Sửa</a>--}}
                                            <a href="admin/comment/delete/{{$cmt->id}}" type="button" onclick="return confirm('Bạn có chắc chắn xóa không ?')" class="btn btn-warning">Xoá</a>
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
@section('js')
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>

@endsection
