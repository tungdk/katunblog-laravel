<div id="myCarousel" class="container carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <?php $i=0; ?>
        @foreach($slides as $sl)
        <li data-target="#myCarousel" data-slide-to="{{$i}}"
            @if($i==0)
                class="active"
            @endif
        ></li>
            <?php $i++; ?>
        @endforeach
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <?php $i=0; ?>
        @foreach($slides as $sl)
        <div
            @if($i==0)
                class="item active"
            @else
                class="item"
            @endif
            >
            <?php $i++; ?>
            <a href="{{URL::to('/'.$sl->id.'-'.str_replace(' ','-',$sl->title))}}.html" title="{{$sl->title}}"><img src="{{URL::to('public/uploads/imagePost/'.$sl->thumbnail)}}" alt="{{$sl->title}}" width="100%" style="height:450px !important;" ></a>
            <div class="carousel-caption">
                <h3 style="color: darkorange">{{$sl->title}}</h3>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
