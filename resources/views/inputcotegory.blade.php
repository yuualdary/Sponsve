@extends('welcome')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">event Category</div>

                    <div class="panel-body">
                        <form action="{{url('eventCategory')}}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                
                                                {{--melalukan input category--}}

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">Category Name</label>

                                <div class="col-md-6">
                                    <input id="categoryname" type="text" class="form-control" name="categoryname" value="{{ old('categoryname') }}" required autofocus>

                                    @if ($errors->has('categoryname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('categoryname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


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
