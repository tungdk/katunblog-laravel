<!-- comment -->
@foreach ($comments as $cmt)
    <div class="media">
        <div class="media-left">
            <img class="media-object" src="{{URL::to('public/uploads/imageAuthor/'.$cmt->user->avatar)}}" alt="">
        </div>
        <div class="media-body">
            <div class="media-heading">
                <p class="full_content">
                        <span class="txt-name">
                            <a class="nickname" href="" target="_blank">
                                {{$cmt->user->name}}
                            </a>
                        </span>
                    {{$cmt->message}}
                </p>
            </div>
            <div class="action_comment">

{{--                <a class="reply" cid="{{ $cmt->id }}" cname="{{$cmt->user->name}}">Trả lời</a>--}}
                <span class="time">{{$cmt->created_at}}</span>
            </div>
        </div>
    </div>
    <!-- /comment -->
@endforeach
