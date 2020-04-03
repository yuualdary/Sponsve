{{-- <img  id="ccp"  src="{{url("companyphoto")}}" style="width:40px; height:40px; border-radius:50%">  <textarea name="companyname" id="ccn"  cols="10" rows="1" class="form-control"></textarea> --}}

@foreach ($getChatUser as $c)
    

    <h1>{{$c->company_name}}</h1>
@endforeach

<h1>test</h1>


{{-- <div class="form-group">
      <label for="gg">Company Id</label>
      <input type="text" class="form-control" name="companyid" id="cid">
  </div>

  <div class="form-group">
      <label for="companyname">Company Name</label>
      <textarea name="  companyname" id="ccn" cols="20" rows="5" id='ccn' class="form-control"></textarea>
  </div> --}}


  <input name="chat_value" id="chat_value" value=""  width="30px" class="form-control"> <i class="material-icons">send</i>


  
  <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Changes</button>
</div>