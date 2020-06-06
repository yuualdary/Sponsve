<!DOCTYPE html>
<html lang="en">
<head>
    {{--bagian kerangka dari website meliputi header,contetnt,footer ,css,js link--}}
   
    <title>SponsVe</title>
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
    <link rel="stylesheet" href="{{url('css/swiper.css')}}">
    <link rel="stylesheet" href="{{url('css/swiper.min.css')}}">

    <link rel="stylesheet" href="{{url('css/app.css')}}">
    
    {{-- <link rel="stylesheet" href="{{url('js/jquery/jquery-3.3.1.min.js')}}"> --}}

    {{-- <link rel="stylesheet" href="{{url('resource/assets/js/app.js')}}"> --}}
 {{-- <script type="text/javascript" src="{{ asset('/js/app.js') }}"></script> --}}

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>



    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/Style.css">

    <style>
        .chat {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .chat li {
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px dotted #B3A9A9;
        }
        .chat li .chat-body p {
            margin: 0;
            color: #777777;
        }
        .panel-body-chat {
            overflow-y: scroll;
            padding:10px 10px 10px 10px;
            height: 350px;
        }
        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            background-color: #F5F5F5;
        }
        ::-webkit-scrollbar {
            width: 12px;
            background-color: #F5F5F5;
        }
        ::-webkit-scrollbar-thumb {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
            background-color: #555;
        }
        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 20% auto; /* 15% from the top and centered */
            padding: 20px;
            z-index: 1050;
            border: 1px solid #888;
            width: 40%; /* Could be more or less, depending on screen size */
        }

        /* The Close Button */
        .close {
            color: #aaa;
            float: right;
            margin-left: 470px;
            width: 15px;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .swiper-container {
            width: 100%;
            height: 100%;
        }
        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;

            /* Center slide text vertically */
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;
        }
    </style>

</head>
<body style="background-color:#fff">

    @include('header')
    
    @yield('content')

    <div id="app">
        @yield('content2')
    </div>
        


    <footer class="site-footer border-top" style="background-color: white;box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
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

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            'pusherKey' => config('broadcasting.connections.pusher.key'),
            'pusherCluster' => config('broadcasting.connections.pusher.options.cluster')
        ]) !!};
    </script>
    <script src="/js/app.js"></script>
    <script src="/js/bootstrap.js"></script>
    
    {{-- <script src="js/jquery-3.3.1.min.js"></script> --}}
    <script src="js/jquery-ui.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/aos.js"></script>
    <script>
            
    </script>

    <script src="js/swiper.js"></script>
    <script src="js/swiper.min.js"></script>
    <script>
            // var modal = document.getElementById("myModal");
    
            // // Get the button that opens the modal
            // var btn = document.getElementById("myBtn");
    
            // // Get the <span> element that closes the modal
            // var span = document.getElementsByClassName("close")[0];
    
            // // When the user clicks on the button, open the modal
            // btn.onclick = function() {
            // modal.style.display = "block";
            // }
    
            // // When the user clicks on <span> (x), close the modal
            // span.onclick = function() {
            // modal.style.display = "none";
            // }
    
            // // When the user clicks anywhere outside of the modal, close it
            // window.onclick = function(event) {
            // if (event.target == modal) {
            //     modal.style.display = "none";
            // }
            // }
    </script>
    <script>

            var swiper = new Swiper('.swiper-container', {
                slidesPerView: 2,
                spaceBetween: 600,
                centeredSlides: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
    
            // automatic slideshow
            setInterval(function() { 
                swiper.slideNext()
            },  5000);
            
        </script>


</body>
</html>