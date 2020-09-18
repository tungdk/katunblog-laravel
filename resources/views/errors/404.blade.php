@extends('layout')
@section('title','Katun Blog')
@section('content')
    <div class="page_404" style="background-image: url({{URL::to('public/img/404_bg.png')}})">
        <div class="container">
            <div class="not_found_404">
                <div class="Ahihi404 col-md-12">
                    <span class="txt_404">4</span>
                    <img src="{{URL::to('public/img/404_face_icon.png')}}" class="txt_404">
                    <span class="txt_404">4</span>
                </div>
                <br>
                <div class="not_found col-md-12" style="text-align: center">
                    <span>Không thể tìm thấy trang</span>
                </div>
            </div>
            <div class="link_home">
                <a href="{{URL::to('/home')}}">Đưa tôi trở về trang chủ</a>
            </div>
        </div>
    </div>
@endsection
