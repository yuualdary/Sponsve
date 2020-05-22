@extends('welcome')

@section('content')


 <div class="container">
 
        <div class="row">



          <div class="tab">
                        <button class="tablinks" onclick="openCity(event, 'DetailCompany')" id="defaultOpen">Detail Company</button>
                        <button class="tablinks" onclick="openCity(event, 'LogCompany')">Log Company</button>
                        <button class="tablinks" onclick="openCity(event, 'FAQ')">FAQ</button>

                        <div class="tabcontent"  id="DetailCompany" style="margin-top: 20px;">
                                <br>

                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-default" style="width:700px; position:center; margin-right:500px;margin-top:20px;">
                                    <div class="panel-heading">Update Your Picture</div>
                                    {{--menampilakn data user masing - masing sesuai hasil register yang mana bisa melakukan update pada profile --}}
                                    @if(session()->has('successMsg'))
                                    <div class="alert success">
                                        <span class="closebtn">&times;</span>  
                                        <b><strong>Success</strong> Edit Your File</>
                                    </div>
                                    @endif 
                                    {{-- <a href="{{url('/toLogCompany/'.Auth::user()->userid_tocompany)}}" class="btn btn-primary" > View Log</a>       --}}
                
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
                
                                      
                
                                         
                
                                            @foreach($compDet as $compDet)
                
                                            
                                            <div class="col-md-6">
                                            <input id="company_id" type="hidden" class="form-control" readonly="readonly" name="company_id" value="{{$compDet->company_id}}" required autofocus>
                                            
                
                                             </div>
                
                
                
                                            <div class="form-group{{ $errors->has('company_photo') ? ' has-error' : '' }}">
                                                <label for="company_photo" class="col-md-4 control-label"></label>
                                               <div class="col-md-4">
                                               <img src="{{url('/'.$compDet->company_photo)}}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
                                             </div>
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
                                                    <iframe width="250" height="250" id="gmap_canvas" src="https://maps.google.com/maps?q={{$compDet->company_address}}&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                                                    </iframe>
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

                                            @endforeach     
                            
                                            <div class="form-group">
                                                    <div class="col-md-6 col-md-offset-4" style="padding-bottom:20px;">
                                                        <button type="submit" class="btn btn-primary" name="action" value="Edit" style="color: white">
                                                            Save Data
                                                        </button>
                                                    </div>
                                             </div>                         
                                                             
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
                                                <i class="medium material-icons" style="font-size: 20px;color: white">add</i>
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


                                    
                                        

                                                {{-- <div class="mapouter"><div class="gmap_canvas">
                                                        <iframe width="250" height="250" id="gmap_canvas" src="https://maps.google.com/maps?q={{$r->company_address}}4&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.embedgooglemap.net/blog/divi-discount-code-elegant-themes-coupon/%22%3Etheme divi dan divi builder</a></div><style>.mapouter{position:relative;text-align:right;height:500px;width:600px;}.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:600px;}</style></div>

                                        </div> --}}




                                        </form>
                                            
                
                                 
            
                                            
                                        @endforeach 
                                    @endif
                                    <br>
                                    
                                    <div class="col-md-8" style="text-align:left;">
                                        <h3><b> <i class="large material-icons">group</i><i> List Of Member</i></b></h3> 
                                    </div>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Position</th>
                                            <th>Name</th>
                                            <th>Initial</th>
                                            <th>Action</th>
                                         </tr>
                                         @foreach($getListMember as $member)
                                         
                
                
                                         <tr>
                                        
                                             <td>{{$member->position}}</td>
                                             <td>{{$member->name}}</td>
                                             <td>{{$member->user_code}}</td>
                                             
                
                                             <td>
                                                <input id="id" type="hidden" class="form-control" readonly="readonly" name="id" value="{{$member->id}}" required autofocus>
                                                <input id="userid_tocompany" type="hidden" class="form-control" readonly="readonly" name="userid_tocompay" value="{{$member->userid_tocompany}}" required autofocus>
                
                
                                                   @if( Auth::user()->position_id === $admin && Auth::user()->id === $checkCurrIdExistInRecord && $member->id != $isAdmin)
                                                                   
                                                   <a href="{{url('/setPosition/'.$member->id)}}" class="btn btn-primary" >Send As Admin</a> 
                                                        

                                                        
                                                    <a href="{{url('/deleteUser/'.$member->id)}}" title="Delete" class="btn btn-primary" >
                                                        <i class="medium material-icons" style="font-size: 20px">delete</i>
 

                                                        @else
                                                    </a>
                
                                                   
                                                    
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

                        <div id="LogCompany" class="tabcontent">
                        <div class="panel-body">
                                <br>
                                <br>
                                <div class="container">
                                   
                        
                                    <div class="row col-md-8 mb-5">
                                        <div class="col-md-12 order-2">
                        
                                            <div class="row" >
                                                <div class="col-md-12 mb-5">
                                                    <div class="float-md-left mb-4"><h2 class="text-black h5">List of Log of Your Company</h2></div>
                                                </div>
                                            </div>
                                            <table class="table table-bordered" >
                                                    <tr>
                                                        <td >
                                                          <b><i> <a style="margin-left:150px;"> Message</a></i></b>
                                                            <br>
                                                        </td>
                                                        
                                                        <td>
                                                            <b><i>    <a style="margin-left:30px;"> Creator</a></i></b>
                                                           <br>
                                                        </td>
                                                    </tr>
                                                        @foreach($logUserCompany as $Com )
                                                        <br>
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
                        </div>
            </div>
            <div id="FAQ" class="tabcontent">
                    <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Write Coment </div>
                                    {{--melakukan comment pada detail [] product dengan menggunakan masing - masing account dan kita bisa mendelete commetn dan melihat comment orang lain--}}
                                    <div class="panel-body">
                                        @if (session('status'))
                                            <div class="alert alert-success">
                                                {{ session('status') }}
                                            </div>
                                        @endif
                                        
                                            <form id="comment-form" method="post" action="{{ route('comments.store') }}" >
                                                {{ csrf_field() }}
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" >
                                                <div class="row" style="padding: 10px;">
                                                    <div class="form-group">
                                                        <textarea class="form-control" name="comment" placeholder="Write something"></textarea>
                                                    </div>
                                                </div>
                                                <!-- @foreach($compDet as $value) -->

                                                <input  name="company_commentid" value="{{$compDet->company_id}}" type="hidden">
                                                <!-- @endforeach -->
                                                <div class="row" style="padding: 0 10px 0 10px;">
                                                    <div class="form-group">
                                                        <input type="submit" class="btn btn-primary btn-lg" style="width: 100%" name="submit">
                                                    </div>
                                                </div>
                                            </form>
                
                                    </div>
                
                                </div>
                            </div>
                    </div>

            <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-heading">Comments</div>
                            {{--menampilkan hasil comment dengan menampilkan nama,foto profile,dan isi comment berdasarkan masing - masing account--}}
                            <div class="panel-body comment-container" >
                                @foreach($comments as $comment)
                                    <div class="well">
        
                                        <i><b style=" color:#000000">   <img src= "{{url('/' .$comment->image)}}" style="width:40px; height:40px; float:left; border-radius:50%; margin-right:25px;">{{  $comment->name }} </b></i>&nbsp;&nbsp;
                               
                                        <span> {{ $comment->comment }} </span>
                                        <div style="margin-left:10px;">
                                            <a style="cursor: pointer;" id="{{ $comment->company_commentid }}" name="{{ Auth::user()->name }}" token="{{ csrf_token() }}" class="reply">Reply</a>&nbsp;
                                            <a style="cursor: pointer;"  class="delete-comment" href="{{url('doDeleteComment/'.$comment->company_commentid)}}">Delete</a>
                                            <div class="reply-form">
        
                                                <!-- Dynamic Reply form -->
        
                                            </div>
                                     
                                                
                                             <div class="well">
                                               
                                                         <div class="reply-to-reply-form">
                                                  @foreach($reply as $rep)
                                              @if($comment->cmntid == $rep->comment_id)
                                              <div id="reply">
                                                <i><b style=" color:#000000"> <img src= "{{url('/' .$rep->image)}}" style="width:40px; height:40px; float:left; border-radius:50%; margin-right:25px;"> {{  $rep->name }} </b></i>&nbsp;&nbsp;
                                                <span> {{ $rep->reply }} 
                                                    <br>
                                                    <i style="font-size: 10px;">{{$rep->rep_created_at}}</i> 
                                                
                                                </span>
        
                                                    <br>
                                                    <br>
                                                    <br>
                                                    </div>
                                            @endif
                                                  @endforeach 
                                                         <form id="comment-form" method="post" action="{{ url('/RepComment') }}" >
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="comment_id" value=" {{$comment->cmntid}}" >
                                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" >
        
                                                                <div class="row" style="padding: 10px;">
                                                                    <div class="form-group">
                                                                        <textarea class="form-control" name="reply" placeholder="Write something" style="width:500;height:100%;"></textarea>
                                                                    </div>
                                                                </div>
        
                                                                <!-- @foreach($compDet as $value) -->
                                                             
                                                                <!-- @endforeach -->
                                                                <div class="row" style="padding: 0 10px 0 10px;">
                                                                    <div class="form-group">
                                                                        <input type="submit" class="btn btn-primary btn-lg" style="width: 100% " name="submit">
                                                                    </div>
                                                                </div>
                                                         </form>
                                                       
                                                      </div>
                                                    
                                                </div>
                                             
                                    
        
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
            </div>

           
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        </div>
 </div>
    </div>
 

<script>

$(document).ready(function (){

    var currUser = {{Auth::user()->position_id }}
    var isAdmin ={{$admin}}


    // console.log(getA)

    
    if(currUser === isAdmin){

        $("#company_address").attr("readonly",true)

    }
})


var close = document.getElementsByClassName("closebtn");
var i;

for (i = 0; i < close.length; i++) {
  close[i].onclick = function(){
    var div = this.parentElement;
    div.style.opacity = "0";
    setTimeout(function(){ div.style.display = "none"; }, 600);
  }
}


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


