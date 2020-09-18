@extends('admin.admin_layout')
@section('title','Trang quản trị')
@section('admin_content')

    <div class="market-updates">
        <div class="col-md-3 market-update-gd">
            <div class="market-update-block clr-block-2">
                <div class="col-md-4 market-update-right">
                    <i class="fa fa-eye"> </i>
                </div>
                <div class="col-md-8 market-update-left">
                    <h4>Lượt xem</h4>
                    <h3>{{$countView}}</h3>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="col-md-3 market-update-gd">
            <div class="market-update-block clr-block-1">
                <div class="col-md-4 market-update-right">
                    <i class="fa fa-book"></i>
                </div>
                <div class="col-md-8 market-update-left">
                    <h4>Bài viết</h4>
                    <h3>{{$countPost}}</h3>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="col-md-3 market-update-gd">
            <div class="market-update-block clr-block-3">
                <div class="col-md-4 market-update-right">
                    <i class="fa fa-list"></i>
                </div>
                <div class="col-md-8 market-update-left">
                    <h4>Danh mục</h4>
                    <h3>{{$countCate}}</h3>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="col-md-3 market-update-gd">
            <div class="market-update-block clr-block-4">
                <div class="col-md-4 market-update-right">
                    <i class="fa fa-user-o" aria-hidden="true"></i>
                </div>
                <div class="col-md-8 market-update-left">
                    <h4>Tác giả</h4>
                    <h3>{{$countAuthor}}</h3>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="col-md-3 market-update-gd">
            <div class="market-update-block clr-block-5">
                <div class="col-md-4 market-update-right">
                    <i class="fa fa-users" aria-hidden="true"></i>
                </div>
                <div class="col-md-8 market-update-left">
                    <h4>Bạn đọc</h4>
                    <h3>{{$countUser}}</h3>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="col-md-6">
        <section class="panel">
            <header class="panel-heading">
                Thống kê danh mục({{$countCate}})
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <!-- catagories -->
                    <div class="aside-widget">
                        <div class="category-widget">
                            <ul>
                                @foreach ($count_post_cate as $count)
                                    <li><a href="{{URL::to('category/'.$count->id.'/'.str_replace(' ','-',$count->title))}}" class="cat-{{$count->color}}">{{$count->title}}<span>{{$count->count}}</span></a></li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    <!-- /catagories -->

                </div>
            </div>
        </section>
    </div>


    <div class="col-md-6">
        <section class="panel">
            <header class="panel-heading">
                Thống kê tác giả({{$countAuthor}})
            </header>

            <div class="panel-body">
                <div class="position-center">
                    <!-- authors -->
                    <div class="aside-widget">
                        <div class="author-widget">
                            <ul>
                                @foreach ($count_post_author as $count)
                                    <li>{{$count->name}}<span>{{$count->count}}</span></li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    <!-- /authors -->
                </div>
            </div>
        </section>
    </div>

    <div class="col-md-12">
        <section class="panel">
            <header class="panel-heading">
                Thống kê bài viết({{$countPost}})
            </header>

            <div class="panel-body">
                <div class="position-center">
                    <!-- authors -->
                    <div class="aside-widget">
                        <div class="author-widget">
                            <ul>
                                <li style="color: #0f74a8">Bài viết<span>Lượt xem</span></li>
                                @foreach ($posts as $post)
                                    <li>{{$post->title}}<span>{{$post->view}}</span></li>
                                @endforeach

                            </ul>
                        </div>
                        {{$posts->links()}}

                    </div>
                    <!-- /authors -->
                </div>
            </div>
        </section>
    </div>
@endsection
