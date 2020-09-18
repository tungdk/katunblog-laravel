@extends('admin.admin_layout')
@section('title','Quản lý bình luận')
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
        <table id="example" class="table table-bordered b-t b-light"  style="width:100%; background-color: white" >
            <thead>
            <tr>
                <th>PostID</th>
                <th>Tiêu đề</th>
                <th>Email</th>
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
                    <td><a href="admin/user/detail/{{$cmt->user_id}}">{{$cmt->user->email}}</a></td>
                    <td>{{$cmt->message}}</td>
                    <td>{{$cmt->created_at}}</td>
                    <td>
                        <a href=""
                           data-url="{{route('comment.delete',['id'=>$cmt->id])}}"
                           class="btn btn-warning action_delete">Xoá</a>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{asset('public/admin/comment/comment.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>

@endsection
