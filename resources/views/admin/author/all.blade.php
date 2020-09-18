@extends('admin.admin_layout')
@section('title','Quản lý tác giả')
@section('admin_content')
{{--    <section class="wrapper">--}}
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Quản lý tác giả
                </div>
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
                <div>
                    <table class="table" ui-jq="footable" ui-options='{
                            "paging": {
                              "enabled": true
                            },
                            "filtering": {
                              "enabled": true
                            },
                            "sorting": {
                              "enabled": true
                            }}'>
                        <thead>
                        <tr>
                            <th data-breakpoints="xs">ID</th>
                            <th>Tên</th>
                            <th>Ảnh đại diện</th>
                            <th>Giới thiệu</th>
                            <th>Liên hệ</th>
                            <th>Trạng thái</th>
                            <th data-breakpoints="xs">Email</th>
                            <th>
                                Hành động
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($authors as $author)
                            <tr>
                                <td>{{$author->id}}</td>
                                <td>{{$author->name}}</td>
                                <td><img src="{{URL::to('public/uploads/imageAuthor/'.$author->avatar)}}" style="width:120px;height:120px" /></td>
                                <td>{{$author->story}}</td>
                                <td>{{$author->contact}}</td>
                                <td>
                                    @if($author->status == 1)
                                        <span style="color: green">Hoạt động</span>
                                    @else
                                        <span style="color: red">Khoá</span>
                                    @endif
                                </td>
                                <td>{{$author->email}}</td>


                                <td>
                                    <a href="{{URL::to('admin/author/detail/'.$author->id)}}" class="active styling-edit" ui-toggle-class="">
                                        <i class="fa fa-eye  text-active"></i>
                                    </a>
                                    @if(Auth::user()->tk == 2)
                                    <a href="{{URL::to('admin/author/edit/'.$author->id)}}" class="active styling-edit" ui-toggle-class="">
                                        <i class="fa fa-pencil-square-o text-success text-active"></i>
                                    </a>
                                    <a href="{{URL::to('admin/author/delete/'.$author->id)}}" onclick="return confirm('Bạn có muốn xoá tác giả này không?')" class="active styling-edit" ui-toggle-class="">
                                        <i class="fa fa-times text-danger text"></i>
                                    </a>
                                    @endif

                                </td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
{{--    </section>--}}
@endsection
