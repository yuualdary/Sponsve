@extends('welcome')
@section('content')
<div class="container">
 
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="width:700px; position:center; margin-right:500px;margin-top:20px;">
                <div class="panel-body">

                    
                        <form action="{{url('/editCompany')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}

                                <label>Detail For Company </label>
                                <br>
                        
                                @foreach($owner as $o)
                        
                                <label><i>Owner : {{$o->name}}</i></label>
                        
                                @endforeach
                        
                                <br>
                        
                        
                        

                        
                                <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                                @foreach($compDet as $compDet)
                                
                                
                                    <div class="col-md-6">
                                    <input id="company_id" type="hidden" class="form-control" readonly="readonly" name="company_id" value="{{$compDet->company_id}}" required autofocus>
                                    
                                    
                                    </div>
                            
                            
                            
                                    <div class="form-group{{ $errors->has('company_photo') ? ' has-error' : '' }}">
                                        <label for="company_photo" class="col-md-4 control-label"></label>
                                    </div>
                                    <div class="col-md-4">
                                    <img src="{{url('/'.$compDet->company_photo)}}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
                                    </div>
                                    <br>
                        
                                    <label for="company_name" class="col-md-4 control-label">Company Name</label>

                        
                                    <div class="col-md-6">
                                        <input id="company_name" type="text" readonly="readonly" class="form-control" name="company_name" value="{{$compDet->company_name}}" required autofocus>
                                        <br>
                                    
                                    </div>
                                
                                
                                    <div class="form-group{{ $errors->has('company_address') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-4 control-label">Company address</label>
                                    
                                        <div class="col-md-6">
                                            <input id="company_address" type="textarea" readonly="readonly" class="form-control" name="company_address" value="{{$compDet->company_address}}" required autofocus >
                                            <br>
                                        

                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('status_company') ? ' has-error' : '' }}">
                                            <label for="status_company" class="col-md-4 control-label">Status Company</label>
                                        
                                            <div class="col-md-6">
                                                <input id="status_company" type="text" readonly="readonly" class="form-control" name="status_compant" value="{{$compDet->status_company}}" required autofocus >
                                                <br>
                                            
    
                                            </div>
                                        </div>

                                    <div class="form-group{{ $errors->has('company_phone') ? ' has-error' : '' }}">
                                        <label for="company_phone" class="col-md-4 control-label">Company Phone</label>
                                    
                                        <div class="col-md-6">
                                            <input id="company_phone" type="number"  readonly="readonly" class="form-control" name="company_phone"  value="{{$compDet->company_phone}}"required autofocus>
                                            <br>
                                        
                                        </div>
                                    </div>
                            
                                    <div class="form-group{{ $errors->has('website_address') ? ' has-error' : '' }}">
                                        <label for="website_address" class="col-md-4 control-label">website address</label>
                                    
                                        <div class="col-md-6">
                                            <input id="website_address" type="text" readonly="readonly" class="form-control" name="website_address"  value="{{$compDet->website_address}}"required autofocus>
                                            <br>
                                        
                                        </div>
                                    </div>
                            
                            
                            
                            
                                    <div class="form-group{{ $errors->has('social_media') ? ' has-error' : '' }}">
                                        <label for="social_media" class="col-md-4 control-label">Social media</label>
                                    
                                        <div class="col-md-6">
                                            <input id="social_media" type="text" readonly="readonly" class="form-control" name="social_media"  value="{{$compDet->social_media}}"required autofocus>
                                            <br>
                                        
                                        </div>
                                    </div>
                                @endforeach 
                                </div>

                        </form>
                </div>
            </div>
        </div>
    </div>     
</div>   
@endsection
