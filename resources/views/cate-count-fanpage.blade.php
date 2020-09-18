<!-- catagories -->
<div class="col-md-12">
    <div class="col-md-12">
        <div class="section-title">
            <h2 style="color: #FF9900;">Danh mục bài viết</h2>
        </div>
    </div>
    <div class="col-md-12">
        <!-- catagories -->
        <div class="aside-widget">
            <div class="category-widget">
                <ul>
                    @foreach ($count_post_cate as $count)
                        <li><a href="{{URL::to('category/'.$count->id.'/'.str_replace(' ','-',$count->title))}}"
                               class="cat-{{$count->color}}">{{$count->title}}<span>{{$count->count}}</span></a></li>
                    @endforeach

                </ul>
            </div>
        </div>
        <!-- /catagories -->
    </div>
</div>
<!-- catagories -->


<div class="col-md-12" style="margin-top: 20px">
    <div class="col-md-12">
        <div class="section-title">
            <h2 style="color: #FF9900;">Like Fanpage</h2>
        </div>
    </div>
    <div class="col-md-12">
        <div class="fb-page"
             data-href="https://www.facebook.com/Katun-ChatBot-113649023651172"
             data-width="350"
             data-hide-cover="false"
             data-show-facepile="true">
        </div>
    </div>
</div>


