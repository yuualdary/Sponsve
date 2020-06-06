@extends('welcome')
@section('content')

    <div class="panel panel-default">
        <div class="panel-body">
        <div class="container">

            <div class="row mb-5">
                <div class="col-md-9 order-2">

                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <div class="float-md-left mb-4"><h2 class="text-black h5">List of Log of Your Company</h2></div>
                        </div>
                    </div>
                    <div class="row" style="padding-left:20px">
                        
                            <table class="table table-bordered">
                            <tr>
                                <td>
                                    Message
                                    <br>
                                </td>
                                
                                <td>
                                   Creator
                                   <br>
                                </td>

                            
                             
                            </tr>
                         @foreach($logUserCompany as $Com )

                                <tr>
                                    <td>
                                    <img src= "{{url('/' .$Com->image)}}" style="width:40px; height:40px; float:left; border-radius:50%; margin-left:25px; margin-top:10px; margin-bottom:10px;">
                                    <br><i style="margin-left:25px; margin-top:10px;"><b> {{$Com->log_message}}</b></i>
                                    </td>
                                    <td>
                                        {{$Com->name}} {{$Com->log_createdon}}
                                    </td>
                                    
                   
                                </tr>
                             
                          @endforeach
                                         
               
                        </table>
                     </div>
                </div>
                     
                    
            </div>
        </div>
@endsection