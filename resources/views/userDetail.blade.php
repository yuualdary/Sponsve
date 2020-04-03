@extends('welcome')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
        
{{--menampilakn data user masing - masing sesuai hasil register yang mana bisa melakukan update pada profile --}}
                    <div class="panel-body">
                        @foreach ($userDetail as $user)
                        
                        <form>
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                            <div class="col-md-10 col-md-offset-1">
                                <i><b style=" color:#000000">   <img src= "{{url('/' .$user->image)}}" style="width:40px; height:40px; float:left; border-radius:50%; margin-right:25px;">{{  $user->name }} </b></i>&nbsp;&nbsp;

                                
                            </div>
                          



                          

                            

                            <div class="form-group">

                            <label for="position_id" class="col-md-4 control-label">Position</label>

                                <div class="col-md-6">

                                        {{$user->position}}
                                </div>
                            </div>

          


                            <div class="form-group">
                                <label for="gender" class="col-md-4 control-label">Gender</label>

                                <div class="col-md-6">
                                        {{$user->gender}}

                                </div>
                              
                            </div>
                           
                        </form>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
