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
                            <div class="float-md-left mb-4"><h2 class="text-black h5">All Proposal From Company</h2></div>
                        </div>
                    </div>
{{--menampilkan product yang sudah dibuat--}}
                    <div class="row mb-5">
                        @foreach($listMyPropo as $p)

                        <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                            <div class="block-4 text-center border">
                                <div class="block-4-text p-4">
                                <i><b style=" color:#000000"> <img src= "{{url('/' .$p->image)}}" style="width:30px; height:30px; float:left; border-radius:50%; margin-right:25px;"> {{  $p->name }} </b></i>&nbsp;&nbsp;
                                   <br>
                                   <br>
                            
                                    <figure class="block-4-image">
                                        <a href="{{url('detail/'.$p->id)}}"><img src="{{url($p->photo)}}" alt="" class="img-fluid"></a>
                                  
                                    </figure>
                                  
                                    <h3>Subject : </h3><h3><b><a href="{{url('detailMyAssignList/'.$p->proposal_id)}}">{{$p->proposal_title}}</a></b></h3>
                                    <h5>Status : </h5><i class="mb-0">{{$p->text1}}</i>
                                    <h5>Last Activity :</h5><p class="text-primary font-weight-bold">{{$p->proposal_modified_at}}</p>
                                    <br>
                                     <p class="text-primary font-weight-bold"><a href="{{url('detail/'.$p->event_id)}}">Show more....</a></p>
                                </div>
                            </div>
                        </div>
                        
                        @endforeach
                    </div>

                    <p>
                        {{$viewall->appends(['search'=>request()->search])->links()}}
                        {{--{{$product->appends([request()->query])->links()}}--}}
                    </p>
            </div>
        </div>

@endsection