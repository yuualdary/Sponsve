@extends('welcome')
@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                
                <div class="col-md-12 mb-0"><a href="{{ url('/') }}"> Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Event List</strong></div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">

            <div class="row mb-5">
                <div class="col-md-9 order-2">


                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <div class="float-md-left mb-4"><h2 class="text-black h5"></h2></div>
                                <form action="{{url('/doSearch')}}" class="site-block-top-search">
   
                                         <select  class="btn waves-effect waves-light" style="background-color:#3097D1; color:#fafafa" name="search">
                                             <option>- Month -</option>
                                             <option value="01">January</option>
                                             <option value="02">Febuary</option>
                                             <option value="03">March</option>
                                             <option value="04">April</option>
                                             <option value="05">May</option>
                                             <option value="06">June</option>
                                             <option value="07">July</option>
                                             <option value="08">August</option>
                                             <option value="09">September</option>
                                             <option value="10">October</option>
                                             <option value="11">November</option>
                                             <option value="12">December</option>
                                         </select>
                                        <button  type="submit"  class="btn waves-effect waves-light" style="background-color:#3097D1; color:#fafafa" name="action" value="month">Search <i class="small material-icons">search</i></button>

                                </form>

                        </div>
                    </div>
                    {{--menampilkan product yang sudah dibuat--}}


                    
                    <div class="row mb-5">
                        @foreach($event as $i)
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
                                    <p class="mb-0" style="width:100%;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{$i->caption}}</p>
                                    @foreach ($categoryForEvent as $catforevt)
                                    @if($i->event_id === $catforevt->catevent_toevent)

                                    <i><b> <li style="float:left; display:inline-block;"> <li style="float:left; display:inline-block;"><i class="medium material-icons" style="color:#3097D1;">local_offer</i>{{$catforevt->categoryname}}<a>,</a></li></b></i>
                                    @endif
                                     @endforeach                                    <p class="text-primary font-weight-bold" style="width:100%;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{$i->location}}</p>
                                    <br>
                                     <p class="text-primary font-weight-bold"><a href="{{url('detail/'.$i->event_id)}}">Show more....</a></p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <p>
                        {{$event->appends($data)->links()}}
                        {{--{{$product->appends([request()->query])->links()}}--}}
                    </p>
                </div>    
            </div>
        </div>
    </div>
@endsection