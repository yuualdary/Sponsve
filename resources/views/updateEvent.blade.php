@extends('welcome')

@section('content')
<br>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Update Your Event</div>
                   
                    <div class="panel-body">

                   
                   
                        <form action="{{url('/editEvent')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{--melakukan update terhadap prpduct yang sudah di event--}}

                            @foreach($getdataCurrent as $gc)
                            <div class="form-group">
                               

                                <div class="col-md-6">
                                    <input id="event_id" type="hidden" class="form-control" readonly="readonly" name="event_id" value="{{$gc->event_id}}" required autofocus>
                                    <input id="user_id" type="hidden" class="form-control" readonly="readonly" name="user_id" value="{{$gc->user_id}}" required autofocus>

                                </div>
                            </div>

                            
                            <div class="form-group">
                   

                                        <img src= "{{url('/' .$gc->photo)}}" style="width:700px; height:300px; float:center;">
                                    <br>
                                    <br>
                                
                            </div>
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <br>
                                <label for="title" class="col-md-4 control-label">Title</label>

                                <div class="col-md-6">
                                    <input id="title" type="textarea" class="form-control" name="title" value="{{ $gc->title  }}" required autofocus>
                                    <br>

                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('caption') ? ' has-error' : '' }}">
                                <label for="caption" class="col-md-4 control-label" style="width:100%;">Caption</label>

                                <div class="col-md-6">
                                    <textarea id="caption" type="text" class="form-control" name="caption"required>{{ $gc->caption}}</textarea>
                                    <br>
                                    @if ($errors->has('caption'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('caption') }}</strong>

                                    </span>
                                    @endif
                                </div>
                            </div>

                           
                            <div class="form-group">
                                <label for="photo" class="col-md-4 control-label">image</label>
                                <div class="col-md-6">
                                    <input id="photo" type="file" class="form-control" name="photo" >
                                    <br>
                                   
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="propo" class="col-md-4 control-label">Proposal</label>
                                <div class="col-md-6">
                                    <input id="propo" type="file" class="form-control" name="propo" >
                                    <br>
                                   
                                </div>
                            </div>


         

                      
                            <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                                <label for="category" class="col-md-4 control-label">category</label>



                                <div class="col-md-6">
                                    <select class="form-control" id="type" name="category">
                                    
                                     
                                        
                                            <option value="{{$gc->category_id}}">{{$gc->categoryname}}</option>
                                          
                                        <br>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('event_date') ? ' has-error' : '' }}">
                                <label for="caption" class="col-md-4 control-label" style="width:100%;">Caption</label>

                                <div class="col-md-6">
                                    <input id="event_date" type="date" class="form-control" name="event_date" value="{{ $gc->event_date}}"required>
                                    <br>
                                    @if ($errors->has('event_date'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('event_date') }}</strong>

                                    </span>
                                    @endif
                                </div>
                            </div>

                            @endforeach

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary" value="submit">
                                        Edit
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
