@extends('welcome')

@section('content')
<br>

    
@if(Auth::user()->id === $checkAssign  && $checkStatus === $submit)

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Proposal From </div>
{{--melakukan event pada product--}}
                    <div class="panel-body">
                        <form action="{{url('/rejectProposal')}}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}

                         <div class="form-group">
                            {{-- <label for="proposal_id" class="col-md-4 control-label">Id Propo</label>--}}
                                @foreach($getProposalData as $getProposalD)

                                <div class="col-md-6">
                                    <input id="proposal_id" type="hidden" class="form-control" readonly="readonly" name="proposal_id" value="{{$getProposalD->proposal_id}}" required autofocus>
                                    @endforeach  

                                </div>
                            </div>
                            <div class="form-group">

                            <label for="proposal_title" class="col-md-4 control-label">Subject</label>

                            <div class="col-md-6">
                                @foreach($getProposalData as $getProposalD)
                                
                                    {{$getProposalD->proposal_title}}

                                    <br>
                               @endforeach  
                               </div>   
                            </div>
                           

                            <div class="form-group">
                                <label for="ptid_proposal" class="col-md-4 control-label">From</label>
                               <div class="col-md-6">
                               @foreach($getProposalData as $v)
                                   {{$v->company_name}}
                                   <br>
                                @endforeach

                                </div>
                             </div>
                         
                             <input type="hidden" name="statusproposal_id" value="statusproposal_id" >

                        @foreach($getProposalData as $desc) 

                            <div class="form-group">
                                <label for="proposal_description" class="col-md-4 control-label">Description</label>

                                <div class="col-md-6">
                                    <textarea id="proposal_description"  class="form-control" style="width:100%;" readonly>{{$desc->proposal_description}}  </textarea>
 
                                    
                                </div>
                            </div>
                            @endforeach

                            <div class="form-group">
                          
                                 <button type="submit" class="btn btn-primary" name="action" value="Download">       <i class="medium material-icons">file_download</i></a>
                                </button>
                            </div>
                        


                            <br>
                      
                            <br>
                                <div class="col-md-6 col-md-offset-4">
                                   
                                <button type="submit" class="btn btn-primary" name="action" value="Approve">
                                Approve</button>

                                    <button type="submit" class="btn btn-primary" name="action" value="Reject">
                                        Rejected
                                    </button>
                                   
                                </div>
                            </div>


                         

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @elseif(Auth::user()->id === $checkUser && $checkStatus === $reject)



    {{-------}}


    <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Proposal From </div>
    {{--melakukan event pada product--}}
                        <div class="panel-body">
                            <form action="{{url('/rejectProposal')}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
    
                            
                   

                    @foreach($getProposalData as $getProposalD)
        
                    <div class="col-md-6">
                        <input id="proposal_id" type="hidden" class="form-control" readonly="readonly" name="proposal_id" value="{{$getProposalD->proposal_id}}" required autofocus>
                    </div>
                        @endforeach  

                    @foreach ($getProposalData as $gC)
                        
                  
                    <div class="form-group">
                         <label for="company_id" class="col-md-4 control-label">To</label>

                             <div class="col-md-6">
                                 <input id="company_id" type="text" class="form-control" name="company_id"  value ="{{$gC->company_name}}" readonly>
                     
                            </div>
                    </div>
                    @endforeach

                    <br>
                    <br>
                    <br>
                  
                    

                        <div class="form-group{{ $errors->has('proposal_title') ? ' has-error' : '' }}">
                            <label for="proposal_title" class="col-md-4 control-label">Subject</label>

                            <div class="col-md-6">
                                <input id="proposal_title" type="text" class="form-control" name="proposal_title" value="{{ old('proposal_title') }}" required autofocus>
                                <br>
                                @if ($errors->has('proposal_title'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('proposal_title') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        {{-- <input type="hidden" name="userid_proposal" value="{{$company_id}}" > --}}


        
                        <br>

                        <div class="form-group{{ $errors->has('proposal_description') ? ' has-error' : '' }}">
                            <label for="proposal_description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                            
                                <textarea id="proposal_description"  class="form-control" name="proposal_description" value="{{ old('proposal_description') }}" style="width:100%;"required></textarea>
                                <br>
                                @if ($errors->has('proposal_description'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('proposal_description') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <br>
                        <div class="form-group{{ $errors->has('proposal_file') ? ' has-error' : '' }}">
                            <label for="proposal_file" class="col-md-4 control-label">File Proposal</label>
                           <div class="col-md-6">
                               <input type="file" name ="proposal_file" >
                               <br>
                             
                            </div>
                       </div>
                        <br>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" name="action" value="Submitted">
                                    Revision 
                                </button>
                            </div>
                        </div>
    
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @else
        
        
        <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-heading">Proposal From </div>
        {{--melakukan event pada product--}}
                            <div class="panel-body">
                                <form action="{{url('/rejectProposal')}}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
        
                                 <div class="form-group">
                                    {{-- <label for="proposal_id" class="col-md-4 control-label">Id Propo</label>--}}
                                        @foreach($getProposalData as $getProposalD)
        
                                        <div class="col-md-6">
                                            <input id="proposal_id" type="hidden" class="form-control" readonly="readonly" name="proposal_id" value="{{$getProposalD->proposal_id}}" required autofocus>
                                            @endforeach  
        
                                        </div>
                                    </div>
                                    <div class="form-group">
        
                                    <label for="proposal_title" class="col-md-4 control-label">Subject</label>
        
                                    <div class="col-md-6">
                                        @foreach($getProposalData as $getProposalD)
                                        
                                            {{$getProposalD->proposal_title}}
        
                                            <br>
                                       @endforeach  
                                       </div>   
                                    </div>
                                   
        
                                    <div class="form-group">
                                        <label for="ptid_proposal" class="col-md-4 control-label">From</label>
                                       <div class="col-md-6">
                                       @foreach($getProposalData as $v)
                                           {{$v->company_name}}
                                           <br>
                                        @endforeach
        
                                        </div>
                                     </div>
                                 
                                     <input type="hidden" name="statusproposal_id" value="statusproposal_id" >
        
                                @foreach($getProposalData as $desc) 
        
                                    <div class="form-group">
                                        <label for="proposal_description" class="col-md-4 control-label">Description</label>
        
                                        <div class="col-md-6">
                                            <textarea id="proposal_description"  class="form-control" style="width:100%;" readonly>{{$desc->proposal_description}}  </textarea>
         
                                            
                                        </div>
                                    </div>
                                    @endforeach
        
                                    <div class="form-group">
                                  
                                         <button type="submit" class="btn btn-primary" name="action" value="Download">       <i class="medium material-icons">file_download</i></a>
                                        </button>
                                    </div>
                                
        
        
                                    <br>
                              
                                    <br>
                                       
        
        
                                 
        
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endif

    

   
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Comments</div>
{{--menampilkan hasil comment dengan menampilkan nama,foto profile,dan isi comment berdasarkan masing - masing account--}}
                <div class="panel-body comment-container" >
                    @foreach($comments as $comment)
                    @if(Auth::user()->id === $comment->user_commentid)

                    <div class="well">

                            <i>{{$comment->comment_created_at}}</i>
                            <br>
                            <a>--------</a>

                        <i><b style=" color:#000000"> <img src= "{{url('/' .$comment->image)}}" style="width:40px; height:40px; float:right; border-radius:50%; margin-left:25px;"> <a style="width:40px; height:40px; float:right; border-radius:50%; margin-left:55px;"> {{$comment->name }}</a>     <a href="{{ url('/viewDetailUserProile/'.$comment->id) }}" style="color:#000;"></a> </b></i>&nbsp;&nbsp;
                            <span style="width:80%; float:right; border-radius:50%; margin-left:25px;"> {{ $comment->comment }} </span>

                            <div style="margin-left:10px;">
                                {{-- <a style="cursor: pointer;" id="{{ $comment->event_id }}" name="{{ Auth::user()->name }}" token="{{ csrf_token() }}" class="reply">Reply</a>&nbsp; --}}

                                         <a style="cursor: pointer;"  class="delete-comment" href="{{url('deleteComment/'.$comment->cmntid)}}">Delete</a>
                               


                       
                         
                                    
                                
                                 
                        

                            </div>
                        </div>

                            @else
                            <div class="well">
                                    <i style="width:150px; height:40px; float:right; border-radius:50%; margin-left:105px;">{{$comment->comment_created_at}}</i>
                                    <br>
                                    <a>--------</a>


                            <i><b style=" color:#000000">   <img src= "{{url('/' .$comment->image)}}" style="width:40px; height:40px; float:left; border-radius:50%; margin-right:25px;"> <a href="{{ url('/viewDetailUserProile/'.$comment->id) }}" style="color:#000;"> {{$comment->name }}</a> </b></i>&nbsp;&nbsp;
                            <span> {{ $comment->comment }} </span>
                            <br>

                        </div>
                        @endif

                    @endforeach


                </div>
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
                            <div class="form-group" style="width:100%">
                                <textarea style="width=100px" class="form-control" name="comment" placeholder="Write something" required></textarea>
                            </div>
                        </div>
                        {{-- <!-- @foreach($proposal as $value) -->
                        <input  name="proposal_commentid" value="{{$value}}" type="hidden">
                        <!-- @endforeach --> --}}
                        <input type="hidden" name="proposal_commentid" value="{{$checkId}}" >

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
@endsection
