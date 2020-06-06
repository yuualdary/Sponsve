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
                    <div class="row" style="padding-left:20px">
                        
                            <table class="table table-bordered">
                            <tr>
                                <td>
                                    Company Name
                                    <br>
                                </td>
                                <td>
                                    Owner 
                                    <br>
                                </td>
                                <td>
                                   Address
                                   <br>
                                </td>

                                <td>
                                        Detail
                                </td>
                            
                             
                            </tr>
                         @foreach($getListOfCompany as $Com )

                                <tr>
                                    <td>
                                     <b> {{$Com->company_name}}</b>
                                    </td>
                                    <td>
                                        {{$Com->name}}
                                    </td>
                                    <td>    
                                      <i>{{$Com->company_address}}</i>
                                    </td>
                                    <td>

                                    <a href="{{url('/toCompanyFromList/'.$Com->company_id)}}"> <i class="medium material-icons">create</i></a>
                                        
                                    </td>
                   
                                </tr>
                             
                          @endforeach
                                         
               
                        </table>
                     </div>
                </div>
                     
                    
            </div>
        </div>
@endsection