@extends('layout')
@section('title','Tìm kiếm')
@section('content')
    <div class="section">
        <!-- container -->
        <div class="container main-search">
            <!-- row -->
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title ">
                                <h2 style="color: #FF9900;">Tìm kiếm: {{$search}}</h2>
                            </div>
                        </div>

                        <?php
                        function changeColor($str, $search)
                        {
                            return str_replace($search, "<span style='color:red;'>$search</span>", $str);
                        }
                        ?>
                        @if(count($posts) == 0)
                            <em>Không tìm thấy bài viết nào</em>
                        @else
                            @foreach ($posts as $post)
                            <!-- post -->
                                <div class="col-md-12">
                                    <div class="post post-row">
                                        <a class="post-img"
                                           href="{{URL::to('/'.$post->id.'-'.str_replace(' ','-',$post->title))}}.html"><img
                                                src="{{URL::to('public/uploads/imagePost/'.$post->thumbnail)}}" alt=""
                                                weight="300px" height="180px"></a>
                                        <div class="post-body">
                                            <div class="post-meta">
                                                <a class="post-category cat-{{$post->category->color}}"
                                                   href="{{URL::to('category/'.$post->category_id.'/'.str_replace(' ','-',$post->category->title))}}">{{$post->category->title}}</a>
                                                <span class="post-date">{{$post->created_at}}</span>
                                                <span class="post-view"><i
                                                        class="fa fa-eye"></i>{{$post->view}}</span>
                                            </div>
                                            <h3 class="post-title"><a
                                                    href="{{URL::to('/'.$post->id.'-'.str_replace(' ','-',$post->title))}}.html">{!! changeColor($post->title, $search) !!}</a>
                                            </h3>
                                            <p>{!! changeColor($post->description, $search) !!}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- /post -->
                            @endforeach
                        @endif
                        <div class="page" align="center">
                            {!! $posts->links() !!}
                        </div>

                    </div>
                </div>


                <div class="col-md-4">
                    @include('three-post-cate')
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /section -->


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
                                <h2 style="color: #FF9900;">Bài Viết Hay</h2>
                            </div>
                        </div>

                    @foreach ($most_read_posts as $post)
                        <!-- post -->
                            <div class="col-md-12">
                                <div class="post post-row">
                                    <a class="post-img"
                                       href="{{URL::to('/'.$post->id.'-'.str_replace(' ','-',$post->title))}}.html"><img
                                            src="{{URL::to('public/uploads/imagePost/'.$post->thumbnail)}}" alt=""
                                            weight="300px" height="180px"></a>
                                    <div class="post-body">
                                        <div class="post-meta">
                                            <a class="post-category cat-{{$post->category->color}}"
                                               href="{{URL::to('category/'.$post->category_id.'/'.str_replace(' ','-',$post->category->title))}}">{{$post->category->title}}</a>
                                            <span class="post-date">{{$post->created_at}}</span>
                                            <span class="post-view"><i class="fa fa-eye"></i>{{$post->view }}</span>
                                        </div>
                                        <h3 class="post-title"><a
                                                href="{{URL::to('/'.$post->id.'-'.str_replace(' ','-',$post->title))}}.html">{{$post->title}}</a>
                                        </h3>
                                        <p>{!! $post->description !!}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- /post -->
                        @endforeach
                    </div>
                </div>

                <!-- catagories -->
                <div class="col-md-4">
                    @include('cate-count-fanpage')
                </div>
                <!-- catagories -->

            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /section -->
@endsection
