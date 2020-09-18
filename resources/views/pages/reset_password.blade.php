@extends('layout')
@section('title','Lấy lại mật khẩu')
@section('content')
    <div class="container">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <a href="{{URL::to('/home')}}">Trang chủ </a> > Lấy lại mật khẩu
                </header>
                @if(session('msg'))
                    <div class="alert alert-warning">
                        {{session('msg')}}
                    </div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif
                <div class="panel-body">
                    <div class="position-center">
                        <form  method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mật khẩu</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                                       placeholder="Mật khẩu">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Xác nhận mật khẩu</label>
                                <input type="password" name="comfirm_password" class="form-control"
                                       id="exampleInputPassword1" placeholder="Xác nhận mật khẩu">
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </div>
@endsection
