@extends('admin.admin_layout')
@section('title','Cập nhật bạn đọc')
@section('admin_content')
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật thông tin bạn đọc
            </header>

            <?php if(isset($_COOKIE['msg'])){ ?>
            <div class="alert alert-warning">
                <strong>Thất bại</strong>Cập nhật không thành công
            </div>
            <?php } ?>
            {{--    @foreach($author as $cate)--}}
            <div class="panel-body">
                <div class="position-center">
                    <form action="admin/user/edit/{{$user->id}}" method="post" class="form-disable" role="form"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$user->id}}">
                        <div class="form-group">
                            <label for="">Tên tác giả</label>
                            <input type="text" class="form-control" id="" value="{{$user->name}}" placeholder=""
                                   name="name" required="required">
                        </div>
                        <div class="form-group">
                            <label for="">Giới thiệu</label>
                            <textarea class="form-control" id="" name="story" rows="5"
                                      required="required">{{$user->story}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Liên hệ</label>
                            <input type="text" class="form-control" id="" value="{{$user->contact}}"
                                   placeholder="" name="contact" required="required">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" class="form-control" id="" value="{{$user->email}}" placeholder=""
                                   name="email" required="required">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="">Ảnh đại diện</label>
                            <img class="col-md-2" src="{{URL::to('public/uploads/imageAuthor/'.$user->avatar)}}"
                                 width="150px" height="150px">
                            <input type="file" id="" value="" placeholder="" name="avatar">
                        </div>
                        <br>
                        <div class="form-control col-md-12">
                            <label for="">Trạng thái tài khoản</label>
                            <input {!! ($user->status==1)?'checked':'' !!} type="checkbox" id="" placeholder=""
                                   value="1" name="status"> <em>Check để mở khoá tài khoản</em>
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="">Loại tài khoản</label>
                            <select id="" name="tk">
                                <option value="0">Bạn đọc</option>
                                <option value="1">Tác giả</option>
                            </select>
                        </div>
                        <hr>
                        <button style="margin-top: 20px; margin-bottom: 20px" type="submit"
                                class="btn btn-primary ">Cập nhật
                        </button>
                        <a href="{{URL::to('admin/user/all')}}" type="button" class="btn btn-warning">Huỷ</a>
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
@endsection
