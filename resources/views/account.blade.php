{{--@include('pages.login-register')--}}
<style>

    .account>li{
        float: left;
        margin-right: 15px;
    }

    .account li{
        position: relative;
        list-style:none;
    }

    .account li a{
        padding: 10px 0 10px 0;
        line-height: 20px;
        display: inline-block;
    }
    .account .avatar{
        width: 30px;
        height: 30px;
        border-radius:50%;
        -moz-border-radius:50%;
        -webkit-border-radius:50%;

    }
    .account .sub-menu{
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        width: 150px;
        background-color: white;
        padding: 5px 0px;
        z-index: 1000;
    }
    .account .sub-menu li{
        padding-left: 10px;
    }
    .account li:hover>.sub-menu{
        display: block;
    }

    .account>li>.sub-menu{
        top: 40px;
        left: 0;
    }
    .sub-menu li:hover {
        background-color: #eee;
    }
    .account a:hover{
        text-decoration: none;
        color: green;
    }
</style>
<?php $user = Auth::user();?>
@if (isset($user))
    <ul class="account">
        <li>
            <a href="{{URL::to('user/account')}}"><img src="{{URL::to('public/uploads/imageAuthor/'.$user->avatar)}}" class="avatar">{{$user->name}}</a>
            <ul class="sub-menu">
                <li><a href="{{URL::to('user/account')}}"><i class=" fa fa-user"></i> Tài khoản</a></li>
                @if($user->tk==1 || $user->tk==2)
                <li><a href="{{URL::to('admin/dashboard')}}"><i class=" fa fa-suitcase"></i> Trang quản trị</a></li>
                @endif
                <li><a href="{{URL::to('logout')}}"><i class=" fa fa-sign-out"></i> Đăng xuất</a></li>
            </ul>
        </li>
    </ul>
@else
        <a class="btn btn-success" data-toggle="modal" href="javascript:void(0)" onclick="openLoginModal();">Đăng nhập</a>
@endif
