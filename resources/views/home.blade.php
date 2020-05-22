@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Info</div>
                {{--tampilan succes login--}}
                <div class="" style="padding: 20px 50px 20px 20px">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!<a class="" href="{{ url('/') }}"> Home</a>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
