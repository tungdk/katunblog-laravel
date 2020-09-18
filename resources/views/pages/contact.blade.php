@extends('layout')
@section('title','Liên hệ')
@section('page-header')
    @include('page-header')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <h1 style="margin: 30px 0 30px 0;color: #900">Liên hệ</h1>
            <hr>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-md-6">
                <div class="section-row">
                    <h3>Thông tin liên hệ</h3>
                    <p></p>
                    <ul class="list-style">
                        <li><p><strong>Email:</strong> <a href="#">tungdk228@gmail.com</a></p></li>
                        <li><p><strong>Điện thoại:</strong> 999-999-9999</p></li>
                        <li><p><strong>Địa chỉ:</strong> Nam Định - Việt Nam</p></li>
                    </ul>
                </div>
                <div class="section-row">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.733594485035!2d105.84113201501876!3d21.003313486012186!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac773026b415%3A0x499b8b613889f78a!2zVHLGsOG7nW5nIMSQ4bqhaSBI4buNYyBYw6J5IEThu7FuZw!5e0!3m2!1svi!2s!4v1589643569498!5m2!1svi!2s" width="400" height="250" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
            <div class="col-md-5 col-md-offset-1">
                <div class="section-row">
                    <h3>Gửi phản hồi</h3>
                    <form action="#" method="POST">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <span>Tên</span>
                                    <input id="name" class="input" type="text" name="name" required="required">
                                    <p style="color:red; dislay:none;" class="error errorName"></p>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <span>Email</span>
                                    <input id="email" class="input" type="email" name="email" required="required">
                                    <p style="color:red; dislay:none;" class="error errorEmail"></p>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea id="contents" class="input" name="contents" placeholder="Nội dung" required="required"></textarea>
                                    <p style="color:red; dislay:none;" class="error errorContents"></p>
                                </div>
                                <button id="submit_contact" type="submit" name="submit" class="primary-button" >Gửi phản hồi</button>
                                <p style="color:green; dislay:none;" class="error contact"></p>
                                <p style="color:blue; dislay:none;" class="loading"></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
@endsection

@section('js')
    <script type="text/javascript">
    $(function () {
        $('#submit_contact').click(function (e) {
            $(':input[type="submit"]').prop('disabled', true);
            $('.loading').show().text('Đang gửi phản hồi .....');
            $name = $('#name').val();
            $email = $('#email').val();
            $contents = $('#contents').val();

            $('.error').hide();
            if(!$email){
                $('.errorEmail').show().text('Bạn vui lòng điền email');
                $(':input[type="submit"]').prop('disabled', false);
                $('.loading').hide();
            }
            if(!$name){
                $('.errorName').show().text('Bạn vui lòng điền tên');
                $(':input[type="submit"]').prop('disabled', false);
                $('.loading').hide();
            }

            if(!$contents){
                $('.errorContents').show().text('Bạn vui lòng điền nội dung');
                $(':input[type="submit"]').prop('disabled', false);
                $('.loading').hide();
            }

            if($email && $name && $contents){
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{URL::to('/contact')}}",
                    data: {
                        'name': $name,
                        'email': $email,
                        'contents': $contents
                    },
                success: function (data) {
                    console.log(data);
                    if(data.error==true){
                        $(':input[type="submit"]').prop('disabled', false);
                        $('.loading').hide();
                        $('.error').hide();
                        if(data.message.name != undefined){
                            $('.errorName').show().text(data.message.name[0]);
                        }
                        if(data.message.email != undefined){
                            $('.errorEmail').show().text(data.message.email[0]);
                        }
                        if(data.message.contents != undefined){
                            $('.errorContents').show().text(data.message.contents[0]);
                        }
                    }
                    else{
                        $('#contents').val('');
                        $(':input[type="submit"]').prop('disabled', false);
                        $('.loading').hide();
                        if(data.message.contact != undefined){
                            $('.contact').show().text(data.message.contact[0]);
                        }


                    }
                }
            });
            }
        })
    });
    </script>
@endsection
