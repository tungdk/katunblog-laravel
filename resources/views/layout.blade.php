<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <LINK rel="shortcut icon" href="{{asset('public/img/icon-katun.png')}}">
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:700%7CNunito:300,600" rel="stylesheet">
    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- jQuery UI -->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}"/>

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{asset('public/css/font-awesome.min.css')}}">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="{{asset('public/css/style.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('public/css/tungdk.min.css')}}"/>
    <link href="{{asset('public/css/login-register.min.css')}}" rel="stylesheet" />
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    @yield('head')
</head>
<body>

<!-- Header -->
<header id="header">
    @include('nav-header')
    @yield('page-header')
</header>
<!-- /Header -->

<!-- section -->
<div class="content">
    @yield('content')

</div>
<!-- /section -->

<!-- Footer -->
<footer id="footer">
    @include('footer')
</footer>
<!-- /Footer -->
@include('pages.login-register')
<!-- jQuery Plugins -->
<script src="{{asset('public/js/jquery.min.js')}}"></script>
<script src="{{asset('public/js/bootstrap.min.js')}}"></script>
<script src="{{asset('public/js/main.js')}}"></script>

<script src="{{asset('public/Page/page.js')}}"></script>


<script src="{{asset('public/rateit/scripts/jquery.rateit.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/js/login-register.js')}}" type="text/javascript"></script>

@yield('js')


<!-- facebook -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v6.0&appId=701066940668768&autoLogAppEvents=1"></script>

<!-- zalo -->
<div class="zalo-chat-widget" data-oaid="2874983549580581079" data-welcome-message="Katun Blog rất vui khi được hỗ trợ bạn!" data-autopopup="60" data-width="300" data-height="400" style="margin-right: 40px;margin-bottom: 100px"></div>
<script src="https://sp.zalo.me/plugins/sdk.js"></script>

@include('back_to_top')
</body>
<script>
    $(function () {
        $('#submit_newsletter').click(function (e) {
            $(':input[type="submit"]').prop('disabled', true);
            $('.footer-loading').show().text('Đang gửi .....');
            $footer_email = $('#footer_email').val();

            $('.error_footer').hide();
            if (!$footer_email) {
                $('.error_footer_Email').show().text('Bạn vui lòng điền email');
                $(':input[type="submit"]').prop('disabled', false);
                $('.footer-loading').hide();
            } else {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{URL::to('/email_footer')}}",
                    data: {
                        'email': $footer_email
                    },
                    success: function (data) {
                        console.log(data);
                        if (data.error == true) {
                            $(':input[type="submit"]').prop('disabled', false);
                            $('.footer-loading').hide();
                            $('.error_footer_Email').hide();
                            if (data.message.email != undefined) {
                                $('.error_footer_Email').show().text(data.message.email[0]);
                            }
                        } else {
                            $(':input[type="submit"]').prop('disabled', false);
                            $('.footer-loading').hide();
                            if (data.message.newsletter != undefined) {
                                $('.newsletter').show().text(data.message.newsletter[0]);
                            }
                            $('#footer_email').val('');
                        }
                    }
                });
            }
        })
    });
</script>
</html>
