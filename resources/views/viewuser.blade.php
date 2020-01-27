@extends('welcome')
@section('content')
    {{--<div class="bg-light py-3">--}}
        {{--<div class="container">--}}
            {{--<div class="row">--}}
                {{--<div class="col-md-12 mb-0"><a href="{{ url('/') }}">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Update</strong></div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--melihat user siapa saja yang masuk ke DB dan bisa melakukan edit--}}
    <div class="site-section">
        <div class="container">

            <div class="row mb-5">
                <div class="col-md-9 order-2">

                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <div class="float-md-left mb-4"><h2 class="text-black h5">Edit Profile</h2></div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <table>
                            <tr>
                                <td>
                                    From
                                    <br>
                                </td>
                                <td>
                                    Subject
                                    <br>
                                </td>
                                <td>
                                   Event
                                   <br>
                                </td>
                            
                                <td>
                                    Download File
                                    <br>
                                </td>
                            </tr>
                         @foreach($getAlldata as $u )
                             @if($u->ptid_proposal === Auth::user()->id)

                                <tr>
                                    <td>
                                     <b>   {{$u->name}}</b>
                                    </td>
                                    <td>
                                        {{$u->proposal_title}}
                                    </td>
                                    <td>    
                                      <i>{{$u->title}}</i>
                                    </td>
                                   
                                    <td>
                                        <a  href="{{url('/toDetailPropo/'.$u->proposal_id)}}">View</a>


                                    </td>
                                </tr>
                             
                                @endif
                              @endforeach
                      
                    

                   
                    @foreach($getAlldataForUser as $fu)
                    @if($fu->userid_proposal === Auth::user()->id) 

                    
                                <tr>
                                    <td>
                                     <b>   {{$fu->name}}</b>
                                    </td>
                                    <td>
                                        {{$fu->proposal_title}}
                                    </td>
                                    <td>    
                                      <i>{{$fu->title}}</i>
                                    </td>
                                   
                                    <td>
                                        <a  href="{{url('/toDetailPropo/'.$fu->proposal_id)}}">View</a>
                                        <a  href="{{url('/toDetailPropo2/'.$fu->proposal_id)}}">Revision</a>


                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </table>
                     </div>
                   
                     
                    
            </div>
        </div>
@endsection