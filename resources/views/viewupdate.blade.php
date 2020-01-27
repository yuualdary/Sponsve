@extends('welcome')
@section('content')
    {{--<div class="bg-light py-3">--}}
        {{--<div class="container">--}}
            {{--<div class="row">--}}
                {{--<div class="col-md-12 mb-0"><a href="{{ url('/') }}">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Update</strong></div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    <div class="site-section">
        <div class="container">

            <div class="row mb-5">
                <div class="col-md-9 order-2">

                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <div class="float-md-left mb-4"><h2 class="text-black h5">Update Post</h2></div>
                        </div>
                    </div>
                    <div class="row mb-5">


                        @foreach($insert as $i)
                            <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                                <div class="block-4 text-center border">
                                    <div class="block-4-text p-4">
                                        <figure class="block-4-image">
                                            <a href="{{url('detail/'.$i->id)}}"><img src="{{url($i->photo)}}" alt="" class="img-fluid"></a>
                                        </figure>
                                        <h3><a href="{{url('detail/'.$i->id)}}">{{$i->title}}</a></h3>
                                        {{--<p class="mb-0">{{$i->caption}}</p>--}}
                                        {{--<p class="mb-0">{{$i->category}}</p>--}}
                                        <p class="text-primary font-weight-bold">{{$i->price}}</p>
                                        <p class="text-primary font-weight-bold"><a href="{{url('upd/'.$i->id)}}">Update</a></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <p>
                        {{$insert->appends([request()->query])->links()}}
                    </p>
                </div>
                </div>
            </div>
        </div>
@endsection