@extends('welcome')

@section('content')
<iframe cols="25%,50%,25%">
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
                                                                <input type="submit" class="btn btn-primary btn-lg" style="width: 50px; height: 10px;" name="submit">
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
</iframe>
 @endsection