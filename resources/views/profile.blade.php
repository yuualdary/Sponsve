@extends('welcome')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Update Your Picture</div>

                    {{--menampilakn data user masing - masing sesuai hasil register yang mana bisa melakukan update pada profile --}}
                    @if(session()->has('failMsg'))
                    <div class="alert danger">
                        <span class="closebtn">&times;</span>  
                        <b><strong>Fail</strong> It' Look Like Your New Email Has Been Taken By Another User</b>
                    </div>
                    @endif


                    @if(session()->has('sccsMsg'))
                    <div class="alert success">
                        <span class="closebtn">&times;</span>  
                        <b><strong>Success</strong> Edit Your Data</b>
                    </div>
                    @endif
                    <div class="panel-body">
                        <form action="{{url('/updateProfile')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                            <div class="col-md-10 col-md-offset-1">
                                <img src="{{Auth::user()->image }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">

                                <h2>{{ $user->name }}'s Profile</h2>
                            </div>
                            <label>Update Profile </label>



                            <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                                <label for="id" class="col-md-4 control-label"></label>

                                <div class="col-md-6">
                                    <input id="id" type="hidden" class="form-control" readonly="readonly" name="id" value="{{$user->id}}" required autofocus>

                                </div>
                            </div>

                            <div class="form-group">
                                
                            <label for="user_code" class="col-md-4 control-label">Code</label>

                                <div class="col-md-6">
                                    <input id="user_code" type="text" class="form-control" readonly="readonly" name="user_code" value="{{$user->user_code}}" required autofocus>

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
                            <div class="form-group{{ $errors->has('position_id') ? ' has-error' : '' }}">
                            <label for="position_id" class="col-md-4 control-label">Position</label>

                                <div class="col-md-6">

                                    <select class="form-control" id="type" name="position_id">
                                       
                                       
                                        @foreach($position as $p)
                                        <option value="{{$p->id_position}}">{{$p->position}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                            </div>

                            {{-- <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}" >

                                <div class="col-md-6">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div> --}}


                            <input id="password" type="hidden" class="form-control" name="password" value="{{($user->password)}}" required>



                            <div class="form-group">
                                <label for="gender" class="col-md-4 control-label">Gender</label>

                                <div class="col-md-6">

                                    <select class="form-control" id="type" name="gender" required>
                                        <option>{{$user->gender}}</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>
                                <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                    <label for="image" class="col-md-4 control-label">Image</label>

                                    <div class="col-md-6">
                                        <input type="file" name="image">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Edit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>



 <script> 
   var close = document.getElementsByClassName("closebtn");
        var i;

        for (i = 0; i < close.length; i++) {
        close[i].onclick = function(){
            var div = this.parentElement;
            div.style.opacity = "0";
            setTimeout(function(){ div.style.display = "none"; }, 600);
        }
        }
 </script>  
@endsection
