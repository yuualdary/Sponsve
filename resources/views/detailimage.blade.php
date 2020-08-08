@extends('welcome2')

@section('content')
<br>

    @guest
    <br>
        <div class="container">
            <div class="col-md-12 mb-0" style="padding-left:0px;padding-bottom:20px;">
                        <a onclick="window.history.back();" style="color:white;" class="btn btn-xs btn-primary">   
                            <i class="material-icons">arrow_back</i>Back
                        </a>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">Detail Event</div>
                        {{--menampilkan detail dari product dan bisa melihat detail tersebut dan bisa melakukan comment terhadap product tersebut--}}
                        @if(session()->has('successAdd'))
                        <div class="alert success">
                            <span class="closebtn">&times;</span>  
                            <b><strong>Success</strong> Send Your Request</>
                        </div>
                        @endif


                        @if(session()->has('successDelComment'))
                        <div class="alert success">
                            <span class="closebtn">&times;</span>  
                            <b><strong>Success</strong> Delete Your Comment</b>
                        </div>
                        @endif

                        @if(session()->has('successDelReplies'))
                        <div class="alert success">
                            <span class="closebtn">&times;</span>  
                            <b><strong>Success</strong> Delete Your Comment</b>
                        </div>
                        @endif
                        

                    

                    


                        <div class="panel-body">
                        
                        @foreach($getUsers as $U)
                            @if($U->id === $U->user_id)

                        <i><b style=" color:#000000"> <img src= "{{url('/' .$U->image)}}" style="width:50px; height:50px; float:left; border-radius:50%; margin-right:25px;"> {{  $U->name }} </b></i>&nbsp;&nbsp;
                        <br>
                        <i style="font-size=5px">as {{$U->position}} at {{$U->company_name}}</i>
                            @endif
                        @endforeach
                        <br>
                        {{--<label class="col-md-4 control-label">{{$event->title}}</label>--}}
                        {{--<label class="col-md-4 control-label">{{$event->caption}}</label>--}}
                        {{--<label class="col-md-4 control-label">{{$event->price}}</label>--}}
                        {{--<label class="col-md-4 control-label">{{$event->category}}</label>--}}
                       <h3 style="margin-right:50%;float:right;"> <b>{{$U->title}}</b></h3>
                       <br>
                        
                       <img src="{{url('/'.$U->photo)}}" style="width:100%; ">
                       <br>
                                
                            <h4><i class="medium material-icons" style="color:#3097D1;">description</i>{{$U->caption}}</h4>
                            <hr class="simple" style="border-color:#ccc ;border-width:3px ;">
                            <h4><i class="medium material-icons" style="color:#3097D1;">place</i>{{$U->location}}</h4>
                            <h4><i class="medium material-icons" style="color:#3097D1;">event</i>{{$U->event_start}} - {{$U->event_end}}</h4>
                        </div>

                    

                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">Comments <i class="medium material-icons" style="color:#3097D1;">forum</i></div>
                        {{--menampilkan hasil comment dengan menampilkan nama,foto profile,dan isi comment berdasarkan masing - masing account--}}
                        <div class="panel-body comment-container" >
                            @foreach($comments as $comment)
                                <div class="well">
                                       <b style="float:right;"> {{$comment->comment_created_at}}</b>
                                        <hr class="simple" style="border-color:#ccc ;border-width:3px;">
                                    
                                        <div class="row">
                                                    
                                                <div class="col-sm-5">  
                                                    @if($U->user_id===$comment->user_commentid)
                                                    <i><b style=" color:#000000">   <img src= "{{url('/' .$comment->image)}}" style="width:40px; height:40px; float:left; border-radius:50%; margin-right:25px;"> <a href="{{ url('/viewDetailUserProile/'.$comment->id) }}" style="color:#000;"> {{$comment->name }}  <i class="material-icons" style="color:#3097D1" title="Event Owner">assignment_ind</i>
                                                    </a> </b></i>&nbsp;&nbsp;
                                                    @else 
                                                    <i><b style=" color:#000000">   <img src= "{{url('/' .$comment->image)}}" style="width:40px; height:40px; float:left; border-radius:50%; margin-right:25px;"> <a href="{{ url('/viewDetailUserProile/'.$comment->id) }}" style="color:#000;"> {{$comment->name }}</a> </b></i>&nbsp;&nbsp;
        
                                                    @endif
                                                    
                                                    <br>
                                                    <br>
                                                    @foreach ($positions as $pos)
                                                        @if($pos->cmntid === $comment->cmntid)
                                                             <i style="font-size=5px">as {{$pos->position}} at {{$pos->company_name}}</i>
                                                        
        
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div class="col-sm-7">
                                                    <div style="text-align: justify;"><span> {{ $comment->comment }} </span></div>
                                                </div>
                                        </div>
                                    
                                    <div style="margin-left:10px;">
                                        <a style="cursor: pointer;"class="reply"></a>&nbsp;
                                        <a style="cursor: pointer;"  class="delete-comment" href="{{url('deleteComment/'.$comment->event_id)}}"></a>
                                        <div class="reply-form">

                                            <!-- Dynamic Reply form -->

                                        </div>
                                
                                            
                                        <div class="well">
                                        
                                                    <div class="reply-to-reply-form">
                                            @foreach($reply as $rep)
                                        @if($comment->cmntid == $rep->comment_id)
                                        <div id="reply">
                                                <hr class="simple" style="border-color:#ccc ;border-width:3px ;">
                                                <b style="float:right;">{{$rep->rep_created_at}}</b> 
                                                <br>
                                                
                                                <div class="row">
                                                    
                                                    <div class="col-sm-5"> 
                                                        @if($U->user_id===$rep->user_replyid)
                                                        <i><b style=" color:#000000">   <img src= "{{url('/' .$rep->image)}}" style="width:40px; height:40px; float:left; border-radius:50%; margin-right:25px;"> <a href="{{ url('/viewDetailUserProile/'.$rep->id) }}" style="color:#000;"> {{$rep->name }}  <i class="material-icons" style="color:#3097D1" title="Event Owner">assignment_ind</i>
                                                        </a> </b></i>&nbsp;&nbsp;
                                                            @else 
                                                            <i><b style=" color:#000000">   <img src= "{{url('/' .$rep->image)}}" style="width:40px; height:40px; float:left; border-radius:50%; margin-right:25px;"> <a href="{{ url('/viewDetailUserProile/'.$rep->id) }}" style="color:#000;"> {{$rep->name }}</a> </b></i>&nbsp;&nbsp;
                                                    
                                                        @endif                                            
                                                            <span> {{ $rep->reply }} 
                                                        <br>
                                                    
                                                    </span>
                                                    </div>
                                                </div>
                                        </div>
                                        @endif
                                            @endforeach 
                                                    
                                                
                                                </div>
                                                
                                            </div>
                                        
                                

                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">Companies who join this event's     <i class="material-icons" style="color:#3097D1;">people</i></div>
                        {{--melakukan comment pada detail [] product dengan menggunakan masing - masing account dan kita bisa mendelete commetn dan melihat comment orang lain--}}
                        <div class="panel-body" style="min-height:5 0px;" >
                        
            
                            <ul style="list-style-type:none;">      
                            @foreach($listMember as $member)  
                                <li style="float:left; display:inline-block;"> <img title="{{$member->company_name}}" src= "{{ url($member->company_photo) }}" style="width:40px; height:40px; border-radius:50%"></li>
                                @endforeach
                            
                            </ul>
                            
                    
                                

                        </div>

                    </div>

                    <div class="panel panel-default">
                            <div class="panel-heading">Location  <i class="material-icons">place</i></div>
                                <div class="panel-body">
    
    
                                        <iframe width="100%" height="250" id="gmap_canvas" src="https://maps.google.com/maps?q={{$U->location}}&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                                        </iframe>
                                </div>
                            </div>
    
                            <div class="panel panel-default">
                                <div class="panel-heading">Reviews</div>
                                    <div class="panel-body">
                                        <ul style="list-style-type:none;">      
                                            @foreach($viewReview as $review)
                                            <li><img src= "{{url('/' .$review->image)}}" style="width:40px; height:40px; float:left; border-radius:50%; margin-right:25px;"></li>
                                            <li> <i><b> <a href="{{ url('/viewDetailUserProile/'.$review->id) }}" style="color:#000;"> {{$review->name }}</a> </b>&nbsp;&nbsp;</i>
                                                <a>{{$review->review_value}}</a>
         
                                            <li style=" font-size=:10px;" > <i>from  {{$review->company_name}} </i>  <a>{{$review->review_rating}}</a>&nbsp;&nbsp;</li>
                                           
    
                                          
                                            @endforeach
    
    
                                        <ul>
                                                {{$viewReview->appends(['search'=>request()->search])->links()}}
    
                                         
                                    </div>
                                </div>
                            </div>
    
                        
                         </div>
                </div>



                
            </div>
        </div>
    @else
    {{-- ////////////////////////////////////////////////////////////////// --}}

  
    <div class="container">
            @if(session()->has('successEdit'))
            <div class="alert success">
                <span class="closebtn">&times;</span>  
                <b><strong>Success</strong> Edit Your Data</>
            </div>
            @endif
            @if(session()->has('successAdd'))
            <div class="alert success">
                <span class="closebtn">&times;</span>  
                <b><strong>Success</strong> Send Your Request</b>
            </div>
            @endif

            <div class="col-md-12 mb-0" style="padding-left:0px;padding-bottom:20px;">
                    <a onclick="window.history.back();" style="color:white;" class="btn btn-xs btn-primary">   
                        <i class="material-icons">arrow_back</i>Back
                    </a>
            </div>
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                   
                    <div class="panel-heading">Detail Event</div>
                   
                    {{--menampilkan detail dari product dan bisa melihat detail tersebut dan bisa melakukan comment terhadap product tersebut--}}
                
                   
                    
                    {{-- @if(session()->has('error'))    
                        <div class="alert">
                            <span class="closebtn">&times;</span>  
                            <b><strong>Request Failed!</strong> 
                                </>
                        </div>
                
                    @endif  --}}
                    @if ($message = Session::get('CannotAdd'))
                    <div class="alert">
                            <span class="closebtn">&times;</span>                          
                            <b><strong>Your proposal has been rejected !</strong>{{ $message }}</b>
                        </div>
                     @endif
              

                 
                    
                    <div class="panel-body">
                    
                    @foreach($getUsers as $U)
                        @if($U->id === $U->user_id)

                    <i><b style=" color:#000000"> <img src= "{{url('/' .$U->image)}}" style="width:50px; height:50px; float:left; border-radius:50%; margin-right:25px;"> {{  $U->name }} </b></i>&nbsp;&nbsp;
                    <br>
                        <i style="font-size=5px">as {{$U->position}} at {{$U->company_name}}</i>
                        @endif
                    @endforeach
                    <br>
                        {{--<label class="col-md-4 control-label">{{$event->title}}</label>--}}
                        {{--<label class="col-md-4 control-label">{{$event->caption}}</label>--}}
                        {{--<label class="col-md-4 control-label">{{$event->price}}</label>--}}
                        {{--<label class="col-md-4 control-label">{{$event->category}}</label>--}}
                       <br>
                        <img src="{{url('/'.$U->photo)}}" style="width:100%; ">
                        <br>
                        <h3 style="margin-right:40%;float:right; "> <b>"{{$U->title}}"</b></h3>
                        <br>
                    <h4>Rating {{$setRating}}    <i class="material-icons">star</i>
                    </h4>
                            
                        <h4><i class="medium material-icons" style="color:#3097D1;">description</i>{{$U->caption}}</h4>
                        <hr class="simple" style="border-color:#ccc ;border-width:3px ;">
                        <h4 style="width:100%; float:center;"><i class="medium material-icons" style="color:#3097D1;">place</i>{{$U->location}}</h4>
                       <h4>  <i class="medium material-icons" style="color:#3097D1;">event</i> {{$U->event_start}} - {{$U->event_end}}</h4>
                        @foreach ($categoryForEvent as $catforevt)
                            
                       <i><b> <li style="float:left; display:inline-block;"><i class="medium material-icons" style="color:#3097D1;">local_offer</i>{{$catforevt->categoryname}}<a>,</a></li></b></i>

                        @endforeach

                    </div>

                  

                </div>
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
                                        <div class="form-group" style="width:100%">
                                            <textarea class="form-control" name="comment" placeholder="Write something" required></textarea>
                                        </div>
                                    </div>
                                    <!-- @foreach($event as $value) -->
                                    <input  name="item_id" value="{{$event->event_id}}" type="hidden">
                                    <!-- @endforeach -->

                                    
                                    <div class="row pull-right" style="padding: 0 10px 0 10px;">
                                        <div class="form-group" >
                                            <button id="btn_comment"class="btn waves-effect waves-light" style="background-color:#3097D1; color:#fafafa"type="submit" name="action">Submit
                                                <i class="small material-icons right">send</i>
                                              </button>                                      
                                              </div>
                                    </div>
                                </form>
    
                        </div>



                        
    
                </div>


                
                <div class="panel panel-default">
                        <div class="panel-heading">Comments <i class="medium material-icons" style="color:#3097D1;">forum</i></div>
                        {{--menampilkan hasil comment dengan menampilkan nama,foto profile,dan isi comment berdasarkan masing - masing account--}}
                        <div id="load_comment" class="panel-body comment-container" >
                            @foreach($comments as $comment)
                                <div class="well">
                                        <b style="float:right;"> {{$comment->comment_created_at}}</b>
                                        <hr class="simple" style="border-color:#ccc ;border-width:3px ;">

                                    <div class="row">
                                                    
                                        <div class="col-sm-5">  
                                            @if($U->user_id===$comment->user_commentid)
                                            <i><b style=" color:#000000">   <img src= "{{url('/' .$comment->image)}}" style="width:40px; height:40px; float:left; border-radius:50%; margin-right:25px;"> <a href="{{ url('/viewDetailUserProile/'.$comment->id) }}" style="color:#000;"> {{$comment->name }}  <i class="material-icons" style="color:#3097D1" title="Event Owner">assignment_ind</i>
                                            </a> </b></i>&nbsp;&nbsp;
                                            @else 
                                            <i><b style=" color:#000000">   <img src= "{{url('/' .$comment->image)}}" style="width:40px; height:40px; float:left; border-radius:50%; margin-right:25px;"> <a href="{{ url('/viewDetailUserProile/'.$comment->id) }}" style="color:#000;"> {{$comment->name }}</a> </b></i>&nbsp;&nbsp;

                                            @endif
                                            
                                            <br>
                                            @foreach ($positions as $pos)
                                                @if($pos->cmntid === $comment->cmntid)
                                                     <i style="font-size=5px">as {{$pos->position}} at {{$pos->company_name}}</i>
                                                

                                                @endif
                                            @endforeach

                                        </div>
                                        <div class="col-sm-7">
                                            <div style="text-align: justify;"><span> {{ $comment->comment }} </span></div>
                                        </div>
                                    </div>    

                                    <div style="margin-left:10px;">
                                        <br>
                                        <label>Reply</label>&nbsp;
                                        @if(Auth::user()->id === $comment->user_commentid)
                                                 <a style="cursor: pointer;"  class="delete-comment" href="{{url('deleteComment/'.$comment->cmntid)}}">Delete</a>
                                        @endif
                                        <div class="reply-form">
    
                                            <!-- Dynamic Reply form -->
    
                                        </div>
                                 
                                            
                                         <div class="well">
                                           
                                            <div class="reply-to-reply-form">
                                              @foreach($reply as $rep)

                                             @if($comment->cmntid == $rep->comment_id)
                                            
                                            <div id="reply">
                                                <hr class="simple" style="border-color:#ccc ;border-width:3px ;">
                                                <b style="float:right;">{{$rep->rep_created_at}}</b> 
                                                <div class="row">
                                                    
                                                    <div class="col-sm-5">  
                                                    @if($U->user_id===$rep->user_replyid)
                                                                        <i><b style=" color:#000000">   <img src= "{{url('/' .$rep->image)}}" style="width:40px; height:40px; float:left; border-radius:50%; margin-right:25px;"> <a href="{{ url('/viewDetailUserProile/'.$rep->id) }}" style="color:#000;"> {{$rep->name }}  <i class="material-icons" style="color:#3097D1" title="Event Owner">assignment_ind</i>
                                                                        </a> </b></i>&nbsp;&nbsp;
                                                                            @else 
                                                                        <i><b style=" color:#000000">   <img src= "{{url('/' .$rep->image)}}" style="width:40px; height:40px; float:left; border-radius:50%; margin-right:25px;"> <a href="{{ url('/viewDetailUserProile/'.$rep->id) }}" style="color:#000;"> {{$rep->name }}</a> </b></i>&nbsp;&nbsp;
                                                                    
                                                    @endif
                                                    <br>
                                                    @foreach ($replyPos as $repPos)
                                                        @if($repPos->replies_id === $rep->replies_id)
                                                             <i style="font-size=5px">as {{$repPos->position}} at {{$repPos->company_name}}</i>
                                                    
    
                                                        @endif
                                                    @endforeach
                                                    <br>

                                                    @if(Auth::user()->id === $rep->user_replyid)
        
                                                        <a style="cursor: pointer;"  class="delete-comment" href="{{url('deleteReplies/'.$rep->replies_id)}}">Delete</a>
                                                    @endif
                                                    </div>
                                                    <div class="col-sm-7">                 
                                                    <div style="text-align: justify;"><span > {{ $rep->reply }} </span></div>
                                                    </div> 
                                                    <br>
                                                    
                                                    <br>
                                                
                                                    </span>
                                                </div>
                                        </div>
                                        @endif
                                              @endforeach 
                                                     <form id="comment-form" method="post" action="{{ url('/RepComment') }}" >
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="comment_id" value=" {{$comment->cmntid}}" >
                                                            <input type="hidden" name="user_replyid" value="{{ Auth::user()->id }}" >
    
                                                            <div class="row" style="padding: 10px;">
                                                                <div class="form-group" style="width:100%">
                                                                    <textarea class="form-control" name="reply" placeholder="Write something" style="width:500;height:100%;" required></textarea>
                                                                </div>
                                                            </div>
    
                                                            <!-- @foreach($event as $value) -->
                                                         
                                                            <!-- @endforeach -->
                                                            <div class="row pull-right" style="padding: 0 10px 0 10px;">
                                                                <div class="form-group">
                                                                    <button class="btn waves-effect waves-light" style="background-color:#3097D1; color:#fafafa"type="submit" name="action">Submit
                                                                        <i class="small material-icons right">send</i>
                                                                      </button>  
                                                                    
                                                                    </div>
                                                            </div>
                                                     </form>
                                                   
                                                  </div>
                                                
\                                         </div>
                                         
                                
    
                                    </div>
                                </div>
                              
                            @endforeach


                            <p>
                                    {{$comments->appends(['search'=>request()->search])->links()}}
                                    {{--{{$product->appends([request()->query])->links()}}--}}
                                </p>
    
                        </div>


                     
                </div>
                
            </div>



            
            <div class="col-md-4">
                    <div class="panel panel-default">
                            <div class="panel-heading">Companies who join this event's     <i class="medium material-icons" style="color:#3097D1;">people</i></div>
                            {{--melakukan comment pada detail [] product dengan menggunakan masing - masing account dan kita bisa mendelete commetn dan melihat comment orang lain--}}
                            <div class="panel-body" style="min-height:5 0px;" >
                            
                  
                                <ul style="list-style-type:none;">      
                                @foreach($listMember as $member)  
                                    <li style="float:left; display:inline-block;"> <img title="{{$member->company_name}}" src= "{{ url($member->company_photo) }}" style="width:40px; height:40px; border-radius:50%"></li>
                                    @endforeach
                                
                                </ul>
                                
                          
                                    
        
                            </div>
        
                    </div>
                    @if(Auth::user()->userid_tocompany === $U->userid_tocompany && Auth::user()->id == $U->user_id)
                        <div class="panel panel-default">
                                    <div class="panel-heading">List Of Member<i class="material-icons" style="color:#3097D1;">person</i></div>
                                    {{--melakukan comment pada detail [] product dengan menggunakan masing - masing account dan kita bisa mendelete commetn dan melihat comment orang lain--}}
                                    <div class="panel-body" style="min-height:5 0px;" >
                                    
                                    @foreach($listMember as $member)  

                                        <ul style="list-style-type:none;">      
                                            <li style="float:left; display:inline-block;"> <img title="{{$member->company_name}}" src= "{{ url($member->company_photo) }}" style="width:40px; height:40px; border-radius:50%"></li>
                                            <li>
                                                &nbsp;
                                                <a class="btn btn-primary" title="Make Proposal"  href="{{url('toProposal',['event_id'=>$member->event_id,'company_id'=>$member->company_id])}}" ><i class="Large material-icons">contact_mail</i></a>
                                                {{-- <button class="btn btn-info" data-toCompany="{{$member->company_id}}" data-companyName="{{$member->company_name}}"  id="myBtn" >Chat</button> --}}

                                                {{-- <a class="btn btn-primary" title="Chat Live" data-mycompanyid="{{$member->company_id}}" data-mycompanyname="{{$member->company_name}}" data-mycompanyphoto="{{ url($member->company_photo) }}" data-mycompanyphoto="{{ url($member->company_photo) }}"  style="color:white" data-toggle="modal" data-target="#edit">Chat</a> --}}
                                            </li>
                                        </ul>
                                        

                                    @endforeach

                                        
                                
                                            

                                    </div>

                        </div>
                        @else



                        
                    @endif
                    <div class="panel panel-default">
                            <div class="panel-heading">Action   <i class="material-icons" style="color:#3097D1;">accessibility</i>
                            </div>
                            {{--melakukan comment pada detail [] product dengan menggunakan masing - masing account dan kita bisa mendelete commetn dan melihat comment orang lain--}}
                            <div class="panel-body">{{--pembagian role pada cart jadi admin bisa mendelte cart dan add to cart sedangkan member hanya bisa add saja tidak bisa melakukan delete--}}
                           
                                @if(Auth::user()->userid_tocompany === $U->userid_tocompany && Auth::user()->id === $U->user_id)
                                
                                <a class="btn waves-effect waves-light" style="background-color:#3097D1; color:#fafafa ;width:40%" data-toggle="modal" data-target="#modalDelete"  >Delete  <i class="medium material-icons">delete</i></a>
                                <a class="btn waves-effect waves-light" style="background-color:#3097D1; color:#fafafa;width:40%" title="Edit Event" href="{{url('/updateEvent/'.$U->event_id)}}">Update<i class="medium material-icons">update</i></a>
                                <br>
                                <br>   
                                <a class="btn waves-effect waves-light" style="background-color:#3097D1; color:#fafafa; width:55%" title="Invite Company" href="{{url('/chooseCompanies/'.$U->event_id)}}">Invite Company<i class="medium material-icons">person_add</i></a>
        
                                    <a class="btn waves-effect waves-light" style="background-color:#3097D1; color:#fafafa" title="Download Proposal" href="{{url('downloadPropo/'.$U->event_id)}}">Download<i class="medium material-icons">file_download</i></a>
                                   
                                 
                                    @elseif($check === $Acc &&  Auth::user()->userid_tocompany != $U->userid_tocompany)
                                    <b>Your Company Has Been Approved</b>
                                    <a class="btn waves-effect waves-light" style="background-color:#3097D1; color:#fafafa ;" title="Download Proposal" href="{{url('downloadPropo/'.$U->event_id)}}">Download<i class="small material-icons">file_download</i></a>
                                  
                              
        
                                 @elseif(($check === $Pen) &&  Auth::user()->userid_tocompany != $U->userid_tocompany)
                                 <i><b>Pending Request ....</b></i>
        
                                 @elseif(($check === $Inv) &&  Auth::user()->userid_tocompany != $U->userid_tocompany)
                                 <i><b>This event has sent you invite, you can check that at  </b></i>

                                     
                                @elseif($U->event_end <= $currtime)
                                

                                         <i><b>This event already closed at {{$U->event_end}}</b></i>

                                     
                                @else
                                
                                    {{-- <a class="btn btn-primary" href="{{url('RequestSp/'.$event->event_id)}}" >Make Request</a> --}}
                                    <a class="btn waves-effect waves-light"title="Join To Their Event" style="background-color:#3097D1; color:#fafafa ;" data-tomyevent="{{$event->event_id}}" data-toggle="modal" data-target="#request" >Make Request <i class="medium material-icons">call_made</i></a>
                
                                    <a class="btn waves-effect waves-light" style="background-color:#3097D1; color:#fafafa" title="Download Proposal" href="{{url('downloadPropo/'.$U->event_id)}}">Download<i class="medium material-icons">file_download</i></a>

                                @endif


        
                                    
        
                            </div>
        
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">Location  <i class="medium material-icons" style="color:#3097D1;">place</i></div>
                        <div class="panel-body">


                                    <iframe width="100%" height="250" id="gmap_canvas" src="https://maps.google.com/maps?q={{$U->location}}&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                                    </iframe>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">Reviews    <i class="medium material-icons" style="color:#3097D1;">thumbs_up_down</i></div>
                                <div class="panel-body">
                                    <ul style="list-style-type:none;">      
                                        @foreach($viewReview as $review)
                                        <li><img src= "{{url('/' .$review->image)}}" style="width:40px; height:40px; float:left; border-radius:50%; margin-right:25px;"></li>
                                        <li> <i><b> <a href="{{ url('/viewDetailUserProile/'.$review->id) }}" style="color:#000;"> {{$review->name }}</a> </b>&nbsp;&nbsp;</i>
                                            <a>{{$review->review_value}}</a>
     
                                        <li style=" font-size=:10px;" > <i>from  {{$review->company_name}} </i>  <a>{{$review->review_rating}}</a>&nbsp;&nbsp;</li>
                                       

                                      
                                        @endforeach


                                    <ul>
                                            {{$viewReview->appends(['search'=>request()->search])->links()}}

                                     
                                </div>
                            </div>
                        </div>

                    
                     </div>
        </div>
        
    </div>
    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content col-md-12" style="margin-top:200px">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Delete</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                            
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>
                                                            Are you sure want to delete ?
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">
                                                            Cancel
                                                        </button>
                                                        <a type="button" href="{{url('/deleteEvent/'.$U->event_id)}}" class="btn btn-primary">
                                                            Delete
                                                        </a>
                                                    </div>
            </div>
        </div>
    </div>

    


    



   
    @endguest
    {{-- @foreach($listMember as $member)  

        <div id="edit" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
              <div class="row" style="padding: 0px 15px 0px 15px">
                <h4 style="float: left;">Chat Live</h4>
                <span class="close" style="font-size: 28px">&times;</span>
              </div>
              <hr style="border: 1px solid #CCC;width: 100%;">
              <div class="modal-body">
              <li style="float:left; display:inline-block;"> <img title="{{$member->company_name}}" src= "{{ url($member->company_photo) }}" style="width:40px; height:40px; border-radius:50%"></li>

              
              {{$member->company_name}}
              </div>
              {{-- <form id="comment-form" method="post" action="{{ route('comments.store') }}" >
                    {{ csrf_field() }}
                    <input type="hidden" name="from_chat_userid" value="{{ Auth::user()->id }}" >

                    <div class="row" style="padding: 10px;">
                        <div class="form-group">
                            <textarea class="form-control" name="comment" placeholder="Write something"></textarea>
                        </div>
                    </div>
                    <!-- @foreach($event as $value) -->
                    <input  name="item_id" value="{{$event->event_id}}" type="hidden">
                    <!-- @endforeach -->
                    <div class="row" style="padding: 0 10px 0 10px;">
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-lg" style="width: 100%" name="submit">
                        </div>
                    </div>
                </form> 
                <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title">
                    </div>
    
                    <div class="form-group">
                        <label for="des">Description</label>
                        <textarea name="description" id="des" cols="20" rows="5" id='des' class="form-control"></textarea>
                    </div>
             </div>
        </div>
    </div>
      
    @endforeach --}}

    {{-- @foreach($listMember as $member) 

    <div class="modal fade" id="edit" tabindex="1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content" style="height:500px; width:700px; position:center">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Live Chat</h4>
                </div>
            <form  method="post" action="{{url('/editCompany')}}">
                        {{method_field('patch')}}
                        {{csrf_field()}}
                    <div class="modal-body">

                            @include('modalForm') --}}

                            {{-- <input type="hidden" name="category_id" id="cat_id" value="">


                          {{-- <li style="float:left; display:inline-block;"> <img title="{{$member->company_name}}" src= "{{ url($member->company_photo) }}" style="width:40px; height:40px; border-radius:50%"></li>

              
              {{$member->company_name}} --}}  
        
                {{-- </div>
            </div>                
                </form>
              </div>
            </div>
          </div>
@endforeach
         --}}


<div class="modal" id="request" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="padding-top:120px">
      <div class="modal-content" style="height:500px; width:700px;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Assign</h4>
        </div>
                  <form  method="post" action="{{url('/RequestSp')}}">
                          {{csrf_field()}}
                      <div class="modal-body">
                          <input type="hidden" name="event_id" id="rid" cols="20" rows="5" class="form-control">

                       <label for="req_userid" class="float-md-left mb-4">Assign to :</label>

                      <select id="req_userid" name="req_userid">

                  @if($getAssign === NULL)


                  

                  @else
                  
                      @foreach ($getAssign as $assign)
                           <option value="{{$assign->id}}"> <a img src= "{{ url($assign->image) }}" style="width:10px; height:10px; border-radius:50%"></a>{{$assign->name}} #{{$assign->user_code}}
                           </option>                                              
                             @endforeach
                          
                  @endif
                      </select>
                  
                  
                  

                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Save Changes</button>
                      </div>
                      </div>
                  
                  </form>
      </div>
    </div>
</div>



<script type="text/javascript" src="{{ asset('/js/app.js') }}"></script>


<script>
    function myFunction() {
  confirm("Do You Want to Delete Your Event ?");
    }
    $('#request').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var eventreq = button.data('tomyevent') 
        
        var modal = $(this)
        modal.find('.modal-body #rid').val(eventreq);
    
    })
    $('#edit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var data = button.data('mycompanyid') 
        var companyname = button.data('mycompanyname') 
        var companyphoto = button.data('mycompanyphoto') 
        var modal = $(this)
        modal.find('.modal-body #cid').val(data);
        modal.find('.modal-body #ccn').val(companyname);
        modal.find('.modal-body #ccp').attr("src",companyphoto);
        
        //       $.ajax({
        //           url: "te,
        //           type: 'GET',
        //           data: {id:4},
        //            success: function(response){ // What to do if we succeed
        //           if(data == "success")
        //         alert(response); 
        //       },
        // error: function(response){
        //     alert('Error'+response);
        //     }
        //         
            
        var modal = document.getElementById("myModal");
        
        var btn = document.getElementById("myBtn");
        var span = document.getElementsByClassName("close")[0];
        btn.onclick = function() {
        modal.style.display = "block";
        }
        span.onclick = function() {
        modal.style.display = "none";
        }
        window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
        }
        var close = document.getElementsByClassName("closebtn");
        var i;
        for (i = 0; i < close.length; i++) {
        close[i].onclick = function(){
            var div = this.parentElement;
            div.style.opacity = "0";
            setTimeout(function(){ div.style.display = "none"; }, 600);
        }
        }
    });
</script>
<script>
    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });
    // $(".btn-submit").click(function(e){
    //     e.preventDefault();
    //     var comment_id = $("input[name=comment_id]").val();
        
    //     var user_id = $("input[name=user_id]").val();
    //     var reply = $("input[name=reply ]").val();
        
    //     $.ajax({
    //        type:'POST',
    //        url:'/detail/{id}',
    //        data:{comment_id:comment_id, user_id:user_id, reply:reply},
    //        success:function(data){
    //           alert(data.success);
    //        }
    //     });
	// });
</script>


@endsection