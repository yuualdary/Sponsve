@extends('welcome')
@section('content')


    <div class="panel panel-default">
        <div class="panel-body">  
            
           
             <div class="container">
                    <div class="tab">
                            <button class="tablinks" onclick="openCity(event, 'Company')" id="defaultOpen">Detail Company</button>
                            <button class="tablinks" onclick="openCity(event, 'SOP')">Log Company</button>
                         </div>
            <div class="tabcontent"  id="Company">

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
                                   Event Name
                                   <br>
                                </td>

                                <td>
                                     Detail Company
                                </td>

                                <td>
                                    Action    

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
                                      <i>{{$Req->title}}</i>
                                    </td>
                                    <td>

                                    <a href="{{url('/toCompanyFromList/'.$Req->req_fromcompany)}}"> <i class="medium material-icons">create</i></a>
                                        
                                    </td>


                                    <td>   
                                      
                                                 @if($Req->req_created_at >= $expiredDate )                    

                                                             <i>This Request No Longer Available</i>

                                                 @else 
                                                             <a href="{{url('/approveRequest/'.$Req->Mapping_Req_Id)}}"> <i class="medium material-icons">check</i></a>
                                                             <span class="tooltiptext"> Accept <span>
    
    
                                                         <a href="{{url('/rejectRequest/'.$Req->Mapping_Req_Id)}}"> <i class="medium material-icons">close</i></a>
                                                             <span class="tooltiptext"> Reject <span>
                                                @endif
                                     




                                    </td>
                   
                                </tr>
                             
                          @endforeach
                                         
               
                        </table>
                     </div>
                </div>
            </div>
            </div>

                
            <div id="SOP" class="tabcontent">
            <div class="row mb-5">
                <div class="col-md-9 order-2">
                     

                    <div class="row">

                        <div class="col-md-12 mb-5">
                            <div class="float-md-left mb-4"><h2 class="text-black h5">List of SOP</h2></div>
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
                                        <a  href="{{url('/toCompanyFromList/'.$u->proposal_id)}}">View</a>


                                    </td>
                                </tr>
                             
                                @endif
                              @endforeach
                                         
                    @foreach($getAlldataForUser as $fu)
                    @if($fu->userid_proposal === Auth::user()->id) 

                    
                                <tr>
                                    <td>
                                     <b> {{$fu->name}}</b>
                                    </td>
                                    <td>
                                        {{$fu->proposal_title}}
                                    </td>
                                    <td>    
                                      <i>{{$fu->title}}</i>
                                    </td>
                                   
                                    <td>
                                            <a  href="{{url('/toCompanyFromList/'.$u->proposal_id)}}">View</a>

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
            </div>
                     
                    
            </div>
        </div>
        <script>
        function openCity(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
              tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
              tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
          }
          document.getElementById("defaultOpen").click();
          </script>
@endsection