@extends('welcome')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Master Data</div>

                    <div class="panel-body">
                        <form action="{{url('/addData')}}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
{{--Master Data Add New Data--}}

                            <div class="form-group{{ $errors->has('prefix') ? ' has-error' : '' }}">
                                <label for="prefix" class="col-md-4 control-label">Prefix</label>

                                <div class="col-md-6">
                                    <input id="prefix" type="text" class="form-control" name="prefix" value="{{ old('prefix') }}" required autofocus>

                                    @if ($errors->has('prefix'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('prefix') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('text1') ? ' has-error' : '' }}">
                                <label for="text1" class="col-md-4 control-label">Text 1</label>

                                <div class="col-md-6">
                                    <input id="text1" type="text" class="form-control" name="text1" value="{{ old('text1') }}" required autofocus>

                                    @if ($errors->has('text1'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('text1') }}</strong>
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
