@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Forgot Password</div>
                {{--UI untuk login--}}
            <form method="POST" action="{{url('/forgotPassword')}}">
                <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                <div class="col-md-6">

                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>
                        </div>
                </form>
               
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
