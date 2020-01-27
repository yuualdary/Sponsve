@extends('welcome')

@section('content')


 <div class="container">
 
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Update Your Picture</div>
{{--menampilakn data user masing - masing sesuai hasil register yang mana bisa melakukan update pada profile --}}
                    @if(session()->has('successMsg'))
                    <div class="alert success">
                        <span class="closebtn">&times;</span>  
                        <b><strong>Success</strong> Edit Your File</>
                    </div>
                    @endif 

                    @if(session()->has('successAdd'))
                    <div class="alert success">
                        <span class="closebtn">&times;</span>  
                        <b><strong>Success</strong> Add your member</>
                    </div>
                    @endif  

                    
                    @if(session()->has('successDel'))
                    <div class="alert success">
                        <span class="closebtn">&times;</span>  
                        <b><strong>Success</strong> Delete your member</>
                    </div>
                    @endif  
                    @if( Auth::user()->position_id != $admin ) 

                    <div class="panel-body">
                    <form action="{{url('/editCompany')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                           
                                <label>Detail For Company </label>
                            <br>

                            @foreach($owner as $o)
           
                                 <label><i>Owner : {{$o->name}}</i></label>

                            @endforeach

                            <br>

                      

                         

                            <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                            @foreach($compDet as $compDet)

                            
                            <div class="col-md-6">
                            <input id="company_id" type="hidden" class="form-control" readonly="readonly" name="company_id" value="{{$compDet->company_id}}" required autofocus>
                            

                             </div>



                            <div class="form-group{{ $errors->has('company_photo') ? ' has-error' : '' }}">
                                <label for="company_photo" class="col-md-4 control-label"></label>
                               <div class="col-md-4">
                               <img src="{{url('/'.$compDet->company_photo)}}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
                           </div>
                            <br>

                                <label for="company_name" class="col-md-4 control-label">Company Name</label>
                            

                                <div class="col-md-6">
                                    <input id="company_name" type="text" class="form-control" name="company_name" value="{{$compDet->company_name}}" required autofocus>
                                    <br>

                                </div>
                            

                            <div class="form-group{{ $errors->has('company_address') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Company address</label>

                                <div class="col-md-6">
                                    <input id="company_address" type="textarea" class="form-control" name="company_address" value="{{$compDet->company_address}}" required autofocus >
                                    <br>

                                    
                                </div>
                            </div>
                            
                            <div class="form-group{{ $errors->has('company_phone') ? ' has-error' : '' }}">
                                <label for="company_phone" class="col-md-4 control-label">Company Phone</label>

                                <div class="col-md-6">
                                    <input id="company_phone" type="number" class="form-control" name="company_phone"  value="{{$compDet->company_phone}}"required autofocus>
                                    <br>

                                </div>
                            </div>
                           
                            <div class="form-group{{ $errors->has('website_address') ? ' has-error' : '' }}">
                             <label for="website_address" class="col-md-4 control-label">website address</label>

                                <div class="col-md-6">
                                    <input id="website_address" type="text" class="form-control" name="website_address"  value="{{$compDet->website_address}}"required autofocus>
                                    <br>
                                   
                                </div>
                            </div>




                            <div class="form-group{{ $errors->has('social_media') ? ' has-error' : '' }}">
                                <label for="social_media" class="col-md-4 control-label">Social media</label>

                                <div class="col-md-6">
                                    <input id="social_media" type="text" class="form-control" name="social_media"  value="{{$compDet->social_media}}"required autofocus>
                                    <br>
                                  
                                </div>
                            </div>


                            

                            
                            
                        @endforeach 
                            
                    </form>                         
                    

                    @elseif(Auth::user()->position_id === $admin && Auth::user()->userid_tocompany === $getdata->company_id)

                    <div class="panel-body">
                    <form action="{{url('/editCompany')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                           
                                <label>Detail For Company </label>
                            <br>

                            @foreach($compDet as $com)
           
                                 <label><i>Owner : {{$com->name}}</i></label>

                            @endforeach

                            <br>

                      

                         

                            <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                            @foreach($compDet as $compDet)

                            
                            <div class="col-md-6">
                            <input id="company_id" type="hidden" class="form-control" readonly="readonly" name="company_id" value="{{$compDet->company_id}}" required autofocus>
                            

                             </div>



                            <div class="form-group{{ $errors->has('company_photo') ? ' has-error' : '' }}">
                                <label for="company_photo" class="col-md-4 control-label"></label>
                               <div class="col-md-4">
                               <img src="{{url('/'.$compDet->company_photo)}}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
                           </div>
                            <br>

                                <label for="company_name" class="col-md-4 control-label">Company Name</label>
                            

                                <div class="col-md-6">
                                    <input id="company_name" type="text" class="form-control" name="company_name" value="{{$compDet->company_name}}" required autofocus>
                                    <br>

                                </div>
                            

                            <div class="form-group{{ $errors->has('company_address') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Company address</label>

                                <div class="col-md-6">
                                    <input id="company_address" type="textarea" class="form-control" name="company_address" value="{{$compDet->company_address}}" required autofocus >
                                    <br>

                                    
                                </div>
                            </div>
                            
                            <div class="form-group{{ $errors->has('company_phone') ? ' has-error' : '' }}">
                                <label for="company_phone" class="col-md-4 control-label">Company Phone</label>

                                <div class="col-md-6">
                                    <input id="company_phone" type="number" class="form-control" name="company_phone"  value="{{$compDet->company_phone}}"required autofocus>
                                    <br>

                                </div>
                            </div>
                           
                            <div class="form-group{{ $errors->has('website_address') ? ' has-error' : '' }}">
                             <label for="website_address" class="col-md-4 control-label">website address</label>

                                <div class="col-md-6">
                                    <input id="website_address" type="text" class="form-control" name="website_address"  value="{{$compDet->website_address}}"required autofocus>
                                    <br>
                                   
                                </div>
                            </div>




                            <div class="form-group{{ $errors->has('social_media') ? ' has-error' : '' }}">
                                <label for="social_media" class="col-md-4 control-label">Social media</label>

                                <div class="col-md-6">
                                    <input id="social_media" type="text" class="form-control" name="social_media"  value="{{$compDet->social_media}}"required autofocus>
                                    <br>
                                  
                                </div>
                            </div>                           
                            <br>  
                            
                            <label for="company_photo" class="col-md-4 control-label">Company Photo</label>
                               <div class="col-md-6">
                                   <input type="file" name ="company_photo" >
                                   <br>
                                 
                                </div>
                           
                            <br>

            
                            <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary" name="action" value="Edit">
                                            Save Data
                                        </button>
                                        <br>
                                        <br>
                                    </div>
                             </div>                         
                        @endforeach                           
                    </form>

                    

                  

                    <br>
                    <form action="{{url('/addMember')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}

                   

                            
                    
                            <input id="company_id" type="hidden" class="form-control" readonly="readonly" name="company_id" value="{{$testVar}}" required autofocus>
                            

                     
                     <div class="form-group">
                         <label for="addMember" class="col-md-4 control-label">Set Your Member</label>
                            <div class="col-md-5">
                                 <select class="form-control" id="type" name="id">
                                        <option>-Choose User-</option>
                                        @foreach($getAlluser as $u)
                                        <option value="{{$u->id}}">{{$u->name}} | <b><i>{{$u->user_code}}</i></b></option>
                                        @endforeach
                                        
                                </select>  
                            </div> 
                        

                     
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary">
                            <i class="medium material-icons">add</i>
                            {{--Jangan Lupa Download Icon--}}
                                    </button>
                                        <br>
                                        <br>
                                 </div>
                         </div>   
                         </div>  
                                     

                    </form>
                    @else   
                    <div class="panel-body">
                    <form action="{{url('/editCompany')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                           
                                <label>Detail For Company </label>
                            <br>

                            @foreach($owner as $o)
           
                                 <label><i>Owner : {{$o->name}}</i></label>

                            @endforeach

                            <br>

                      

                         

                            <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                            @foreach($reqDet as $r)

                            
                            <div class="col-md-6">
                            <input id="company_id" type="hidden" class="form-control" readonly="readonly" name="company_id" value="{{$r->company_id}}" required autofocus>
                            

                             </div>



                            <div class="form-group{{ $errors->has('company_photo') ? ' has-error' : '' }}">
                                <label for="company_photo" class="col-md-4 control-label"></label>
                               <div class="col-md-4">
                               <img src="{{url('/'.$r->company_photo)}}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
                           </div>
                            <br>

                                <label for="company_name" class="col-md-4 control-label">Company Name</label>
                            

                                <div class="col-md-6">
                                    <input id="company_name" type="text" class="form-control" name="company_name" value="{{$r->company_name}}" required autofocus>
                                    <br>

                                </div>
                            

                            <div class="form-group{{ $errors->has('company_address') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Company address</label>

                                <div class="col-md-6">
                                    <input id="company_address" type="textarea" class="form-control" name="company_address" value="{{$r->company_address}}" required autofocus >
                                    <br>

                                    
                                </div>
                            </div>
                            
                            <div class="form-group{{ $errors->has('company_phone') ? ' has-error' : '' }}">
                                <label for="company_phone" class="col-md-4 control-label">Company Phone</label>

                                <div class="col-md-6">
                                    <input id="company_phone" type="number" class="form-control" name="company_phone"  value="{{$r->company_phone}}"required autofocus>
                                    <br>

                                </div>
                            </div>
                           
                            <div class="form-group{{ $errors->has('website_address') ? ' has-error' : '' }}">
                             <label for="website_address" class="col-md-4 control-label">website address</label>

                                <div class="col-md-6">
                                    <input id="website_address" type="text" class="form-control" name="website_address"  value="{{$r->website_address}}"required autofocus>
                                    <br>
                                   
                                </div>
                            </div>




                            <div class="form-group{{ $errors->has('social_media') ? ' has-error' : '' }}">
                                <label for="social_media" class="col-md-4 control-label">Social media</label>

                                <div class="col-md-6">
                                    <input id="social_media" type="text" class="form-control" name="social_media"  value="{{$r->social_media}}"required autofocus>
                                    <br>
                                  
                                </div>
                            </div>

                        </form>
                            

                            
                            
                        @endforeach 
                    @endif
                    <br>
                    
                    <div class="col-md-6" style="text-align:left;">
                        <h3><b> <i class="large material-icons">group</i><i> List Of Member</i></b></h3> 
                    </div>
                    <table>
                        <tr>
                            <th>Position</th>
                            <th>Name</th>
                            <th>Initial</th>
                            <th>Drop Member</th>
                         </tr>
                         @foreach($getListMember as $member)
                         


                         <tr>
                        
                             <td>{{$member->position}}</td>
                             <td>{{$member->name}}</td>
                             <td>{{$member->user_code}}</td>
                             

                             <td>
                                <input id="id" type="hidden" class="form-control" readonly="readonly" name="id" value="{{$member->id}}" required autofocus>
                                <input id="userid_tocompany" type="hidden" class="form-control" readonly="readonly" name="userid_tocompay" value="{{$member->userid_tocompany}}" required autofocus>


                                   @if( Auth::user()->position_id === $admin) 
                                                   
                                   <a href="{{url('/setPosition/'.$member->id)}}" class="btn btn-primary" >       
                                        Send As Admin
                                    </button>

                                        <a href="{{url('/deleteUser/'.$member->id)}}" class="btn btn-primary" >       
                                        <i class="medium material-icons">delete</i></a>
                                        @else

                      
                                    </button>

                                   
                                    
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


