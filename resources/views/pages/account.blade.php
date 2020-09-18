@extends('layout')
@section('title','Tài khoản')
@section('content')

    @if((Auth::user()))
        <div class="section" style="margin-top: 50px">
            <div class="container">
                <div class="col-md-3 account-left">
                    <div class="info-account" style="text-align: center">
                        <div class="avatar-account">
                            <img src="{{URL::to('public/uploads/imageAuthor/'.$user->avatar)}}">
                        </div>
                        <div class="name-account">
                            <p>{{$user->name}}</p>
                        </div>
                        <hr>
                        <div class="created_at">
                            <p>Tham gia từ <br>{{$user->created_at}}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="list-action">
                        <ul>
                            <li class="item-action"><a href="{{URL::to('/user/account')}}" class="active-item">Tài khoản
                                    của tôi</a></li>
                            <li class="item-action"><a href="{{URL::to('/user/comment')}}">Hoạt động bình luận</a></li>
                            <li class="item-action"><a href="{{URL::to('/user/change-password')}}">Đổi mật khẩu</a></li>
                            <li class="item-action"><a href="{{URL::to('/logout')}}">Thoát</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8 account-right">
                    @if(session('msg'))
                        <div class="alert alert-warning">
                            {{session('msg')}}
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
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
                    <div class="account-title">
                        Tài khoản của tôi
                    </div>

                    <p style="color:green; dislay:none;" class="error successChangeInfo"></p>
                    <hr>
                    <div class="account-body">
                        <form method="POST" action="{{URL::to('user/account')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="info_user">
                                <div class="item-fill-user">
                                    <div class="label_fill">Đổi ảnh đại diện</div>
                                    <div class="ctn_fill">
                                        <input type="file" class="form-control" name="avatar" placeholder="Ảnh đại diện"
                                               value=""
                                               id="avatar">
                                        <div class="show-progress">

                                        </div>
                                        <div class="row justify-content-center" id="showImage">

                                            <p style="color:red; dislay:none;" class="error errorAvatar"></p>

                                        </div>
                                    </div>
                                    <div class="item-fill-user">
                                        <div class="label_fill">Họ và tên</div>
                                        <div class="ctn_fill">
                                            <input type="text" id="name" class="form-control" value="{{$user->name}}"
                                                   placeholder="Họ và tên" name="name"
                                                   required="required">
                                            <p style="color:red; dislay:none;" class="error errorName"></p>

                                        </div>
                                    </div>
                                    <div class="item-fill-user">
                                        <div class="label_fill">Email</div>
                                        <div class="ctn_fill">
                                            {{$user->email}}
                                        </div>
                                    </div>
                                    <div class="item-fill-user">
                                        <div class="label_fill">Giới thiệu</div>
                                        <div class="ctn_fill">
                                    <textarea class="form-control" id="story" placeholder="Giới thiệu về bản thân"
                                              rows="3" name="story"
                                    >{{$user->story}}</textarea>
                                        </div>
                                    </div>
                                    <div class="item-fill-user">
                                        <div class="label_fill">Liên hệ</div>
                                        <div class="ctn_fill">
                                            <input type="text" class="form-control" id="contact"
                                                   value="{{$user->contact}}" placeholder="Liên hệ" name="contact"
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="button-saveaccount">
                                    <button class="btn btn-primary" type="submit" id="submit_changeInfo">Lưu</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container" style="margin-top: 50px">
            <h3 style="color: red"><i>Bạn chưa đăng nhập</i></h3>
        </div>
    @endif
@endsection

@section('js')
    <script type="text/javascript">
            @if(!Auth::check()){
            $(window).load(function () {
                openLoginModal();
            });
        }
        @endif
    </script>
@endsection

