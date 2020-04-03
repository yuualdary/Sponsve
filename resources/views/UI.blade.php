@extends('welcome')
@section('content')
    <div class="site-wrap">
        <div class="site-section bg-white">
            <div class="swiper-container">
                        <div class="swiper-wrapper" id="slideshow">
                                <div class="swiper-slide">
                                    <img src="images/Events1.jpg" style="height: 400px; width: 900px;border-radius: 3%;">
                                </div>
                                <div class="swiper-slide">
                                    <img src="images/down.jpg" style="height: 400px; width: 900px;border-radius: 3%;">
                                </div>
                                <div class="swiper-slide">
                                    <img src="images/ipman.jpg" style="height: 400px; width: 900px;border-radius: 3%;">
                                </div>
                                <div class="swiper-slide">
                                    <img src="images/osu.png" style="height: 400px; width: 900px;border-radius: 3%;">
                                </div>  
                        </div>
                        <!-- Add Pagination -->
                        <div class="swiper-pagination" style="margin-bot: 100px"></div>
                        <!-- Add Arrows -->
                        <div class="swiper-button-next" style="margin-right: 170px; color: #F55151;"></div>
                        <div class="swiper-button-prev" style="margin-left: 170px; color: #F55151;"></div>
            </div>
        </div>
        <div class="site-section site-section-sm site-blocks-1 bg-light">
                <div class="container">
                  <div class="row bg-light">
                    <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="">
                        <div class="text">
                            <h2 class="text-uppercase">1. Free Shipping</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at iaculis quam. Integer accumsan tincidunt fringilla.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="100">
                      <div class="text">
                        <h2 class="text-uppercase">Free Returns</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at iaculis quam. Integer accumsan tincidunt fringilla.</p>
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="200">
                      <div class="text">
                        <h2 class="text-uppercase">Customer Support</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at iaculis quam. Integer accumsan tincidunt fringilla.</p>
                      </div>
                    </div>
                  </div>
                </div>
        </div>
        <div class="site-section block-3 site-blocks-2 bg-white">
                <div class="container" >
                  <div class="row justify-content-center bg-white">
                    <div class="col-md-7 site-section-heading text-center pt-4">
                      <h2>Upcoming Event</h2>
                    </div>
                  </div>
                </div>
        </div>
    </div>
    
@endsection

