@extends('layout')
@section('title','Quên mật khẩu')
@section('content')

    <div class="container" style="margin-top: 10px; ">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <a href="{{URL::to('/home')}}">Trang chủ</a> > Lấy lại mật khẩu
                </header>
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{session('error')}}
                    </div>
                @endif
                @if(session('success'))
                <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif
                <div class="panel-body">
                    <div class="position-center">
                        <form action="{{URL::to('/password/email')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="">Vui lòng cung cấp email để lấy lại mật khẩu</label>
                                <input type="text" class="form-control" id="email" placeholder="Email" name="email"
                                       required="required">
                            </div>
                            <button type="submit" name="" class="btn btn-primary">Gửi liên kết đến email</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection
