@extends('layout')
@section('title','Giới thiệu')
@section('page-header')
    @include('page-header')
@endsection
@section('content')
        <div class="container">
            <h1 style="margin: 30px 0 30px 0;color: #900">Giới thiệu</h1>
            <hr>
            <!-- row -->
            <div class="row">
                <div class="col-md-8">
                    <div class="section-row">
                        <h2 style="text-align: center;">
                            <span style="font-size: 20px">
                                <strong>Katun Blog xin kính chào bạn đọc</strong>
                            </span>
                        </h2>
                        <p style="text-align: justify">
                            Katun Blog là trang thông tin điện tử uy tín có trụ sở đặt tại Hà Nội với nhiều năm kinh nghiệm hoạt động trong lĩnh vực công nghệ thông tin.

                        </p>
                        <br>
                        <p style="text-align: center">
                            <img src="{{URL::to('public/img/logo-katun.png')}}" alt="" >

                        </p>
                        <br>
                        <p style="text-align: justify">
                            Katun Blog chuyên cập nhật các thông tin mới nhất, nhanh nhất về sự phát triển của các ngôn ngữ lập trình hiện nay như Java, Html, Css, Javascript,...và những tin tức công nghệ về lĩnh vực điện thoại, máy tính,...
                        </p>
                        <figure class="figure-img">
                            <img class="img-responsive" src="{{URL::to('public/img/text-katun.png')}}" alt=""  height="auto" width="100%">
                        </figure>
                        <br>
                        <p>Bên đây là một số bài viết hay nhất trên trang web của tôi. Bạn có thể xem chúng.</p>

                        <p>Trang web được thiết kế và xây dựng bởi <b>Đinh Khắc Tùng - Sinh viên khoa công nghệ thông tin trường Đại học Xây Dựng</b></p>
                    </div>

                </div>

                <!-- aside -->
                <div class="col-md-4">

                    <!-- post widget -->
                    <div class="aside-widget">
                        <div class="section-title">
                            <h2>Bài viết hay nhất</h2>
                        </div>
                        @foreach ($most_read_posts as $post)
                        <div class="post post-widget">
                            <a class="post-img" href="{{URL::to('/'.$post->id.'-'.str_replace(' ','-',$post->title))}}.html"><img src="{{('public/uploads/imagePost/'.$post->thumbnail)}}" alt="{{$post->title}}}"></a>
                            <div class="post-body">
                                <h3 class="post-title"><a href="{{URL::to('/'.$post->id.'-'.str_replace(' ','-',$post->title))}}.html" title="{{$post->title}}">{{$post->title}}</a></h3>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    <div class="cate-count">
                        @include('cate-count-fanpage')
                    </div>
                    <!-- /post widget -->
                </div>
                <!-- /aside -->

            </div>

        </div>


@endsection
