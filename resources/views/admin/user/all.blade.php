@extends('admin.admin_layout')
@section('title','Quản lý bạn đọc')
@section('head')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
@endsection
@section('admin_content')

    <div class="container-fluid">
        @if(session('msg'))
            <div class="alert alert-info">
                {{session('msg')}}
            </div>
        @endif
        <table id="example" class="table table-bordered b-t b-light" style="width:100%; background-color: white">
            <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Ảnh đại diện</th>
                <th>Giới thiệu</th>
                <th>Liên hệ</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td><img src="public/uploads/imageAuthor/{{$user->avatar}}" width="100px" height="100px"></td>
                    <td>{{$user->story}}</td>
                    <td>{{$user->contact}}</td>
                    <td>
                        @if($user->status == 1)
                            <span style="color: green">Hoạt động</span>
                        @else
                            <span style="color: red">Khoá</span>
                        @endif
                    </td>

                    <td>
                        <a href="admin/user/detail/{{$user->id}}" class="active styling-edit " ui-toggle-class="">
                            <i class="fa fa-eye  text-active"></i>
                        </a>
                        {{--                <a href="admin/post/detail/{{$post->id}}" type="button" class="btn btn-primary"><i class="fa fa-eye"></i></a>--}}
                        <a href="admin/user/edit/{{$user->id}}"
                           class="active styling-edit @if(Auth::user()->tk == 0 && ((Auth::user())->id != ($post->author_id))) disabled @endif"
                           ui-toggle-class="">
                            <i class="fa fa-pencil-square-o text-success text-active"></i>
                        </a>
                        @if(Auth::user()->tk == 2)
                            <a href="admin/user/delete/{{$user->id}}"
                               onclick="return confirm('Mọi thông tin liên quan đến bạn đọc này sẽ bị xoá. Bạn có muốn muốn làm điều này?')"
                               class="active styling-edit @if(Auth::user()->tk == 0 && ((Auth::user())->id != ($post->author_id))) disabled @endif"
                               ui-toggle-class="">
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
