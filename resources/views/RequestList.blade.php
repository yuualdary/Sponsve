@extends('welcome')
@section('content')


    <div class="panel panel-default">
        <div class="panel-body">
        <div class="container">

            <div class="row mb-5">
                <div class="col-md-9 order-2">

                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <div class="float-md-left mb-4"><h2 class="text-black h5">List of Company</h2></div>
                        </div>
                    </div>
                    <div class="row mb-5">
                
                        <table>
                            <tr>
                                <td>
                                    Company Name
                                    <br>
                                </td>
                                <td>
                                    Requestor
                                    <br>
                                </td>
                                <td>
                                   Address
                                   <br>
                                </td>

                                <td>
                                        Detail Company
                                </td>

                                <td>
                                        

                                </td>
                            
                             
                            </tr>
                         @foreach($getAllRequest as $Req )

                                <tr>
                                    <td>
                                     <b> {{$Req->company_name}}</b>
                                    </td>
                                    <td>
                                        {{$Req->name}}
                                    </td>
                                    <td>    
                                      <i>{{$Req->company_address}}</i>
                                    </td>
                                    <td>

                                    <a href="{{url('/toCompanyDet/'.$Req->req_fromcompany)}}"> <i class="medium material-icons">create</i></a>
                                        
                                    </td>


                                    <td>                                   
                                        
                                            <a href="{{url('/toCompanyDet/'.$Req->company_id)}}"> <i class="medium material-icons">check</i></a>
                                                <span class="tooltiptext"> Accept <span>
                                      
                                        
                                            <a href="{{url('/toCompanyDet/'.$Req->company_id)}}"> <i class="medium material-icons">close</i></a>
                                                <span class="tooltiptext"> Reject <span>
                                       


                                    </td>
                   
                                </tr>
                             
                          @endforeach
                                         
               
                        </table>
                     </div>
                </div>
                     
                    
            </div>
        </div>
@endsection