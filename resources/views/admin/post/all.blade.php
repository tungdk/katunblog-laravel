@extends('admin.admin_layout')
@section('title','Quản lý bài viết')
@section('head')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
@endsection
@section('admin_content')

    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-info" style="color: green">
                {{session('success')}}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-info" style="color: red">
                {{session('error')}}
            </div>
        @endif
        <table id="example" class="table table-bordered b-t b-light" style="width:100%; background-color: white">
            <thead>
            <tr>
                <th>ID</th>
                <th>Ảnh</th>
                <th>Tiêu đề</th>
                <th>Danh mục</th>
                <th>Trang thái</th>
                <th>Tác giả</th>
                <th>Ngày đăng</th>
                <th class="text-center"><a href="{{URL::to('admin/post/add')}}" class="btn btn-success btn-sm">
                        <i class="glyphicon glyphicon-plus"></i>
                    </a>
                </th>
            </tr>
            </thead>
            <tbody>

            @foreach ($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td><img src="public/uploads/imagePost/{{$post->thumbnail}}" width="150px" height="100px"></td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->category->title}}</td>
                    <td>
                        @if($post->status == 1)
                            <span style="color: green">Hiển thị</span>
                        @elseif($post->status == 0)
                            <span style="color: #8c8c8c">Ẩn</span>
                        @endif
                    </td>
                    <td>{{$post->user->name}}</td>
                    <td>{{$post->created_at}}</td>

                    <td>
                        <a href="admin/post/detail/{{$post->id}}" class="active styling-edit " ui-toggle-class=""
                           title="Xem bài viết">
                            <i class="fa fa-eye  text-active"></i>
                        </a>
                        @if(Auth::user()->tk == 2 || (Auth::user()->tk == 1 && Auth::user()->id == $post->user_id))
                            <a href="admin/post/edit/{{$post->id}}"
                               class="active styling-edit @if(Auth::user()->tk == 1 && ((Auth::user())->id != ($post->user_id))) disabled @endif"
                               ui-toggle-class="" title="Cập nhật bài viết">
                                <i class="fa fa-pencil-square-o text-success text-active"></i>
                            </a>
                        @endif
                        @if(Auth::user()->tk == 2)
                            <a href="admin/post/delete/{{$post->id}}"
                               onclick="return confirm('Bạn có muốn xoá bài viết này không?')"
                               class="active styling-edit @if(Auth::user()->tk == 1 && ((Auth::user())->id != ($post->user_id))) disabled @endif"
                               ui-toggle-class="" title="Xoá bài viết">
                                <i class="fa fa-times text-danger text"></i>
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach

            </tbody>

        </table>
    </div>
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                "order": [[0, "desc"]]
            });
        });
    </script>

@endsection
