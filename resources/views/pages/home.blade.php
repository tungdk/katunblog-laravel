@extends('layout')
@section('title','Katun Blog')
@section('content')
    <div class="section">
        <div class="container">
            <div class="row">
                @include('slide')
            </div>

            <div class="row">
                <div class="col-md-12" style="margin-top: 30px">
                    <div class="section-title">
                        <h2 style="color: #FF9900;">Bài viết gần đây</h2>
                    </div>
                </div>
            <?php $i = 1;?>
            @foreach ($six_posts as $post)
                <!-- post -->
                    <div class="col-md-4">
                        <div class="post">
                            <a class="post-img"
                               href="{{URL::to('/'.$post->id.'-'.str_replace(' ','-',$post->title))}}.html"
                               title="{{$post->title}}"><img
                                    src="{{URL::to('public/uploads/imagePost/'.$post->thumbnail)}}"
                                    alt="{{$post->title}}" width="360px" height="216px"></a>
                            <div class="post-body">
                                <div class="post-meta">
                                    <a class="post-category cat-{{$post->category->color}}"
                                       href="{{URL::to('category/'.$post->category_id.'/'.str_replace(' ','-',$post->category->title))}}"
                                       title="{{$post->category->title}}">{{$post->category->title}}</a>
                                    <span class="post-date">{{$post->created_at}}</span>
                                    <span class="post-view"><i class="fa fa-eye"></i>{{$post->view}}</span>
                                </div>
                                <h3 class="post-title"><a
                                        href="{{URL::to('/'.$post->id.'-'.str_replace(' ','-',$post->title))}}.html"
                                        title="{{$post->title}}">{{$post->title}}</a></h3>
                            </div>
                        </div>
                    </div>
                    <!-- /post -->
                    <?php $i++; ?>
                    @if($i==4)
                        <div class=clearfix visible-md visible-lg></div>
                        <?php $i = 1;?>
                    @endif
                @endforeach
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <!-- post -->
                        <div class="col-md-12">
                            <div class="post post-thumb">
                                <a class="post-img"
                                   href="{{URL::to('/'.$one_posts_next->id.'-'.str_replace(' ','-',$one_posts_next->title))}}.html"
                                   title="{{$one_posts_next->title}}"><img
                                        src="{{URL::to('public/uploads/imagePost/'.$one_posts_next->thumbnail)}}" alt=""
                                        width="750px" height="450px"></a>
                                <div class="post-body">
                                    <div class="post-meta">
                                        <a class="post-category cat-3"
                                           href="{{URL::to('category/'.$one_posts_next->category_id.'/'.$one_posts_next->category->title)}}"
                                           title="{{$one_posts_next->category->title}}">{{$one_posts_next->category->title}}</a>
                                        <span class="post-date">{{$one_posts_next->created_at}}</span>
                                    </div>
                                    <h3 class="post-title"><a
                                            href="{{URL::to('/'.$one_posts_next->id.'-'.str_replace(' ','-',$one_posts_next->title))}}.html"
                                            title="{{$one_posts_next->title}}">{{$one_posts_next->title}}</a></h3>
                                </div>
                            </div>
                        </div>
                        <!-- /post -->
                    <?php $j = 1; ?>
                    @foreach ($night_posts_next as $post)
                        <!-- post -->
                            <div class="col-md-6">
                                <div class="post">
                                    <a class="post-img"
                                       href="{{URL::to('/'.$post->id.'-'.str_replace(' ','-',$post->title))}}.html"
                                       title="{{$post->title}}"><img
                                            src="{{URL::to('public/uploads/imagePost/'.$post->thumbnail)}}" alt=""
                                            {{$post->title}} width="360px" height="250px"></a>
                                    <div class="post-body">
                                        <div class="post-meta">
                                            <a class="post-category cat-{{$post->category->color}}"
                                               href="{{URL::to('category/'.$post->category_id.'/'.str_replace(' ','-',$post->category->title))}}"
                                               title="{{$post->category->title}}">{{$post->category->title}}</a>
                                            <span class="post-date">{{$post->created_at}}</span>
                                            <span class="post-view"><i class="fa fa-eye"></i>{{$post->view}}</span>
                                        </div>
                                        <h3 class="post-title">
                                            <a href="{{URL::to('/'.$post->id.'-'.str_replace(' ','-',$post->title))}}.html"
                                                title="{{$post->title}}">{{$post->title}}
                                            </a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <!-- /post -->
                            <?php $j++; ?>
                            @if($j == 3)
                                <div class=clearfix visible-md visible-lg></div>
                            <?php $j = 1; ?>
                        @endif
                    @endforeach
                    <!-- <div class="clearfix visible-md visible-lg"></div> -->
                    </div>
                </div>


                <div class="col-md-4">
                    @include('three-post-cate')
                </div>
            </div>
        </div>
    </div>

    <!-- section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title">
                                <h2 style="color: #FF9900;">Bài Viết Đánh Giá Hay</h2>
                            </div>
                        </div>

                    @foreach ($most_rate_posts as $post)
                        <!-- post -->
                            <div class="col-md-12">
                                <div class="post post-row">
                                    <a class="post-img" href="{{URL::to('/'.$post->id.'-'.str_replace(' ','-',$post->title))}}.html" title="{{$post->title}}">
                                        <img src="{{URL::to('public/uploads/imagePost/'.$post->thumbnail)}}" alt="{{$post->title}}" weight="300px" height="180px">
                                    </a>
                                    <div class="post-body">
                                        <div class="post-meta">
                                            <a class="post-category cat-{{$post->category->color}}" href="{{URL::to('category/'.$post->category_id.'/'.str_replace(' ','-',$post->category->title))}}" title="{{$post->category->title}}">
                                                {{$post->category->title}}
                                            </a>
                                            <span class="post-date">{{$post->created_at}}</span>
                                            <span class="post-view"><i class="fa fa-eye"></i>{{$post->view}}</span>
                                        </div>
                                        <h3 class="post-title">
                                            <a href="{{URL::to('/'.$post->id.'-'.str_replace(' ','-',$post->title))}}.html" title="{{$post->title}}">
                                                {{$post->title}}
                                            </a>
                                        </h3>
                                        <p>{!! $post->description !!}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- /post -->
                        @endforeach
                        <div class="col-md-12">
                            <div class="section-row" align="center">
                                {!! $most_rate_posts->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 cate-count">
                    @include('cate-count-fanpage')
                </div>
            </div>
        </div>
    </div>
@endsection
