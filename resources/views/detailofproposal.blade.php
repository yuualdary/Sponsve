@extends('welcome')

@section('content')
<br>
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
                                   {{$v->name}}
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
                                        Reject
                                    </button>
                                   
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
