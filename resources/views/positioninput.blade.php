@extends('welcome')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">event Position</div>

                    <div class="panel-body">
                        <form action="{{url('/eventPosition')}}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
{{--melalukan input category--}}

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">Position Name</label>

                                <div class="col-md-6">
                                    <input id="position" type="text" class="form-control" name="position" value="{{ old('position') }}" required autofocus>

                                    @if ($errors->has('position'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('position') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary" value="submit">
                                        Submit
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
