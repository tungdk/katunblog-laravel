@extends('layout')
@section('title','Đăng nhập')
@section('content')
        <div class="container" style="margin-top: 50px">
            <h3 style="color: red"><i>Bạn chưa đăng nhập</i></h3>
        </div>
@endsection
@section('js')
    <script type="text/javascript">
        $(window).load(function() {
                openLoginModal();
        });
    </script>
@endsection
