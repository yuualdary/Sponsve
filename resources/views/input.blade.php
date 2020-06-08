@extends('welcome')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">event Your Picture</div>
{{--melakukan event pada product--}}
                    <div class="panel-body">
                        <form action="{{url('createEvent')}}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}


                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">Title</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>
                                    <br>

                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
\                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" >
                            <br>
                            <div class="form-group{{ $errors->has('caption') ? ' has-error' : '' }}">
                                <label for="caption" class="col-md-4 control-label">Caption</label>

                                <div class="col-md-6">
                                    <input id="caption" type="textarea" class="form-control" name="caption" value="{{ old('caption') }}" required>
                                    <br>

                                    @if ($errors->has('caption'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('caption') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <br>


                            <div class="form-group{{ $errors->has('event_start') ? ' has-error' : '' }}">
                                    <label for="event_start" class="col-md-4 control-label">Event Start</label>
    
                                    <div class="col-md-6">
                                        <input id="event_start" type="date" class="form-control" name="event_start"  value="{{ old('event_start') }}"  required>
                                        <br>

                                        @if ($errors->has('event_start'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('event_start') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <br>

                            <div class="form-group{{ $errors->has('event_end') ? ' has-error' : '' }}">
                                <label for="event_end" class="col-md-4 control-label">Event End</label>

                                <div class="col-md-6">
                                    <input id="event_end" type="date" class="form-control" name="event_end"  value="{{ old('event_end') }}" required>
                                    <br>

                                    @if ($errors->has('event_end'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('event_end') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <br>

                            <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                                <label for="photo" class="col-md-4 control-label">image</label>
                               <div class="col-md-6">
                                   <input id="photo" type="file" class="form-control" name="photo" required>
                                   <br>

                                   @if ($errors->has('photo'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                  </span>
                                    @endif
                                </div>
                           </div>



                            <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                                <label for="location" class="col-md-4 control-label">Location</label>

                                <div class="col-md-6">
                                    <input id="location" type="text" class="form-control" name="location"  value="{{ old('location') }}" required>
                                    <br>

                                    @if ($errors->has('location'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('propo') ? ' has-error' : '' }}">
                                <label for="propo" class="col-md-4 control-label">Proposal</label>
                               <div class="col-md-6">
                                   <input id="propo" type="file" class="form-control" name="propo" required>
                                   <br>

                                   @if ($errors->has('propo'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('propo') }}</strong>
                                  </span>
                                    @endif
                                </div>
                           </div>

                           
                            <div class="form-group">
                                <label for="category" class="col-md-4 control-label">category</label>



                                {{-- <div class="col-md-6">
                                    <select class="form-control" id="category" name="category">
                                
                                    @foreach($category as $c)
                                            <option value="{{$c->category_id}}">{{$c->categoryname}}</option>
                                            @endforeach
                                    </select>
                    
                                </div>
                            </div> --}}

                            @foreach($category as $c)
                            <div class="form-group">


                                     <div class="col-md-6">
                                     <input  type="checkbox" id="catevent_category" name="catevent_tocategory[]" value="{{$c->category_id}}"{{ (is_array(old('catevent_tocategory')) and in_array('$c->category_id', old('catevent_tocategory'))) ? ' checked' : '' }}>
                                             <label for="catevent_category">{{$c->categoryname}}</label>
                            
                                            </div>
                                        </div>
            
                
                            @endforeach
                        

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
