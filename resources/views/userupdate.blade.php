@extends('welcome')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Personal Data</div>
{{--update user yang dilakukan admin dan hanya dapat menganti isi sama seperti update profile user masing-masing tetapi pada update user yang admin lakukan tidak bisa mengganti password user itu sendriri--}}
                    <div class="panel-body">
                        <form action="{{url('/updateUser')}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>


                            <div class="col-md-10 col-md-offset-1">
                                <img src="{{url($user->image)}}" style="width:140px; height:140px; float:left; border-radius:50%; margin-right:25px;">

                                <h2>{{ $user->name }}'s Profile</h2>
                            </div>


                            <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                                <label for="id" class="col-md-4 control-label">Id User</label>

                                <div class="col-md-6">
                                    <input id="id" type="" class="form-control" readonly="readonly" name="id" value="{{$user->id}}" required autofocus>

                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{$user->name}}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">email</label>

                                <div class="col-md-6">
                                    <input id="email" type="textarea" class="form-control" name="email"  value="{{$user->email}}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="gender" class="col-md-4 control-label">Position</label>

                                <div class="col-md-6">

                                    <select class="form-control" id="type" name="gender">
                                        <option>{{$user->user_id}}</option>
                                        
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="gender" class="col-md-4 control-label">Gender</label>

                                <div class="col-md-6">

                                    <select class="form-control" id="type" name="gender">
                                        <option>--Choose Your Gender--</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <a class="btn btn-primary" href="{{url('viewuser')}}" >
                                            Discard
                                        </a>
                                        {{--menyimpan hasil dari simpanan update user--}}
                                        <button type="submit" class="btn btn-primary">
                                            Save
                                        </button>
                                        {{--mendelete user tsb--}}
                                        <a class="btn btn-primary" href="{{url('doUserDelete/'.$user->id)}}" >
                                            Delete
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
