@extends('layout')

@section('title',$post->title)
@section('head')
    <link href="{{asset('public/rateit/scripts/rateit.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('page-header')
    @include('page-header')
@endsection

<!-- section -->
@section('content')
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- Post content -->
            <div class="col-md-12 page-content-category">
                <span><a href="{{URL::to('home')}}" title="Trang chủ">Trang chủ</a> > Chi tiết bài viết</span>
            </div>
            <div class="panel-body">
            <div class="col-md-8">
                <div class="section-row sticky-container">
                    <div class="main-post">
                        <h2>{{$post->title}}</h2>
                        <div class="post-meta">
                            <a class="post-category cat-{{$post->category->color}}"
                               href="{{URL::to('category/'.$post->category_id.'/'.$post->category->title)}}">{{$post->category->title}}</a>
                            <span class="post-date">By: {{$post->user->name}} | </span>
                            <span class="post-date"> <i class="fa fa-calendar"> </i> {{$post->created_at}}</span>
                            <span class="post-date"> | <i class="fa fa-eye"> </i> {{$post->view}} Lượt xem</span>
                            <div class="rateit" data-rateit-value="{{$post->rate}}" data-rateit-readonly="true"> |</div>
                            ({{$count_rating}})
                        </div>
                        <p>{!! $post->contents !!}</p>
                    </div>
                    <div class="post-shares sticky-shares">
                        <a href="#" class="share-facebook"><i class="fa fa-facebook"></i></a>
                        <a href="#" class="share-twitter"><i class="fa fa-twitter"></i></a>
                        <a href="#" class="share-google-plus"><i class="fa fa-google-plus"></i></a>
                        <a href="#"><i class="fa fa-envelope"></i></a>
                    </div>
                </div>


                <div class="section-row text-right">
                    <p style="color:red; dislay:none;" class="error errorRating"></p>
                    Đánh giá:
                    <div class="rateit" @if(isset($user_rating)) data-rateit-value="{{$user_rating->rate}}"
                         data-rateit-readonly="true" @endif id="rateit_star1" data-postid="{!! $post->id !!}"></div>
{{--                    <div class="fb-like"--}}
{{--                         data-href="https://katunblogs.000webhostapp.com/blog-post/{{$post->id}}/{{$post->title}}"--}}
{{--                         data-width="" data-layout="button_count" data-action="like" data-size="small"--}}
{{--                         data-share="true"></div>--}}
                    {{--                <div class="fb-share-button" data-href="https://katunblogs.000webhostapp.com/blog-post/{{$post->id}}/{{$post->title}}" data-layout="button_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fkatunblogs.000webhostapp.com%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>--}}
                </div>
                <div class="section-row">
                    <div class="post-author">
                        <div class="media">
                            <div class="media-left">
                                <img class="media-object"
                                     src="{{URL::to('public/uploads/imageAuthor/'.$post->user->avatar)}}" alt="">
                            </div>
                            <div class="media-body">
                                <div class="media-heading">
                                    <h3>Tác giả: {{$post->user->name}}</h3>
                                </div>
                                <p> {{$post->user->story}}</p>
                                <ul class="author-social">
                                    <li><a href="https://facebook.com/dinhkhactung" target="_blank"
                                           title="{{$post->user->contact}}">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li><a href="{{$post->user->email}}" target="_blank"
                                           title="{{$post->user->email}}">
                                            <i class="fa fa-envelope"></i>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /author -->
                <div class="section-row">
                    <div class="section-title">
                        <h2>Bình luận ({{$count_comments}})</h2>
                    </div>
                    <!-- reply -->
                    <div class="section-row">
                        <div class="section-title">
                        </div>
                        <form class="post-reply" action="" method="POST">
                            <input type="hidden" id="post_id" name="post_id" value="{{$post->id}}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="input" name="message" id="message"
                                                  placeholder="Nhập nội dung của bạn"
                                                  required="required"></textarea>
                                        <p style="color:red; dislay:none;" class="error errorMessage"></p>
                                    </div>

                                    <button id="submit_comment" type="submit" class="primary-button">Bình luận</button>
                                    <p style="color:red; dislay:none;" class="error errorComment"></p>
                                    <p style="color:green; dislay:none;" class="error comment"></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="post-comments" id="comment">
                    @include('comment')
                </div>
                <div class="col-md-12">
                    <div class="section-row" align="center">
                        {!! $comments->links() !!}
                    </div>
                </div>
            </div>
            <!-- /Post content -->
            <div class="col-md-4">
                <!-- aside -->
                <div class="col-md-12">
                    <!-- post widget -->
                    <div class="aside-widget">
                        <div class="section-title">
                            <h2 style="color: #FF9900;">Bài Viết Liên Quan</h2>
                        </div>
                        @foreach ($five_relate_posts as $post)
                            <div class="post post-widget">
                                <a class="post-img"
                                   href="{{URL::to('/'.$post->id.'-'.str_replace(' ','-',$post->title))}}.html"><img
                                        src="{{URL::to('public/uploads/imagePost/'.$post->thumbnail)}}" alt=""
                                        weight="90px" height="90px"></a>
                                <div class="post-body">
                                    <h3 class="post-title"><a
                                            href="{{URL::to('/'.$post->id.'-'.str_replace(' ','-',$post->title))}}.html">{{$post->title}}</a>
                                    </h3>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- /post widget -->
                <div class="col-md-12">
                    @include('three-post-cate')
                </div>

                <div class="col-md-12 cate-count">
                    @include('cate-count-fanpage')
                </div>

                <!-- /ad -->
            </div>
            </div>
        </div>
        <!-- /tags -->
    </div>
    <!-- /aside -->
@endsection
@section('js')
    <script type="text/javascript">
        $(function () {
            //rating

            $('#rateit_star1').rateit({min: 1, max: 5, step: 1});
            $('#rateit_star1').bind('rated', function (e) {
                    <?php $auth = Auth::user();?>
                        @if(isset($auth))
                var ri = $(this);
                var value = ri.rateit('value');
                var postID = ri.data('postid');
                $user_id = {{$auth->id}};
                $('.error').hide();
                if (confirm('Bạn chắc chắn muốn đánh giá ' + value + ' sao cho bài viết này. Điều này chỉ thực hiện 1 lần duy nhất với mỗi bài viết')) {
                    ri.rateit('readonly', true);
                    //ajax insert sao
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: "{{URL::to('/rating')}}",
                        data: {
                            'post_id': postID,
                            'user_id': $user_id,
                            'rate': value,
                        },
                        success: function (data) {
                            console.log(data);
                            if (data.error == true) {
                                $('.errorRating').show().text('Có lỗi xảy ra, vui lòng thử lại');
                                ri.rateit('readonly', false);
                            } else {
                                alert('Cảm ơn bạn đã đánh giá ' + value + ' sao cho bài viết này');
                            }
                        }
                    });

                }
                @else
                alert('Bạn cần đăng nhập để đánh giá bài viết này');
                openLoginModal();
                @endif
            });


            //submit comment
            $('#submit_comment').click(function (e) {
                <?php $auth = Auth::user();?>
                @if(isset($auth))
                    $(':input[type="submit"]').prop('disabled', true);
                    $post_id = $('#post_id').val();
                    $message = $('#message').val();
                    $user_id = {{$auth->id}};
                    $('.error').hide();
                    if (!$message) {
                        $('.errorMessage').show().text('Bạn vui lòng điền bình luận');
                        $(':input[type="submit"]').prop('disabled', false);
                    }

                    if ($message) {
                        e.preventDefault();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: 'POST',
                            url: "{{URL::to('/comment')}}",
                            data: {
                                'post_id': $post_id,
                                'user_id': $user_id,
                                'message': $message
                            },
                            success: function (data) {
                                console.log(data);
                                if (data.error == true) {
                                    $(':input[type="submit"]').prop('disabled', false);
                                    $('.error').hide();

                                    if (data.message.message != undefined) {
                                        $('.errorMessage').show().text(data.message.message[0]);
                                    }

                                } else {
                                    window.location.reload();
                                    $(':input[type="submit"]').prop('disabled', false);
                                    if (data.message.comment != undefined) {
                                        $('.comment').show().text(data.message.comment[0]);
                                    }
                                    {{--                             $('#comment').load();--}}

                                }
                            }
                        });
                    }
                @else
                alert('Bạn cần đăng nhập để bình luận bài viết này');
                openLoginModal();
                @endif
            })

        });
    </script>
@endsection

