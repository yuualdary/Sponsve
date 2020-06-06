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
                   

                                        <img src= "{{url('/' .$gc->photo)}}" style="width:100%; " >
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
                            <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                                <label for="location" class="col-md-4 control-label">Location</label>

                                <div class="col-md-6">
                                    <textarea id="location" type="text" class="form-control" name="location" required>{{$gc->location}}</textarea>

                                    @if ($errors->has('location'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
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

                            <div class="form-group{{ $errors->has('event_start') ? ' has-error' : '' }}">
                                    <label for="event_start" class="col-md-4 control-label" style="width:100%;">Event Start</label>
    
                                    <div class="col-md-6">
                                        <input id="event_start" type="date" class="form-control" name="event_start" value="{{ $gc->event_start}}"required>
                                        <br>
                                        @if ($errors->has('event_start'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('event_start') }}</strong>
    
                                        </span>
                                        @endif
                                    </div>
                                </div>
    

         

                      
                          

                            <div class="form-group{{ $errors->has('event_end') ? ' has-error' : '' }}">
                                <label for="event_start" class="col-md-4 control-label" style="width:100%;">Event End</label>

                                <div class="col-md-6">
                                    <input id="event_end" type="date" class="form-control" name="event_end" value="{{ $gc->event_end}}"required>
                                    <br>
                                    @if ($errors->has('event_end'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('event_end') }}</strong>

                                    </span>
                                    @endif
                                </div>
                            </div>




                            @endforeach

                            

                            {{-- <div class="col-md-6">

                            
                            <i><b> <li style="float:left; display:inline-block;"><i class="medium material-icons" style="color:#3097D1;">local_offer</i>{{$catforevt->categoryname}}<a>,</a></li></b></i>
                            </div> --}}

                            {{-- @foreach ($list2 as $check)


                            @foreach ($cat as $allcheck)
                            <div class="col-md-6">
                                    @if($allcheck->category_id === $check->category_id)

                                    <label class="checkbox-inline">


                                <input  type="checkbox" id="catevent_category" name="catevent_tocategory[]" value="{{$check->category_id}}" checked>
                                @if($cat->permissions) @if(in_array($permission->id, $role->permissions->pluck('id')) checked @endif @endif 
                                       {{$check->categoryname}}</label>

                                @elseif($allcheck->category_id != $check->category_id)
                                    
                                <input  type="checkbox" id="catevent_category" name="catevent_tocategory[]" value="{{$allcheck->category_id}}" >
                                {{-- @if($cat->permissions) @if(in_array($permission->id, $role->permissions->pluck('id')) checked @endif @endif 
                                       {{$allcheck->categoryname}}</label>

                                
                                @endif
                       
                                       </div>
                                   </div>
                                   @endforeach

                             @endforeach --}}

                             <div class="form-group">


                             @foreach($cat as $allcheck)
                             <?php $a=0;?>

                                   @foreach ($list2 as $check)
                                       @if($allcheck->category_id === $check->category_id)
                                     
                                       <?php $a=1;?>
                                       
                                       @break

                                       @endif
                                   @endforeach
                                   @if($a==1)
                                   <div style="padding-bottom:20px; margin-left:230px; float:left; width:200px;">

                                   <label class="checkbox-inline">

                                    <input  type="checkbox" id="catevent_category" name="catevent_tocategory[]" value="{{$allcheck->category_id}}" checked>
                                           {{$allcheck->categoryname}}</label>
                                   </div> 
                                   @else
                                   <div style="padding-bottom:20px; margin-left:500px; float:left;width:200px;">

                                   <label class="checkbox-inline">

                                    <input  type="checkbox" id="catevent_category" name="catevent_tocategory[]" value="{{$allcheck->category_id}}" >
                                           {{$allcheck->categoryname}}</label>
                                   </div>
                                   @endif

                            @endforeach

                            </div>


                            
                            {{-- @foreach($category as $c)
                            <div class="form-group">


                                     <div class="col-md-6">
                                     <input  type="checkbox" id="catevent_category" name="catevent_tocategory[]" value="{{$c->category_id}}"{{ (is_array(old('catevent_tocategory')) and in_array('$c->category_id', old('catevent_tocategory'))) ? ' checked' : '' }}>
                                             <label for="catevent_category">{{$c->categoryname}}</label>
                            
                                            </div>
                                        </div>
            
                
                            @endforeach --}}




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
