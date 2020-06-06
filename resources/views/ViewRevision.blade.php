@extends('welcome')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">event Your Proposal</div>
                    {{--melakukan event pada product--}}
                    <div class="panel-body">
                    <form action="{{url('/rejectProposal')}}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    
                    <div class="form-group">
                            {{-- <label for="proposal_id" class="col-md-4 control-label">Id Propo</label>--}}
                                @foreach($viewRevision as $getProposalD)

                                <div class="col-md-6">
                                    <input id="proposal_id" type="hidden" class="form-control" readonly="readonly" name="proposal_id" value="{{$getProposalD->proposal_id}}" required autofocus>
                                    @endforeach  

                                </div>
                            </div>


                        @foreach($viewRevision as $title)
                            <div class="form-group">
                                <label for="proposal_title" class="col-md-4 control-label">Subject</label>

                                <div class="col-md-6">
                                    <input id="proposal_title" type="text" class="form-control" name="proposal_title" value="{{ $title->proposal_title }}" required autofocus readonly>
                                    <br>
                                   
                                </div>
                            </div>
                            @endforeach

                            @foreach($status as $rev)
                            <input type="hidden" name="statusproposal_id" value="{{ $rev->Master_id }}" >
                            @endforeach
                            <input type="hidden" name="userid_proposal" value="{{ Auth::user()->id }}" >
                            @foreach($viewRevision as $value)
                            <div class="form-group">
                                <label for="ptid_proposal" class="col-md-4 control-label">To</label>
                               <div class="col-md-6">
                                   <input id="{{$value->id}}" type="hidden" class="form-control" name="ptid_proposal" value="{{$value->id}}" >
                                   <input type="text" class="form-control"  value="{{$value->name}}"readonly >
                                   <br>
                                 
                                </div>
                           </div>
                            @endforeach
                            <br>
                        @foreach($viewRevision as $desc)
                            <div class="form-group">
                                <label for="proposal_description" class="col-md-4 control-label">Description</label>

                                <div class="col-md-6">
                                
                                    <textarea id="proposal_description" type="text" class="form-control" name="proposal_description" value="{{$desc->proposal_description}}" style="width:100%;"required readonly>{{$desc->proposal_description}}</textarea>
                                    <br>
                                    @if ($errors->has('proposal_description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('proposal_description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
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
                                    <button type="submit" class="btn btn-primary" name="action" value="Revision">
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
@endsection
