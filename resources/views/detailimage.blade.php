@extends('welcome')

@section('content')
<br>

@guest
<br>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
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
                    <i style="font-size=5px">as {{$U->position}}</i>
                    @endif
                @endforeach
                    {{--<label class="col-md-4 control-label">{{$event->title}}</label>--}}
                    {{--<label class="col-md-4 control-label">{{$event->caption}}</label>--}}
                    {{--<label class="col-md-4 control-label">{{$event->price}}</label>--}}
                    {{--<label class="col-md-4 control-label">{{$event->category}}</label>--}}
                    <h3>{{$U->title}}</h3>
                   
                    <img src="{{url('/'.$U->photo)}}" style="width:570px; height:300px;">
                    <br>
                        
                    <h4>{{$U->caption}}</h4>
                    <h4>{{$U->location}}</h4>
                    <h4>{{$U->categoryname}}</h4>
                    <h4>{{$U->event_date}}</h4>
                </div>

              

            </div>
        </div>
    </div>
</div>
<div class="container">

<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Companies who join this event's</div>
                {{--melakukan comment pada detail [] product dengan menggunakan masing - masing account dan kita bisa mendelete commetn dan melihat comment orang lain--}}
                <div class="panel-body" style="min-height:5 0px;" >
                
      
                    <ul style="list-style-type:none;">      
                    @foreach($listMember as $member)  
                        <li style="float:left; display:inline-block;"> <img title="{{$member->company_name}}" src= "{{ url($member->company_photo) }}" style="width:40px; height:40px; border-radius:50%"></li>
                        @endforeach
                    
                    </ul>
                    
              
                        

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
                                <a style="cursor: pointer;"class="reply"></a>&nbsp;
                                <a style="cursor: pointer;"  class="delete-comment" href="{{url('doDeleteComment/'.$comment->event_id)}}"></a>
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
@else
{{-- ////////////////////////////////////////////////////////////////// --}}
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                   
                    <div class="panel-heading">Detail Event</div>
                   
            {{--menampilkan detail dari product dan bisa melihat detail tersebut dan bisa melakukan comment terhadap product tersebut--}}
            @if(session()->has('successAdd'))
                    <div class="alert success">
                        <span class="closebtn">&times;</span>  
                        <b><strong>Success</strong> Send Your Request</b>
                    </div>
                    @endif
                    
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
              

                    @if(session()->has('successEdit'))
                    <div class="alert success">
                        <span class="closebtn">&times;</span>  
                        <b><strong>Success</strong> Edit Your Data</>
                    </div>
                    @endif
                    
                    <div class="panel-body">
                    
                    @foreach($getUsers as $U)
                        @if($U->id === $U->user_id)

                    <i><b style=" color:#000000"> <img src= "{{url('/' .$U->image)}}" style="width:50px; height:50px; float:left; border-radius:50%; margin-right:25px;"> {{  $U->name }} </b></i>&nbsp;&nbsp;
                    <br>
                        <i style="font-size=5px">as {{$U->position}}</i>
                        @endif
                    @endforeach
                        {{--<label class="col-md-4 control-label">{{$event->title}}</label>--}}
                        {{--<label class="col-md-4 control-label">{{$event->caption}}</label>--}}
                        {{--<label class="col-md-4 control-label">{{$event->price}}</label>--}}
                        {{--<label class="col-md-4 control-label">{{$event->category}}</label>--}}
                        <h3>{{$U->title}}</h3>
                       
                        <img src="{{url('/'.$U->photo)}}" style="width:570px; height:300px;">
                        <br>
                    
                    <h4>Rating {{$setRating}}    <i class="material-icons">star</i>
                    </h4>
                            
                        <h4>{{$U->caption}}</h4>
                        <h4>{{$U->location}}</h4>
                        <h4>{{$U->categoryname}}</h4>
                        <h4>{{$U->event_date}}</h4>
                    </div>

                  

                </div>
            </div>
        </div>
    </div>
    <div class="container">

    <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Companies who join this event's</div>
{{--melakukan comment pada detail [] product dengan menggunakan masing - masing account dan kita bisa mendelete commetn dan melihat comment orang lain--}}
                    <div class="panel-body" style="min-height:5 0px;" >
                    
          
                        <ul style="list-style-type:none;">      
                        @foreach($listMember as $member)  
                            <li style="float:left; display:inline-block;"> <img title="{{$member->company_name}}" src= "{{ url($member->company_photo) }}" style="width:40px; height:40px; border-radius:50%"></li>
                            @endforeach
                        
                        </ul>
                        
                  
                            

                    </div>

                </div>
            </div>
        </div>
        @if(Auth::user()->userid_tocompany === $U->userid_tocompany)

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">List Of Member</div>
{{--melakukan comment pada detail [] product dengan menggunakan masing - masing account dan kita bisa mendelete commetn dan melihat comment orang lain--}}
                    <div class="panel-body" style="min-height:5 0px;" >
                    
                    @foreach($listMember as $member)  

                        <ul style="list-style-type:none;">      
                            <li style="float:left; display:inline-block;"> <img title="{{$member->company_name}}" src= "{{ url($member->company_photo) }}" style="width:40px; height:40px; border-radius:50%"></li>
                            <li>
                                &nbsp;
                                <a class="btn btn-primary" title="Make Proposal"  href="{{url('toProposal',['event_id'=>$member->event_id,'company_id'=>$member->company_id])}}" ><i class="Large material-icons">contact_mail</i></a>
                                {{-- <button class="btn btn-info" data-toCompany="{{$member->company_id}}" data-companyName="{{$member->company_name}}"  id="myBtn" >Chat</button> --}}

                                <a class="btn btn-primary" title="Chat Live" data-mycompanyid="{{$member->company_id}}" data-mycompanyname="{{$member->company_name}}" data-mycompanyphoto="{{ url($member->company_photo) }}" da   ta-mycompanyphoto="{{ url($member->company_photo) }}"  style="color:white" data-toggle="modal" data-target="#edit">Chat</a>
                            </li>
                        </ul>
                        

                    @endforeach

                        
                  
                            

                    </div>

                </div>
            </div>
        </div>
        @endif

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Action</div>
{{--melakukan comment pada detail [] product dengan menggunakan masing - masing account dan kita bisa mendelete commetn dan melihat comment orang lain--}}
                    <div class="panel-body">{{--pembagian role pada cart jadi admin bisa mendelte cart dan add to cart sedangkan member hanya bisa add saja tidak bisa melakukan delete--}}
                   
                        @if(Auth::user()->userid_tocompany === $U->userid_tocompany)
                        
                            <a class="btn btn-primary" href="{{url('doDelete/'.$event->event_id)}}" >Delete</a>
                            <a class="btn btn-primary" title="Edit Data" href="{{url('/updateEvent/'.$U->event_id)}}">Update</a>

                            <a class="btn btn-primary" title="Download Proposal" href="{{url('downloadPropo/'.$U->event_id)}}"><i class="medium material-icons">file_download</i></a>
                           
                         </a>
                         @elseif($check === $Acc &&  Auth::user()->userid_tocompany != $U->userid_tocompany)
                         <i><b>Your Company Has Been Approved</b></i><a class="btn btn-primary" title="Make Proposal" href="{{url('/toProposal/'.$U->event_id)}}" ><i class="Large material-icons">contact_mail</i>l</a>

                          
                          
                      

                         @elseif($check === $Pen &&  Auth::user()->userid_tocompany != $U->userid_tocompany)
                         <i><b>Pending Request ....</b></i>

                      

                      
                        @else

                        
                            {{-- <a class="btn btn-primary" href="{{url('RequestSp/'.$event->event_id)}}" >Make Request</a> --}}
                            <a class="btn btn-primary" title="Assign"  data-tomyevent="{{$event->event_id}}" data-toggle="modal" data-target="#request"" >Make Request</a>


                        @endif

                            

                    </div>

                </div>
            </div>
        </div>
       
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
                                <!-- @foreach($event as $value) -->
                                <input  name="item_id" value="{{$event->event_id}}" type="hidden">
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

                            <i><b style=" color:#000000">   <img src= "{{url('/' .$comment->image)}}" style="width:40px; height:40px; float:left; border-radius:50%; margin-right:25px;"> <a href="{{ url('/viewDetailUserProile/'.$comment->id) }}" style="color:#000;"> {{$comment->name }}</a> </b></i>&nbsp;&nbsp;
                       
                                <span> {{ $comment->comment }} </span>
                                <div style="margin-left:10px;">
                                    <a style="cursor: pointer;" id="{{ $comment->event_id }}" name="{{ Auth::user()->name }}" token="{{ csrf_token() }}" class="reply">Reply</a>&nbsp;
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
                                        <i><b style=" color:#000000"> <img src= "{{url('/' .$rep->image)}}" style="width:40px; height:40px; float:left; border-radius:50%; margin-right:25px;"> <a href="{{ url('/viewDetailUserProile/'.$rep->id) }}" style="color:#000;"> {{$rep->name }} </b></i></a>&nbsp;&nbsp;
                                        <span> {{ $rep->reply }} 
                                            <br>
                                            @if(Auth::user()->id === $rep->user_replyid)

                                                 <a style="cursor: pointer;"  class="delete-comment" href="{{url('deleteReplies/'.$rep->replies_id)}}">Delete</a>
                                            @endif
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
                                                        <input type="hidden" name="user_replyid" value="{{ Auth::user()->id }}" >

                                                        <div class="row" style="padding: 10px;">
                                                            <div class="form-group">
                                                                <textarea class="form-control" name="reply" placeholder="Write something" style="width:500;height:100%;"></textarea>
                                                            </div>
                                                        </div>

                                                        <!-- @foreach($event as $value) -->
                                                     
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

    @foreach($listMember as $member) 

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

                            @include('modalForm')

                            {{-- <input type="hidden" name="category_id" id="cat_id" value="">


                          {{-- <li style="float:left; display:inline-block;"> <img title="{{$member->company_name}}" src= "{{ url($member->company_photo) }}" style="width:40px; height:40px; border-radius:50%"></li>

              
              {{$member->company_name}} --}}  
        
                </div>
            </div>                
                </form>
              </div>
            </div>
          </div>
@endforeach
        
                <div class="modal fade" id="request" tabindex="1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content" style="height:500px; width:700px; position:center">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title" id="myModalLabel">Assign</h4>
                            </div>
                        <form  method="post" action="{{url('/RequestSp')}}">
                                    {{csrf_field()}}
                                <div class="modal-body">
                                    <input type="hidden" name="event_id" id="req" cols="20" rows="5" class="form-control">

                                 <label for="position_id" class="float-md-left mb-4">Assign to :</label>

                                <select id="req_userid" name="req_userid">  
                                @foreach ($getAssign as $assign)
                                     <option value="{{$assign->id}}"> <img src= "{{ url($assign->image) }}" style="width:10px; height:10px; border-radius:50%">{{$assign->name}}
                                     </option>                                              
                                       @endforeach

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
                    










    <script>


$('#request').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) 
      var request = button.data('tomyevent') 
   


      var modal = $(this)
      modal.find('.modal-body #req').val(request);
 

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
//         });
})



        
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
</script>
@endsection
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
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

<script type="text/javascript" src="{{ asset('/js/main.js') }}"></script>

