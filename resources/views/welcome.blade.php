<!DOCTYPE html>
<html lang="en">
<head>
    {{--bagian kerangka dari website meliputi header,contetnt,footer ,css,js link--}}
   
    <title>ScriptSi </title>
    <link rel = "icon" href =  
"https://media.geeksforgeeks.org/wp-content/cdn-uploads/gfg_200X200.png" 
        type = "image/x-icon"> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   
    <link rel="stylesheet" href="{{url('css/Style.css')}}">
    <link rel="stylesheet" href="{{url('css/bootstrap_min.css')}}">
    <link rel="stylesheet" href="{{url('css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{url('css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{url('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{url('css/owl.theme.default.min.css')}}">



    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/Style.css">

</head>
<body>

@include('header')
@yield('content')


<footer class="site-footer border-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5 mb-lg-0">
                {{--<div class="row">--}}
                    {{--<div class="col-md-12">--}}
                        {{--<h3 class="footer-heading mb-4">Navigations</h3>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-6 col-lg-4">--}}
                        {{--<ul class="list-unstyled">--}}
                            {{--<li><a href="#">Sell online</a></li>--}}
                            {{--<li><a href="#">Features</a></li>--}}
                            {{--<li><a href="#">Shopping cart</a></li>--}}
                            {{--<li><a href="#">Store builder</a></li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-6 col-lg-4">--}}
                        {{--<ul class="list-unstyled">--}}
                            {{--<li><a href="#">Mobile commerce</a></li>--}}
                            {{--<li><a href="#">Dropshipping</a></li>--}}
                            {{--<li><a href="#">Website development</a></li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-6 col-lg-4">--}}
                        {{--<ul class="list-unstyled">--}}
                            {{--<li><a href="#">Point of sale</a></li>--}}
                            {{--<li><a href="#">Hardware</a></li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="block-5 mb-5">
                    <h3 class="footer-heading mb-4">Contact Info</h3>
                    <ul class="list-unstyled">
                        <li>Jalan Kebon Jeruk Raya No.27 1 9, RT.1/RW.9, Kb. Jeruk, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11530</li>
                        <li><a href="https://hangouts.google.com/webchat/start?hl=en-ID&ht=0&hcb=0&lm1=1544294515958&hs=84&hmv=1&ssc=WyIiLDAsbnVsbCxudWxsLG51bGwsW10sbnVsbCxudWxsLG51bGwsbnVsbCxudWxsLDg0LG51bGwsbnVsbCxudWxsLFsxNTQ0Mjk0NTE1OTU4XSxudWxsLG51bGwsW1tudWxsLG51bGwsW251bGwsIis2MjIxNTM2OTY5NjkiXV1dLG51bGwsbnVsbCx0cnVlLG51bGwsbnVsbCxudWxsLG51bGwsbnVsbCxudWxsLFtdLFtdLG51bGwsbnVsbCxudWxsLFtdLG51bGwsbnVsbCxudWxsLFtdLG51bGwsbnVsbCxbXV0.&action=chat&pn=%2B622153696969">(021) 53696969</a></li>
                        <li>emailbinus@binus.com</li>
                    </ul>
                </div>

                {{--<div class="block-7">--}}
                    {{--<form action="#" method="post">--}}
                        {{--<label for="email_subscribe" class="footer-heading">Subscribe</label>--}}
                        {{--<div class="form-group">--}}
                            {{--<input type="text" class="form-control py-4" id="email_subscribe" placeholder="Email">--}}
                            {{--<input type="submit" class="btn btn-sm btn-primary" value="Send">--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
</footer>
</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/aos.js"></script>

<script src="js/main.js"></script>

</body>
</html>