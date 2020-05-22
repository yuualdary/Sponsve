@extends('welcome')
@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="{{ url('/') }}">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Shop</strong></div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">

            <div class="row mb-5">
                <div class="col-md-9 order-2">


                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <div class="float-md-left mb-4"><h2 class="text-black h5">All My Event</h2></div>
                        </div>
                    </div>
{{--menampilkan product yang sudah dibuat--}}
                    <div class="row mb-5">
                        @foreach($event as $i)

                        @if($i->userid_tocompany ===  Auth::user()->userid_tocompany)
                        <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                            <div class="block-4 text-center border">
                                <div class="block-4-text p-4">
                                <i><b style=" color:#000000"> <img src= "{{url('/' .$i->image)}}" style="width:30px; height:30px; float:left; border-radius:50%; margin-right:25px;"> {{  $i->name }} </b></i>&nbsp;&nbsp;
                                   <br>
                                   <br>
                            
                                    <figure class="block-4-image">
                                        <a href="{{url('detail/'.$i->id)}}"><img src="{{url($i->photo)}}" alt="" class="img-fluid"></a>
                                  
                                    </figure>
                                  
                                    <h3><b><a href="{{url('detail/'.$i->event_id)}}">{{$i->title}}</a></b></h3>
                                    <p class="mb-0">{{$i->caption}}</p>
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
                        @endif
                        @endforeach
                    </div>

                    <p>
                        {{$ins->appends(['search'=>request()->search])->links()}}
                        {{--{{$product->appends([request()->query])->links()}}--}}
                    </p>
            </div>
        </div>

@endsection