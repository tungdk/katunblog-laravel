@extends('layout')
@section('title',$cate->title)
@section('page-header')
    @include('page-header')
@endsection

@section('content')
    <div class="container">
        @if(!isset($one_recent_post))
            <h2>Danh mục này chưa có bài viết</h2>
        @else
        <!-- row -->
            <div class="row">
                <div class="col-md-10">
                    <div class="page-content-category">
                        <span><a href="{{URL::to('home')}}" title="Trang chủ">Trang chủ</a> > {{$cate->title}}</span>
                    </div>
                    <h1>{{$cate->description}}</h1>
                </div>
            </div>
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <!-- post -->
                    <div class="col-md-12">
                        <div class="post post-thumb">
                            <a class="post-img" href="{{URL::to('/'.$one_recent_post->id.'-'.str_replace(' ','-',$one_recent_post->title))}}.html" title="{{$one_recent_post->title}}"><img src="{{URL::to('public/uploads/imagePost/'.$one_recent_post->thumbnail)}}" alt="{{$one_recent_post->title}}" weight="750px" height="450px"></a>
                            <div class="post-body">
                                <div class="post-meta">
                                    <a class="post-category cat-{{$one_recent_post->category->color}}" href="{{URL::to('category/'.$one_recent_post->category_id.'/'.$one_recent_post->category->title)}}" title="{{$one_recent_post->category->title}}">{{$one_recent_post->category->title}}</a>
                                    <span class="post-date">{{$one_recent_post->created_at}}</span>
                                </div>
                                <h3 class="post-title"><a href="{{URL::to('/'.$one_recent_post->id.'-'.str_replace(' ','-',$one_recent_post->title))}}.html" title="{{$one_recent_post->title}}">{{$one_recent_post->title}}</a></h3>
                            </div>
                        </div>
                    </div>
                    <!-- /post -->
                @foreach ($two_recent_posts_next as $post)
                <!-- post -->
                    <div class="col-md-6">
                        <div class="post">
                            <a class="post-img" href="{{URL::to('/'.$post->id.'-'.str_replace(' ','-',$post->title))}}.html" title="{{$post->title}}"><img src="{{URL::to('public/uploads/imagePost/'.$post->thumbnail)}}" alt="{{$post->title}}" weight="360px" height="216px"></a>
                            <div class="post-body">
                                <div class="post-meta">
                                    <a class="post-category cat-{{$post->category->color}}" href="{{URL::to('category/'.$post->category_id.'/'.$post->category->title)}}" title="{{$post->category->title}}">{{$post->category->title}}</a>
                                    <span class="post-date">{{$post->created_at}}</span>
                                    <span class="post-view"><i class="fa fa-eye"></i>{{$post->view}}</span>
                                </div>
                                <h3 class="post-title"><a href="{{URL::to('/'.$post->id.'-'.str_replace(' ','-',$post->title))}}.html" title="{{$post->title}}">{{$post->title}}</a></h3>
                            </div>
                        </div>
                    </div>
                    <!-- /post -->
                @endforeach

                <!-- /post -->

                    <div class="clearfix visible-md visible-lg"></div>

                @foreach ($four_recent_posts_next as $post)
                <!-- post -->
                    <div class="col-md-12">
                        <div class="post post-row">
                            <a class="post-img" href="{{URL::to('/'.$post->id.'-'.str_replace(' ','-',$post->title))}}.html" title="{{$post->title}}"><img src="{{URL::to('public/uploads/imagePost/'.$post->thumbnail)}}" alt="{{$post->title}}" weight="300px" height="180px"></a>
                            <div class="post-body">
                                <div class="post-meta">
                                    <a class="post-category cat-{{$post->category->color}}" href="{{URL::to('category/'.$post->category_id.'/'.$post->category->title)}}" title="{{$post->category->title}}">{{$post->category->title}}</a>
                                    <span class="post-date">{{$post->created_at}}</span>
                                    <span class="post-view"><i class="fa fa-eye"></i>{{$post->view}}</span>
                                </div>
                                <h3 class="post-title"><a href="{{URL::to('/'.$post->id.'-'.str_replace(' ','-',$post->title))}}.html" title="{{$post->title}}">{{$post->title}}</a></h3>
                                <p>{!! $post->description !!}</p>
                            </div>
                        </div>
                    </div>
                    <!-- /post -->

                    @endforeach


                </div>
            </div>

            <div class="col-md-4">
                <!-- post widget -->
                <div class="aside-widget">
                    <div class="section-title">
                        <h2>Bài viết xem nhiều</h2>
                    </div>

                    @foreach ($five_read_most_posts as $post)

                    <div class="post post-widget">
                        <a class="post-img" href="{{URL::to('/'.$post->id.'-'.str_replace(' ','-',$post->title))}}.html"><img src="{{URL::to('public/uploads/imagePost/'.$post->thumbnail)}}" alt="" weight="90px" height="90px"></a>
                        <div class="post-body">
                            <h3 class="post-title"><a href="{{URL::to('/'.$post->id.'-'.str_replace(' ','-',$post->title))}}.html">{{$post->title}}</a></h3>
                        </div>
                    </div>
                    @endforeach

                </div>
                <!-- /post widget -->
            </div>
            <div class="col-md-4">
                @include('cate-count-fanpage')
            </div>

        </div>
        <!-- /row -->
            @endif
    </div>
@endsection
