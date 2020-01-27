@extends('welcome')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="site-section site-blocks-2">
                <div class="row justify-content-center text-center mb-5">
                    <h2>Categories</h2>
                </div>
                {{--tampilan awal atau home setelah login danjuga digunakan oleh guest--}}
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade" data-aos-delay="">
                        <a class="block-2-item" href="{{url('view')}}">
                            <figure class="image">
                                <img src="images/c4807d7c18231c78fce0457935d1b834.jpg" alt="" class="img-fluid">
                            </figure>
                            <div class="text">
                                <span class="text-uppercase">Collections</span>
                                <h3>Gilrs</h3>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="100">
                        <a class="block-2-item" href="{{url('view')}}">
                            <figure class="image">
                                <img src="images/c0c16b01da0263f088ebb6bea7da4148.jpg" alt="" class="img-fluid">
                            </figure>
                            <div class="text">
                                <span class="text-uppercase">Collections</span>
                                <h3>Children</h3>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="200">
                        <a class="block-2-item" href="{{url('view')}}">
                            <figure class="image">
                                <img src="images/19c0f76b215a22be2e6adb600e510950.jpg" alt="" class="img-fluid">
                            </figure>
                            <div class="text">
                                <span class="text-uppercase">Collections</span>
                                <h3>Boys</h3>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection