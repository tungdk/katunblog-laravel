<!DOCTYPE html>
<html lang="vi">
<head>
    <title>@yield('title')</title>
    <base href="{{asset('')}}">
    <LINK rel="shortcut icon" href="public/img/icon-katun.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    {{--    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,--}}
    {{--    Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />--}}
    <script type="application/x-javascript"> addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        } </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    {{--    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">--}}
<!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="public/admin/css/style.min.css" rel='stylesheet' type='text/css'/>
    <link href="public/admin/css/style-responsive.min.css" rel="stylesheet"/>
    <!-- font CSS -->

    <link href="http://ksylvest.github.io/jquery-growl/stylesheets/jquery.growl.css" rel="stylesheet" type="text/css">
    <link
        href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="public/admin/css/font.css" type="text/css"/>
    <link href="public/css/font-awesome.css" rel="stylesheet">
{{--    <link rel="stylesheet" href="public/admin/css/morris.css" type="text/css"/>--}}
    <link href="{{asset('public/css/login-register.min.css')}}" rel="stylesheet" />
    <!-- //font-awesome icons -->
    <script src="public/admin/js/jquery2.0.3.min.js"></script>
{{--    <script src="public/admin/js/raphael-min.js"></script>--}}
{{--    <script src="public/admin/js/morris.js"></script>--}}
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"
            type="text/javascript"></script>

    @yield('head')
    <script type="text/javascript">
        function time() {
            var today = new Date();
            var weekday = new Array(7);
            weekday[0] = "Chủ nhật";
            weekday[1] = "Thứ 2";
            weekday[2] = "Thứ 3";
            weekday[3] = "Thứ 4";
            weekday[4] = "Thứ 5";
            weekday[5] = "Thứ 6";
            weekday[6] = "Thứ 7";
            var day = weekday[today.getDay()];
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            nowTime = h + ":" + m + ":" + s;
            if (dd < 10) {
                dd = '0' + dd
            }
            if (mm < 10) {
                mm = '0' + mm
            }
            today = day + ', ' + dd + '/' + mm + '/' + yyyy;

            tmp = '<span class="date">' + today + ' | ' + nowTime + '</span>';

            document.getElementById("clock").innerHTML = tmp;

            clocktime = setTimeout("time()", "1000", "JavaScript");

            function checkTime(i) {
                if (i < 10) {
                    i = "0" + i;
                }
                return i;
            }
        }
    </script>
    <style>
        label.error {
            color: red;
        }
    </style>
</head>
<body onload="time()">
<section id="container">
    <!--header start-->
    <header class="header fixed-top clearfix">
        <!--logo start-->
        <div class="brand">
            <a href="home" class="logo" title="Trang chủ">
                Katun Blog
            </a>
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars"></div>
            </div>
        </div>
        <!--logo end-->
        <div class="nav notify-row" id="top_menu">
            <!--  notification start -->
            <ul class="nav top-menu">
                <li>
                    <marquee>
                        <h4 style="float: left"><img src="{{URL::to('public/img/icon-katun.png')}}"
                                                     style="width: 30px;height: 30px;margin: 0 15px 0 15px">Chào mừng
                            bạn đã đến với trang quản trị Katun Blog</h4>
                    </marquee>
                </li>
            </ul>
            <!--  notification end -->
        </div>
        <div class="top-nav clearfix">
            <!--search & user info start-->
            <ul class="nav pull-right top-menu">

                <li>
                    <div id="clock" style="margin-top: 5px"></div>
                </li>
                <!-- user login dropdown start-->
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <img alt="" src="{{URL::to('public/uploads/imageAuthor/'.Auth::user()->avatar)}}">
                        <span class="username">{{Auth::user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu extended logout">
                        <li><a href="{{URL::to('/user/account')}}"><i class=" fa fa-suitcase"></i>Tài khoản</a>
                        </li>
                        <li><a href="{{URL::to('/user/change-password')}}"><i class="fa fa-key"></i>Đổi mật khẩu</a></li>
                        <li><a href="logout"><i class="fa fa-sign-out"></i>Đăng xuất</a></li>
                    </ul>
                    {{--                        @endif--}}
                </li>
                <!-- user login dropdown end -->

            </ul>
            <!--search & user info end-->
        </div>
    </header>
    <!--header end-->
    <!--sidebar start-->
    <aside>
        <div id="sidebar" class="nav-collapse">
            <!-- sidebar menu start-->
            <div class="leftside-navigation">
                <ul class="sidebar-menu" id="nav-accordion">
                    <li>
                        <a href="admin/dashboard">
                            <i class="fa fa-dashboard"></i>
                            <span>Tổng quan</span>
                        </a>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-tasks"></i>
                            <span>Bài viết</span>
                        </a>
                        <ul class="sub">
                            <li><a href="admin/post/add">Thêm bài viết</a></li>
                            <li><a href="admin/post/all">Quản lý bài viết</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-book"></i>
                            <span>Danh mục</span>
                        </a>
                        <ul class="sub">
                            <li><a href="admin/category/add">Thêm danh mục</a></li>
                            <li><a href="admin/category/all">Quản lý danh mục</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-user"></i>
                            <span>Tác giả</span>
                        </a>
                        <ul class="sub">
                            <li><a href="admin/author/all">Quản lý tác giả</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-users"></i>
                            <span>Bạn đọc</span>
                        </a>
                        <ul class="sub">
                            <li><a href="admin/user/all">Quản lý bạn đọc</a></li>
                        </ul>
                    </li>

                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-envelope"></i>
                            <span>Bình luận</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{URL::to('admin/comment/all')}}">Quản lý bình luận</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="logout">
                            <i class="fa fa-sign-out"></i>
                            <span>Đăng xuất</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <section id="main-content">
        <section class="wrapper">
            @yield('admin_content')
        </section>
        <div class="footer">
            <div class="wthree-copyright">
                <p>© 2020 Katun. All rights reserved | Design by <a href="https://facebook.com/tungdk228">Đinh Khắc
                        Tùng</a></p>
            </div>
        </div>

        <!-- / footer -->
    </section>
    @include('back_to_top');
    @include('pages.login-register')
    <!--main content end-->
</section>
<script src="{{asset('public/admin/js/bootstrap.js')}}"></script>
<script src="{{asset('public/admin/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/admin/js/scripts.js')}}"></script>
{{--<script src="{{asset('public/admin/js/jquery.slimscroll.js')}}"></script>--}}
<script src="{{asset('public/admin/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('public/js/login-register.js')}}" type="text/javascript"></script>

<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="{{asset('public/admin/js/flot-chart/excanvas.min.js')}}"></script><![endif]-->
{{--<script src="{{asset('public/admin/js/jquery.scrollTo.js')}}"></script>--}}
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.6/bootstrap-growl.min.js" integrity="sha512-KgI7fghDFHr4D+sJIDQGZLpNCmDmlQHuISbPeIwHd7iJCU20FtL5+l7mD2aMr6NUVnaDua1lEg4tTOVe/XiYBw==" crossorigin="anonymous"></script>
<script src='http://ksylvest.github.io/jquery-growl/javascripts/jquery.growl.js' type='text/javascript'></script>
@yield('js')
</body>
</html>
