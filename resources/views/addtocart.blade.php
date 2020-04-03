@extends('welcome')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    {{--<div class="panel-heading">event Your Picture</div>--}}
{{--untuk memasukkan cart atau item yang sudah dipilih--}}
                    <div class="panel-body">
                        <form action="{{url('eventToCart')}}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                                <label for="id" class="col-md-4 control-label">Id Image</label>

                                <div class="col-md-6">
                                    <input id="id" type="" class="form-control" name="id" readonly="readonly"  value="{{$event->id}}" required autofocus>

                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">Title</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="title" readonly="readonly"  value="{{$event->title}}" required autofocus>

                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('caption') ? ' has-error' : '' }}">
                                <label for="caption" class="col-md-4 control-label">Caption</label>

                                <div class="col-md-6">
                                    <input id="caption" type="textarea" class="form-control" name="caption" readonly="readonly"  value="{{$event->caption}}" required autofocus>

                                    @if ($errors->has('caption'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('caption') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>



                            <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                                <label for="photo" class="col-md-4 control-label">image</label>
                                <div class="col-md-6">
                                    <input id="photo" type="text" class="form-control" name="photo" readonly="readonly"  value="{{$event->photo}}" required autofocus>

                                    @if ($errors->has('photo'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                  </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                <label for="price" class="col-md-4 control-label">Price</label>

                                <div class="col-md-6">
                                    <input id="price" type="text" class="form-control" name="price" readonly="readonly"  value="{{$event->price}}" required autofocus>

                                    @if ($errors->has('price'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                                <label for="category" class="col-md-4 control-label">category</label>


                                <div class="col-md-6">
                                    <select class="form-control" id="type" name="category">
                                        <option>{{$event->category}}</option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary" value="submit">
                                        Add To Cart
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
