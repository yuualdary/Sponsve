@extends('welcome')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Detail Picture</div>
{{--menampilkan detail dari product dan bisa melihat detail tersebut dan bisa melakukan comment terhadap product tersebut--}}
@if(session()->has('successAdd'))
                    <div class="alert success">
                        <span class="closebtn">&times;</span>  
                        <b><strong>Success</strong> Send Your Request</>
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
                        {{--<label class="col-md-4 control-label">{{$insert->title}}</label>--}}
                        {{--<label class="col-md-4 control-label">{{$insert->caption}}</label>--}}
                        {{--<label class="col-md-4 control-label">{{$insert->price}}</label>--}}
                        {{--<label class="col-md-4 control-label">{{$insert->category}}</label>--}}
                        <h3>{{$insert->title}}</h3>
                       
                        <img src="{{url('/'.$insert->photo)}}" style="width:570px; height:300px;">
                        <br>
                        <h4>{{$insert->caption}}</h4>
                        <h4>{{$insert->location}}</h4>
                        <h4>{{$insert->category}}</h4>
                    </div>

                    @guest
{{--pembagian role pada cart jadi admin bisa mendelte cart dan add to cart sedangkan member hanya bisa add saja tidak bisa melakukan delete--}}
                    @else
                        @if(Auth::user()->userid_tocompany === $U->userid_tocompany)
                            <a class="btn btn-primary" href="{{url('doDelete/'.$insert->insert_id)}}" >Delete</a>
                            <a class="btn btn-primary" href="{{url('/toProposal/'.$insert->insert_id)}}" >Make Proposal</a>

                        @else
                            <a class="btn btn-primary" href="{{url('RequestSp/'.$insert->insert_id)}}" >Make Request</a>
                            

                        @endif

                    @endguest

                </div>
            </div>
        </div>
    </div>
    <div class="container">
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
                                <!-- @foreach($insert as $value) -->
                                <input  name="item_id" value="{{$insert->insert_id}}" type="hidden">
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
                                    <a style="cursor: pointer;" id="{{ $comment->insert_id }}" name="{{ Auth::user()->name }}" token="{{ csrf_token() }}" class="reply">Reply</a>&nbsp;
                                    <a style="cursor: pointer;"  class="delete-comment" href="{{url('doDeleteComment/'.$comment->insert_id)}}">Delete</a>
                                    <div class="reply-form">

                                        <!-- Dynamic Reply form -->

                                    </div>
                             
                                        
                                     <div class="well">
                                       
                                                 <div class="reply-to-reply-form">
                                          @foreach($reply as $rep)
                                      @if($comment->cmntid == $rep->comment_id)
                                      <div id="reply">
                                        <i><b style=" color:#000000"> <img src= "{{url('/' .$rep->image)}}" style="width:40px; height:40px; float:left; border-radius:50%; margin-right:25px;"> {{  $rep->name }} </b></i>&nbsp;&nbsp;
                                        <span> {{ $rep->reply }} </span>
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

                                                        <!-- @foreach($insert as $value) -->
                                                     
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">



    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });



    $(".btn-submit").click(function(e){

        e.preventDefault();



        var comment_id = $("input[name=comment_id]").val();
        
        var user_id = $("input[name=user_id]").val();

        var reply = $("input[name=reply ]").val();

        



        $.ajax({

           type:'POST',

           url:'/detail/{id}',

           data:{comment_id:comment_id, user_id:user_id, reply:reply},

           success:function(data){

              alert(data.success);

           }

        });



	});

</script>

<script type="text/javascript" src="{{ asset('/js/main.js') }}"></script>
