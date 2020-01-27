@extends('welcome')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Update Your Picture</div>
{{--menampilakn data user masing - masing sesuai hasil register yang mana bisa melakukan update pada profile --}}
                    <div class="panel-body">
                    <form action="{{url('/addCompany')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                           
                            <label>Input For Company Profile </label>

                            <br>

                      

                         
                            <input type="hidden" name="admin_userid" value="{{ Auth::user()->id }}" >

                            <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Company Name</label>

                                <div class="col-md-6">
                                    <input id="company_name" type="text" class="form-control" name="company_name"required autofocus>
                                    <br>
                                    @if ($errors->has('company_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('company_address') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Company address</label>

                                <div class="col-md-6">
                                    <input id="company_address" type="text" class="form-control" name="company_address" required>
                                    <br>

                                    @if ($errors->has('company_address'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('company_address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group{{ $errors->has('company_phone') ? ' has-error' : '' }}">
                                <label for="company_phone" class="col-md-4 control-label">Company Phone</label>

                                <div class="col-md-6">
                                    <input id="company_phone" type="number" class="form-control" name="company_phone"  required>
                                    <br>

                                    @if ($errors->has('company_phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('company_phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                           
                            <div class="form-group{{ $errors->has('website_address') ? ' has-error' : '' }}">
                             <label for="website_address" class="col-md-4 control-label">website address</label>

                                <div class="col-md-6">
                                    <input id="website_address" type="text" class="form-control" name="website_address"  required>
                                    <br>

                                    @if ($errors->has('website_address'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('website_address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>




                            <div class="form-group{{ $errors->has('social_media') ? ' has-error' : '' }}">
                                <label for="social_media" class="col-md-4 control-label">Social media</label>

                                <div class="col-md-6">
                                    <input id="social_media" type="text" class="form-control" name="social_media"  required>
                                    <br>

                                    @if ($errors->has('social_media'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('social_media') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('company_photo') ? ' has-error' : '' }}">
                                <label for="company_photo" class="col-md-4 control-label">Company Photo</label>
                               <div class="col-md-6">
                                   <input type="file" name ="company_photo" >
                                   <br>
                                 
                                </div>
                           </div>
                            <br>

                            


            
                            <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Save Data
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
