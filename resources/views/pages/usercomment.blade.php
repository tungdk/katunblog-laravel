@extends('layout')
@section('title','Hoạt động bình luận')
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
                            <li class="item-action"><a href="{{URL::to('/user/account')}}">Tài khoản của tôi</a></li>
                            <li class="item-action"><a href="{{URL::to('/user/comment')}}" class="active-item">Hoạt động
                                    bình luận</a></li>
                            <li class="item-action"><a href="{{URL::to('/user/change-password')}}">Đổi mật khẩu</a></li>
                            <li class="item-action"><a href="{{URL::to('/logout')}}">Thoát</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8 account-right">
                    <div class="account-title">
                        Hoạt động bình luận
                    </div>
                    <hr>
                    <div class="account-body">
                        @if($comments->count() > 0)
                            @foreach ($comments as $cmt)
                                <div class="col-md-2">
                                    <div class="account-body-avatar">
                                        <img class="media-object"
                                             src="{{URL::to('public/uploads/imageAuthor/'.$cmt->user->avatar)}}" alt="">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="account-body-item account-body-comment">
                                        <p>{{$cmt->message}}</p>
                                    </div>
                                    <div class="account-body-item account-body-created_at">
                                        <span class="time">{{$cmt->created_at}}</span>
                                    </div>
                                    <div class="account-body-item account-body-post-title">
                                        <a href="{{URL::to('/'.$cmt->post_id.'-'.str_replace(' ','-',$cmt->post->title))}}.html">{{$cmt->post->title}}
                                            - Katunblog</a>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <hr>

                            @endforeach
                            {{$comments->links()}}
                        @else
                            <div class="no-comment" style="margin-top: 30px">
                                <p>Bạn chưa có hoạt động bình luận nào trên Katunblog.</p>
                            </div>
                        @endif
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
            $(window).load(function() {
                openLoginModal();
            });
        }
        @endif
    </script>
@endsection
