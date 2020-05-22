@extends('welcome')

@section('content')
<br>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Invite Member </div>


                    <div class="site-section">

                        @if(session()->has('failAdd'))
                        <div class="alert danger">
                            <span class="closebtn">&times;</span>  
                            <b><strong>Failed</strong> Send Your Request</>
                        </div>
                        @endif
                    <div class="container">
{{--melakukan event pada product--}}
                    <div class="panel-body">
                        <form action="{{url('/RequestCompany')}}" method="post">
                                {{ csrf_field() }}

                         <div class="form-group">
                            {{-- <label for="proposal_id" class="col-md-4 control-label">Id Propo</label>--}}
                            <input id="event_id" type="hidden" class="form-control" readonly="readonly" name="event_id" value="{{$event_id}}" required autofocus>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company_id" class="col-md-4 control-label">Set Your Invite</label>
                                           <div class="col-md-5">
                                                <select class="form-control" id="company_id" name="company_id">
                                                       <option>-Choose User-</option>
                                                       @foreach($companyList as $cL)
                                                       <option value="{{$cL->company_id}}">{{$cL->company_name}}</option>
                                                       @endforeach
                                                       
                                               </select>  
                                           </div> 
                                    </div>
                                </div>
                         

                  

                            
                        


                            <br>
                      
                            <br>
                            
                                <div class="col-md-6 col-md-offset-4">
                                   
                                <button type="submit" class="btn btn-primary" name="action">
                                Invite</button>

                                    <button type="submit" class="btn btn-primary" name="action" value="Reject">
                                        Cancel
                                    </button>
                                   
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
     

  <div class="site-section">

    <div class="container">
            {{--melakukan event pada product--}}
          <div class="panel-body">
      
    <div class="col-md-8" style="text-align:left;">
            <h3><b> <i class="large material-icons">group</i><i>Invited Company</i></b></h3> 
        </div>
        <table class="table table-bordered">
            <tr>
                <th>Company</th>
                <th>Address</th>
                <th>Status</th>
             </tr>
             @foreach($invitedMember as $member)
             


             <tr>
            
                 <td>{{$member->company_name}}</td>
                 <td>{{$member->company_address}}</td>

                 @if($member->Master_id != $submit)
                 <td>{{$member->text1}}</td>
                 
                 @else

                    <td><i>Waiting for your approval</i></td>

                 
                 

               @endif

             </tr>
           @endforeach
        </table>

        </div>
    </div>
</div>


<div class="site-section">

        <div class="container">
                {{--melakukan event pada product--}}
              <div class="panel-body">
          
        <div class="col-md-8" style="text-align:left;">
                <h3><b> <i class="large material-icons">group</i><i> List Of Member</i></b></h3> 
            </div>
            <table class="table table-bordered">
                <tr>
                    <th>Company</th>
                    <th>Address</th>
                    <th>Status</th>
                 </tr>
                 @foreach($yourMember as $memberList)
                 
    
    
                 <tr>
                
                     <td>{{$memberList->company_name}}</td>
                     <td>{{$memberList->company_address}}</td>
    
                     @if($memberList->Master_id != $submit)
                     <td>{{$memberList->text1}}</td>
                     
                     @else
    
                        <td><i>Waiting for your approval</i></td>
    
                     
                     
    
                   @endif
    
                 </tr>
               @endforeach
            </table>
    
            </div>
        </div>
    </div>






    <script>


var close = document.getElementsByClassName("closebtn");
var i;

for (i = 0; i < close.length; i++) {
  close[i].onclick = function(){
    var div = this.parentElement;
    div.style.opacity = "0";
    setTimeout(function(){ div.style.display = "none"; }, 600);
  }
}
        </script>


@endsection
