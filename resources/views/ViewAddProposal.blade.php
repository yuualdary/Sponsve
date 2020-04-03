@extends('welcome')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">event Your Proposal</div>
{{--melakukan event pada product--}}
                    <div class="panel-body">
                    <form action="{{url('/addProposal')}}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}

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

                            <input type="hidden" name="userid_proposal" value="{{$company_id}}" >


                            @foreach($status as $status)
                            <input type="hidden" name="statusproposal_id" value="{{ $status->Master_id }}" >
                        @endforeach
                            @foreach($getPTName as $value)
                            <div class="form-group{{ $errors->has('ptid_proposal') ? ' has-error' : '' }}">
                                <label for="ptid_proposal" class="col-md-4 control-label">To</label>
                               <div class="col-md-6">
                                   <input id="{{$value->company_id}}" type="hidden" class="form-control" name="ptid_proposal" value="{{$value->company_id}}" >
                                   <input type="hidden" name="eventid_proposal" value="{{$event_id}}" >

                                   <input type="text" class="form-control"  value="{{$value->company_name}}"readonly >
                                   <br>
                                 
                                </div>
                           </div>
                            @endforeach
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
                                    <button type="submit" class="btn btn-primary" value="submit">
                                        Post
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
