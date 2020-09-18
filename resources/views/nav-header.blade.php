<style>
    .more{
        height: 70px;
        color: #212631;
        padding: 25px 20px;
    }
    .nav-menu li{
        /*display: inline-table;*/
        position: relative;
    }
    .nav-menu li a{
        text-decoration: none;
        display: block;
    }
    .nav-menu  .sub-menu{
        display: none;
        margin-top: 20px;
        margin-left: -20px;
        /*width: 150px;*/
        background-color: white;
        z-index: 1000;
    }
    .nav-menu li:hover .sub-menu{
        display: block;
    }
</style>
<div id="nav">
    <!-- Main Nav -->
    <div id="nav-fixed">
      <div class="row">
          <div class="container">
              <!-- logo -->
              <div class="nav-logo ">
                  <a href="{{URL::to('home')}}" class="logo" title="Trang chủ"><img src="{{asset('public/img/text-katun.png')}}"></a>
              </div>
              <!-- /logo -->

              <!-- nav -->
              <ul class="nav-menu nav navbar-nav ">
                  <?php $i = 0; ?>
                  @foreach ($categories as $cate)
                      <li class="cat-{{$cate->color}}">
                          <a href="{{URL::to('category/'.$cate->id.'/'.str_replace(' ','-',$cate->title))}}" title="{{$cate->title}}">
                              {{$cate->title}}
                          </a>
                      </li>
                      <?php $i++;?>
                      @if($i==5)
                          <li class="more"> More <i class="fa fa-sort-down"></i>
                              <ul class="sub-menu">
                                  @for ($i=5; $i < count($categories);$i++)
                                      <li class="cat-{{$categories[$i]->color}}">
                                          <a href="{{URL::to('category/'.$categories[$i]->id.'/'.str_replace(' ','-',$categories[$i]->title))}}" title="{{$categories[$i]->title}}">
                                              {{$categories[$i]->title}}
                                          </a>
                                      </li>
                                  @endfor
                              </ul>
                          </li>
                          @break
                      @endif
                  @endforeach
              </ul>
              <!-- /nav -->

              <!-- search & aside toggle -->
              <div class="nav-btns " >
                  {{--                <div class="nav-search col-md-4">--}}
                  <button class="aside-btn"><i class="fa fa-bars"></i></button>
                  <button class="search-btn" title="Tìm kiếm"><i class="fa fa-search"></i></button>
                  <form class="search-form" action="{{URL::to('search')}}" method="GET">
                      <input class="search-input" type="text" name="search" id="search_header" placeholder="Enter để tìm kiếm ..." required="required">
                      <button class="search-close"><i class="fa fa-times"></i></button>
                  </form>

                  @include('account')
              </div>
              <div class="list-group" id="show-list" style="margin-top: 135px">
{{--                  <a href="" class="list-group-item">List1</a>--}}
              </div>

              <!-- /search & aside toggle -->


          </div>
      </div>
    </div>
    <!-- /Main Nav -->

    <!-- Aside Nav -->
    <div id="nav-aside">
        <!-- nav -->
        <div class="section-row">
            <ul class="nav-aside-menu">
                <li><a href="{{URL::to('/home')}}">Trang chủ</a></li>
                <li><a href="{{URL::to('/about')}}">Giới thiệu</a></li>
                <li><a href="{{URL::to('/contact')}}">Liên hệ</a></li>
            </ul>
        </div>
        <!-- /nav -->

        <!-- widget posts -->
        <div class="section-row">
            <h3>Bài viết hay nhất</h3>
            @foreach ($nav_three_post as $post)
            <div class="post post-widget">
                <a class="post-img" href="{{URL::to('/'.$post->id.'-'.str_replace(' ','-',$post->title))}}.html"><img src="{{URL::to('public/uploads/imagePost/'.$post->thumbnail)}}" alt=""></a>
                <div class="post-body">
                    <h3 class="post-title"><a href="{{URL::to('/'.$post->id.'-'.str_replace(' ','-',$post->title))}}.html">{{$post->title}}</a></h3>
                </div>
            </div>
            @endforeach
        </div>
        <!-- /widget posts -->

        <!-- social links -->
        <div class="section-row">
            <h3>Theo dõi chúng tôi</h3>
            <ul class="nav-aside-social">
                <li><a href="https://facebook.com/tungdk228" target="_blank"><i class="fa fa-facebook"></i></a></li>
                <li><a href="https://facebook.com/tungdk228" target="_blank"><i class="fa fa-twitter"></i></a></li>
                <li><a href="https://facebook.com/tungdk228" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                <li><a href="https://facebook.com/tungdk228" target="_blank"><i class="fa fa-pinterest"></i></a></li>
            </ul>
        </div>
        <!-- /social links -->

        <!-- aside nav close -->
        <button class="nav-aside-close"><i class="fa fa-times"></i></button>
        <!-- /aside nav close -->
    </div>
    <!-- Aside Nav -->
</div>
