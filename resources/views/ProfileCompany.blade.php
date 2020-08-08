@extends('welcome')

@section('content')
    <div class="container">
        <div class="row" style="margin-top:10px;">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create Your Company</div>
{{--menampilakn data user masing - masing sesuai hasil register yang mana bisa melakukan update pada profile --}}
                    <div class="panel-body">
                    <form action="{{url('/addCompany')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                           
                            <label>Input For Company Profile </label>


                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>

                            <br>

                      

                         
                            <input type="hidden" name="admin_userid" value="{{ Auth::user()->id }}" >

                            <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Company Name</label>

                                <div class="col-md-6">
                                    <input id="company_name" type="text" class="form-control" name="company_name" value="{{ old('company_name')}}" required autofocus>
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
                                    <input id="company_address" type="text" class="form-control" name="company_address" value="{{ old('company_address')}}" required>
                                    <br>

                                    @if ($errors->has('company_address'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('company_address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('status_company') ? ' has-error' : '' }}">
                                    <label for="status_compant" class="col-md-4 control-label">Status Company</label>
    
                                    <div class="col-md-6">

                                            <select class="form-control" id="type" name="status_company" required>
                                                    <option>-Choose Status-</option>
                                                    <option value="Company" {{old('status_company')=="Company" ? 'selected':''}}>Company</option>
                                                    <option value="Organization" {{old('status_company')=="Organization" ? 'selected':''}}>Organization</option>
                                                </select>
                                        <br>
    
                                    </div>
                                </div>
                            
                            <div class="form-group{{ $errors->has('company_phone') ? ' has-error' : '' }}">
                                <label for="company_phone" class="col-md-4 control-label">Company Phone</label>

                                <div class="col-md-6">
                                    <input id="company_phone" type="number" class="form-control" name="company_phone" value="{{ old('company_phone')}}"   required>
                                    <br>

                                    @if ($errors->has('company_phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('company_phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                           
                            <div class="form-group{{ $errors->has('website_address') ? ' has-error' : '' }}">
                             <label for="website_address" class="col-md-4 control-label">Company Email</label>

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
                                    <input id="social_media" type="text" class="form-control" name="social_media" value="{{ old('social_media')}}"  required>
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
                                   <input type="file" name ="company_photo" value="{{ old('company_photo')}}"  required>
                                   <br>
                                 
                                </div>
                           </div>
                            <br>

                            


            
                            <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary" data-target="#test">
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



