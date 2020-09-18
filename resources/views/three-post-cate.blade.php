@foreach ($categories as $cate)
    @if(count($cate->post)>0)
        <!-- post widget -->
        <div class="aside-widget">
            <div class="section-title">
                <h2 style="color: #FF9900;">{{$cate->title}}</h2>
            </div>
            <?php
            $two_post_read_most = $cate->post->where('status', 1)->sortByDesc('view')->take(3);
            ?>
            @foreach ($two_post_read_most as $post)
                <div class="post post-widget">
                    <a class="post-img"
                       href="{{URL::to('/'.$post->id.'-'.str_replace(' ','-',$post->title))}}.html"><img
                            src="{{URL::to('public/uploads/imagePost/'.$post->thumbnail)}}" alt=""
                            width="90px"
                            height="80px"></a>
                    <div class="post-body">
                        <h3 class="post-title"><a
                                href="{{URL::to('/'.$post->id.'-'.str_replace(' ','-',$post->title))}}.html">{{$post->title}}</a>
                        </h3>
                    </div>
                </div>
                <!--                            </div>-->
            @endforeach
        </div>
        <!-- /post widget -->
    @endif
@endforeach
