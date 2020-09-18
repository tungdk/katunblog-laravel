@extends('admin.admin_layout')
@section('title','Quản lý danh mục')
@section('admin_content')
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Quản lý danh mục
                    <input type="text" id="search" name="search" >
                </div>

                @if(session('msg'))
                    <div class="alert alert-info">
                        {{session('msg')}}
                    </div>
                @endif
                <div>
                    <table class="table" id="table" ui-jq="footable" ui-options='{
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
                            <th>Tiều đề</th>
                            <th>Mô tả</th>
                            <th data-breakpoints="xs">Màu hiển thị</th>
                            <th>
{{--                                <a href="{{URL::to('admin/category/add')}}" class="btn btn-success styling-edit" >--}}
{{--                                    <i class="glyphicon glyphicon-plus"></i>--}}
{{--                                </a>--}}
                                <button type="button" class="btn btn-primary" onclick="testGrowl()">
                                    Test bs growl
                                </button>
                                <button type="button" class="btn btn-primary" data-toggle="modal" href="javascript:void(0)" onclick="openAddCategoryModal()">
                                    <i class="glyphicon glyphicon-plus"></i>
                                </button>
                            </th>
                        </tr>
                        </thead>

                        <tbody id="ajax">

                        </tbody>

                        <tbody id="table_cate">
                        @foreach($categories  as  $cate)
                            <tr>
                                <td>{{$cate->id}}</td>
                                <td>{{$cate->title}}</td>
                                <td><span class="text-ellipsis">{{$cate->description}}</span></td>
                                {{--                        <td><span class="text-ellipsis">{{$cate->color}}</span></td>--}}
                                <td>
                                    @if($cate->color==1)
                                        <p style='color: green'>Màu xanh lá</p>

                                    @elseif($cate->color==2)
                                        <p style='color: orange'> Màu cam</p>

                                    @elseif($cate->color==3)
                                        <p style='color: blue'>Màu xanh dương</p>

                                    @elseif($cate->color==4)
                                        <p style='color: violet'>Màu tím</p>

                                    @else($cate->color==5)
                                        <p style='color: red'>Màu đỏ</p>

                                    @endif


                                </td>
                                <td>
                                    <a href="{{URL::to('admin/category/edit/'.$cate->id)}}" class="active styling-edit" ui-toggle-class="">
                                        <i class="fa fa-pencil-square-o text-success text-active"></i>
                                    </a>
                                    <a href="{{URL::to('admin/category/delete/'.$cate->id)}}" onclick="return confirm('Bạn có muốn xoá danh mục này không?')" class="active styling-edit" ui-toggle-class="">
                                        <i class="fa fa-times text-danger text"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @include('admin.category.test')
@endsection
@section('js')
    <script src="{{asset('public/admin/category/category.js')}}"></script>

@endsection
