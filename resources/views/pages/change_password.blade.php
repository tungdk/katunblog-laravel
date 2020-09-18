@extends('layout')
@section('title','Đổi mật khẩu')
@section('content')

    @if((Auth::user()))
        <div class="section" style="margin-top: 50px">
            <div class="container">
                <div class="col-md-3 account-left">
                    <div class="info-account" style="text-align: center">
                        <div class="avatar-account">
                            <img src="{{URL::to('public/uploads/imageAuthor/'.$user->avatar)}}">
                        </div>
                        <div class="name-account">
                            <p>{{$user->name}}</p>
                        </div>
                        <hr>
                        <div class="created_at">
                            <p>Tham gia từ <br>{{$user->created_at}}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="list-action">
                        <ul>
                            <li class="item-action"><a href="{{URL::to('/user/account')}}" >Tài khoản của tôi</a></li>
                            <li class="item-action"><a href="{{URL::to('/user/comment')}}">Hoạt động bình luận</a></li>
                            <li class="item-action"><a href="{{URL::to('/user/change-password')}}" class="active-item">Đổi mật khẩu</a></li>
                            <li class="item-action"><a href="{{URL::to('/logout')}}">Thoát</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8 account-right">
                    <div class="account-title">
                        Đổi mật khẩu tài khoản
                    </div>

                    <hr>
                    <div class="account-body">
                        <div class="panel-body">
                            <div class="position-center">
                                <form method="POST" role="form">
                                    <div class="form-group">
                                        <label for="">Mật khẩu cũ</label>
                                        <input type="password" class="form-control" id="password_old" placeholder="Mật khẩu cũ" name="password_old"
                                               required="required">
                                        <p style="color:red; dislay:none;" class="error errorPasswordOld"></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Mật khẩu mới</label>
                                        <input type="password" class="form-control" id="password_new" placeholder="Mật khẩu mới" name="password_new" rows="5"
                                               required="required">
                                        <p style="color:red; dislay:none;" class="error errorPasswordNew"></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Xác nhận mật khẩu mới</label>
                                        <input type="password" class="form-control" id="password_confirm" placeholder="Xác nhận mật khẩu mới" name="password_comfirm"
                                               required="required">
                                        <p style="color:red; dislay:none;" class="error errorPasswordConfirm"></p>
                                    </div>
                                    <p style="color:red; dislay:none;" class="error errorChangePassword"></p>
                                    <p style="color:green; dislay:none;" class="error successChangePassword"></p>
                                    <div class="askLogout" id="askLogout" style="display: none">
                                        Bạn có muốn đăng xuất không?
                                        <a href="{{URL::to('/logout')}}" class="btn btn-success"><i class="fa fa-check"> Có</i></a>
                                        <a class="btn btn-warning" id="hideAskLogout"><i class="fa fa-times-rectangle"> Không</i></a>
                                    </div>
                                    <button id="submit_account_changepassword" type="submit" name="submit" class="btn btn-primary">Đổi mật khẩu</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container" style="margin-top: 50px">
            <h3 style="color: red"><i>Bạn chưa đăng nhập</i></h3>
            <script type="text/javascript">
                    $(window).load(function() {
                        openLoginModal();
                    });
            </script>
        </div>
    @endif
@endsection

@section('js')
    <script type="text/javascript">
            @if(!Auth::check()){
            $(window).load(function() {
                openLoginModal();
            });
        }
        @endif
        $(function(){
            $('#submit_account_changepassword').click(function (e) {
                $(':input[type="submit"]').prop('disabled', true);
                $password_old = $('#password_old').val();
                $password_new = $('#password_new').val();
                $password_confirm = $('#password_confirm').val();
                $('.error').hide();
                if (!$password_old) {
                    $('.errorPasswordOld').show().text('Bạn chưa điền mật khẩu cũ');
                    $(':input[type="submit"]').prop('disabled', false);
                }
                if (!$password_new) {
                    $('.errorPasswordNew').show().text('Bạn chưa điền mật khẩu mới');
                    $(':input[type="submit"]').prop('disabled', false);
                }
                if (!$password_confirm) {
                    $('.errorPasswordConfirm').show().text('Bạn chưa nhập lại mật khẩu mới');
                    $(':input[type="submit"]').prop('disabled', false);
                }

                if($password_new != $password_confirm){
                    $('.errorPasswordConfirm').show().text('Nhập lại mật khẩu không chính xác');
                    $(':input[type="submit"]').prop('disabled', false);
                }
                if ($password_old && $password_new && $password_confirm == $password_new) {
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: "{{URL::to('user/change-password')}}",
                        data: {
                            'password_old':$password_old,
                            'password_new': $password_new,
                            'password_confirm': $password_confirm,
                        },
                        success: function (data) {
                            console.log(data);
                            if (data.error == true) {
                                $(':input[type="submit"]').prop('disabled', false);
                                $('.error').hide();
                                if (data.message.password_old != undefined) {
                                    $('.errorPasswordOld').show().text(data.message.password_old[0]);
                                }
                                if (data.message.password_new != undefined) {
                                    $('.errorPasswordNew').show().text(data.message.password_new[0]);
                                }
                                if (data.message.password_confirm != undefined) {
                                    $('.errorPasswordConfirm').show().text(data.message.password_confirm[0]);
                                }
                                if (data.message.errorChangePassword != undefined) {
                                    $('.errorChangePassword').show().text(data.message.errorChangePassword[0]);
                                }

                            } else {
                                $('#password_old').val('');
                                $('#password_new').val('');
                                $('#password_confirm').val('');
                                $(':input[type="submit"]').prop('disabled', false);
                                if (data.message.successChangePassword != undefined) {
                                    $('.successChangePassword').show().text(data.message.successChangePassword[0]);
                                }
                                document.getElementById('askLogout').style.display = "block";
                            }
                        }
                    });
                }
            })
            $('#hideAskLogout').click(function () {
                document.getElementById('askLogout').style.display = "none";
            })
        });
    </script>
@endsection
