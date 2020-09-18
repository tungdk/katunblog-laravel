<!-- container -->
<div class="container">
    <!-- row -->
    <div class="row">
        <div class="col-md-5">
            <div class="footer-widget">
                <div class="footer-logo">
                    <a href="index.php" class="logo" title="Katun Blog"><img src="{{URL::to('public/img/text-katun.png')}}" alt="logo"></a>
                </div>

                <div class="footer-copyright" style="font-size: 15px">
                    <span>&copy; Copyright &copy;<script>document.write(new Date().getFullYear());</script><br></span>
                    <a href="https://facebook.com/tungdk228" target="_blank">Deverlop by Đinh Khắc Tùng - NUCE</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="footer-widget">
                        <h3 class="footer-title">Giới thiệu</h3>
                        <ul class="footer-links">
                            <li><a href="{{URL::to('/about')}}">Giới thiệu</a></li>
                            <li><a href="{{URL::to('/contact')}}">Liên hệ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="footer-widget">
                        <h3 class="footer-title">Danh mục</h3>
                        <ul class="footer-links">
                            @foreach ($categories as $cate)
                            <li><a href="{{URL::to('category/'.$cate->id.'/'.str_replace(' ','-',$cate->title))}}" title="{{$cate->title}}">{{$cate->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="footer-widget">
                <h3 class="footer-title">Đăng kí nhận tin mới</h3>
                <div class="footer-newsletter">
                    <form method="POST">
                        <input id="footer_email" class="input" type="email" name="email" placeholder="Điền email của bạn" required="required">
                        <p style="color:red; dislay:none;" class="error_footer error_footer_Email"></p>
                        <button id="submit_newsletter" type="submit" name="submit">Đăng kí</button>
                        <p style="color:green; dislay:none;" class="error_footer newsletter"></p>
                        <p style="color:blue; dislay:none;" class="footer-loading"></p>
                    </form>
                </div>
                <ul class="footer-social">
                    <li><a href="https://facebook.com/tungdk228" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://facebook.com/tungdk228" target="_blank"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="https://facebook.com/tungdk228" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="https://facebook.com/tungdk228" target="_blank"><i class="fa fa-pinterest"></i></a></li>
                </ul>
            </div>
        </div>

    </div>
    <!-- /row -->
</div>

