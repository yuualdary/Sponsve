@extends('welcome')
@section('content')


    <div class="panel panel-default">
        <div class="panel-body">  
            
           
            <div class="container">
                    <div class="tab">
                            <button class="tablinks" onclick="openCity(event, 'Company')" id="defaultOpen">Detail Company</button>
                            <button class="tablinks" onclick="openCity(event, 'SOP')">Log Company</button>
                            <button class="tablinks" onclick="openCity(event, 'Invite')">Invite Request</button>
 
                    </div>
                    <div class="tabcontent"  id="Company">

                    <div class="row mb-5">
                        <div class="col-md-11 order-2">

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

                                        <td style="width:30%">
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
                                            
                                                        @if($expiredDate >= $Req->req_created_at )                    
                                                                    <i>This Request No Longer Available</i>

                                                        @else 
                                                                <a  class="btn btn-xs btn-primary" style="color:white" data-toggle="modal" data-target="#companyApprove"> 
                                                                    <i class="medium material-icons">check</i>
                                                                    Accept
                                                                </a>    
            
            
                                                                <a  class="btn btn-xs btn-primary" style="color:white" data-toggle="modal" data-target="#companyReject" > 
                                                                    <i class="medium material-icons">close</i>
                                                                    Reject
                                                                </a>
                                                                <div class="modal fade" id="companyApprove" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="col-md-12 modal-content">
                                                                                                    <div class="modal-header">
                                                                                                        <h4 class="modal-title">Accept</h4>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                                                                            ×
                                                                                                        </button>
                                                                                                        
                                                                                                    </div>
                                                                                                    <div class="modal-body">
                                                                                                        <p>
                                                                                                            Are you sure want to Accept ?
                                                                                                        </p>
                                                                                                    </div>
                                                                                                    
                                                                                                    <div class="modal-footer">
                                                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">
                                                                                                            Cancel
                                                                                                        </button>
                                                                                                        <a type="button" class="btn btn-primary"   href="{{url('/approveRequest/'.$Req->Mapping_Req_Id)}}">
                                                                                                            Yes
                                                                                                        </a>
                                                                                                    </div>
                                                                            </div><!-- /.modal-content -->
                                                                        </div>
                                                                </div>
                                                                <div class="modal fade" id="companyReject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="col-md-12 modal-content">
                                                                                                    <div class="modal-header">
                                                                                                        <h4 class="modal-title">Reject</h4>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                                                                            ×
                                                                                                        </button>
                                                                                                        
                                                                                                    </div>
                                                                                                    <div class="modal-body">
                                                                                                        <p>
                                                                                                            Are you sure want to Reject ?
                                                                                                        </p>
                                                                                                    </div>
                                                                                                    <div class="modal-footer">
                                                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">
                                                                                                            Cancel
                                                                                                        </button>
                                                                                                        <a type="button" class="btn btn-primary" href="{{url('/rejectRequest/'.$Req->Mapping_Req_Id)}}">
                                                                                                            Yes
                                                                                                        </a>
                                                                                                    </div>
                                                                            </div><!-- /.modal-content -->
                                                                        </div>
                                                                </div>
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
                        <div class="col-md-11 order-2">
                            

                            <div class="row">

                                <div class="col-md-12 mb-5">
                                    <div class="float-md-left mb-4"><h2 class="text-black h5">List of SOP</h2></div>
                                </div>
                            </div>
                            <div class="row" style="padding-left:20px">
                        
                                <table class="table table-bordered">
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
                                    @if($u->assignid_proposal === Auth::user()->id  )

                                        <tr>
                                            <td>
                                            <b>   {{$u->company_name}}</b>
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

                    <div class="tabcontent"  id="Invite">

                            <div class="row mb-5">
                                <div class="col-md-11 order-2">
                
                                    <div class="row">
                                        <div class="col-md-12 mb-5">
                                            <div class="float-md-left mb-4"><h2 class="text-black h5">Invite Company</h2></div>
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
                
                                                <td style="width:30%">
                                                    Action    
                
                                                </td>
                                            
                                             
                                            </tr>
                                         @foreach($getAllInvite as $inv )
                
                                                <tr>
                                                    <td>
                                                     <b> {{$inv->company_name}}</b>
                                                    </td>
                                                    <td>
                                                        {{$inv->name}}
                                                    </td>
                                                    <td>    
                                                      <i>{{$inv->company_address}}</i>
                                                    </td>
                
                                                    <td>    
                                                      <i>{{$inv->title}}</i>
                                                    </td>
                                                    <td>
                
                                                    <a href="{{url('/toCompanyFromList/'.$inv->req_fromcompany)}}"> <i class="medium material-icons">create</i></a>
                                                        
                                                    </td>
                
                
                                                    <td>   
                                                      
                                                                 @if( $expiredDate  >=  $inv->req_created_at)                    
                
                                                                             <i>This Request No Longer Available</i>
                
                                                                 @else 
                                                                        <a class="btn btn-xs btn-primary" style="color:white" data-toggle="modal" data-target="#invitAccept"> 
                                                                            <i class="medium material-icons">check</i>
                                                                            Accept
                                                                        </a>
                    
                    
                                                                        <a class="btn btn-xs btn-primary" style="color:white" data-toggle="modal" data-target="#invitReject" > 
                                                                            <i class="medium material-icons">close</i>
                                                                            Reject
                                                                        </a>
                                                                        <div class="modal fade" id="invitAccept" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                                        <div class="modal-dialog">
                                                                                            <div class="col-md-12 modal-content">
                                                                                                                    <div class="modal-header">
                                                                                                                        <h4 class="modal-title">Accept</h4>
                                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                                                                                            ×
                                                                                                                        </button>
                                                                                                                        
                                                                                                                    </div>
                                                                                                                    <div class="modal-body">
                                                                                                                        <p>
                                                                                                                            Are you sure want to Accept ?
                                                                                                                        </p>
                                                                                                                    </div>
                                                                                                                    <div class="modal-footer">
                                                                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">
                                                                                                                            Cancel
                                                                                                                        </button>
                                                                                                                        <a type="button" class="btn btn-primary"  href="{{url('/approveRequest/'.$inv->Mapping_Req_Id)}}">
                                                                                                                            Yes
                                                                                                                        </a>
                                                                                                                    </div>
                                                                                            </div><!-- /.modal-content -->
                                                                                        </div>
                                                                        </div>

                                                                        
                                                                        <div class="modal fade" id="invitReject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                                        <div class="modal-dialog">
                                                                                            <div class="col-md-12 modal-content">
                                                                                                                    <div class="modal-header">
                                                                                                                        <h4 class="modal-title">Reject</h4>
                                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                                                                                            ×
                                                                                                                        </button>
                                                                                                                        
                                                                                                                    </div>
                                                                                                                    <div class="modal-body">
                                                                                                                        <p>
                                                                                                                            Are you sure want to Reject ?
                                                                                                                        </p>
                                                                                                                    </div>
                                                                                                                    <div class="modal-footer">
                                                                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">
                                                                                                                            Cancel
                                                                                                                        </button>
                                                                                                                        <a type="button" class="btn btn-primary" href="{{url('/rejectRequest/'.$inv->Mapping_Req_Id)}}">
                                                                                                                            Yes
                                                                                                                        </a>
                                                                                                                    </div>
                                                                                            </div><!-- /.modal-content -->
                                                                                        </div>
                                                                        </div>    
                                                                @endif
                                                     
                
                
                
                
                                                    </td>
                                   
                                                </tr>
                                             
                                          @endforeach
                                                         
                               
                                        </table>
                                     </div>
                                </div>
                            </div>
                    </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    
    
    <!-- /.modal -->

        

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