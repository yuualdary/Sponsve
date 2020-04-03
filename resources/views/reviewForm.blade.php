<img  id="ccp"  src="{{url("companyphoto")}}" style="width:40px; height:40px; border-radius:50%">  <textarea name="companyname" id="ccn"  cols="10" rows="1" class="form-control"></textarea>


  <div class="form-group">
      <label for="companyname">Event Name</label>
      <textarea name="companyname" id="ccn" cols="20" rows="5" id='ccn' class="form-control"></textarea>
  </div>

  <div class="form-group">
<label for="companyname">Your Review</label>
  <textarea name="chat_value" id="chat_value" value=""  width="30px" class="form-control"></textarea> <i class="material-icons">send</i>

</div>
@foreach ($status as $st)
  {{$st->master_id}}
    
@endforeach

  
  <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Changes</button>
</div>