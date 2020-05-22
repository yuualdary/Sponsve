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


                      <div class="row mb-5">
                          @foreach($event as $i)
                          <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                              <div class="block-4 text-center border">
                                  <div class="block-4-text p-4">
                                  {{-- <i><b style=" color:#000000"> <img src= "{{url('/' .$i->image)}}" style="width:30px; height:30px; float:left; border-radius:50%; margin-right:25px;"> {{  $i->name }} </b></i>&nbsp;&nbsp; --}}
                                     <br>
                                     <br>
                              
                                      <figure class="block-4-image">
                                          <a href="{{url('detail/'.$i->id)}}"><img src="{{url($i->photo)}}" alt="" class="img-fluid"></a>
                                    
                                      </figure>
                                    
                                      <h3><b><a href="{{url('detail/'.$i->event_id)}}">{{$i->title}}</a></b></h3>
                                    <h3>{{$i->event_date}}</h3>
                                      @foreach ($categoryForEvent as $catforevt)
                                      @if($i->event_id === $catforevt->catevent_toevent)
  
                                      <i><b> <li style="float:left; display:inline-block;">#{{$catforevt->categoryname}}<a>,</a></li></b></i>
                                      @endif
                                       @endforeach                                    <p class="text-primary font-weight-bold">{{$i->location}}</p>
                                      <br>
                                       <p class="text-primary font-weight-bold"><a href="{{url('detail/'.$i->event_id)}}">Show more....</a></p>
                                  </div>
                              </div>
                          </div>
                          @endforeach
                      </div>
                    </div>
                  </div>
                </div>
        </div>
    </div>
    
@endsection

