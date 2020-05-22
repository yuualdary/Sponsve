@extends('welcome')
@section('content')

<br>
<br >

<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">  
                    
                
                    <div class="container">
                            <div class="tab">
                                    <button class="tablinks" onclick="openCity(event, 'CurrentEvt')" id="defaultOpen">Invited Event</button>
                                    <button class="tablinks" onclick="openCity(event, 'DoneEvt')">Done Event</button>
                                    <button class="tablinks" onclick="openCity(event, 'ReviewEvt')">Your Review</button>

                            </div>
                            <div class="tabcontent"  id="CurrentEvt">

                                <div class="row mb-5">
                                    <div class="col-md-9 order-2">

                                        <div class="row">
                                            <div class="col-md-12 mb-5">
                                                <div class="float-md-left mb-4"><h2 class="text-black h5">Current Event</h2></div>
                                            </div>
                                        </div>
                                        <div class="row mb-5">
                                    
                                            <table>
                                                <tr>
                                                    <td>
                                                        Event Name
                                                        <br>
                                                    </td>
                                                    <td>
                                                        Date
                                                        <br>
                                                    </td>
                                                
                                                    <td>
                                                        Detail Event
                                                    </td>

                                                
                                                
                                                
                                                </tr>
                                            @foreach($trackRequest as $Req )

                                                    <tr>
                                                        <td>
                                                        <b> {{$Req->title}}</b>
                                                        </td>
                                                        <td>
                                                            {{$Req->name}}
                                                        </td>
                                                        <td>    
                                                        <i>{{$Req->location}}</i>
                                                        </td>
                                                            <td>
                                                        <a href="{{url('/toDetailPropo/'.$Req->proposal_id)}}"> <i class="medium material-icons">create</i></a>
                                                            
                                                        </td>

                                    
                                                    </tr>
                                                
                                            @endforeach
                                                            
                                
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        
                            <div id="DoneEvt" class="tabcontent">
                                <div class="row mb-5">
                                    <div class="col-md-9 order-2">
                                        

                                        <div class="row">
                                            

                                            <div class="col-md-12 mb-5">
                                                <div class="float-md-left mb-4"><h2 class="text-black h5">Running Event</h2></div>
                                            </div>
                                        </div>
                                        <div class="row mb-5">
                                            <table>
                                                <tr>
                                                    <td>
                                                        Owner
                                                        <br>
                                                    </td>
                                                    <td>
                                                        Event Date
                                                        <br>
                                                    </td>
                                                    <td>
                                                    Event
                                                    <br>
                                                    </td>
                                                
                                                    <td>
                                                        Location
                                                        <br>
                                                    </td>
                                                </tr>
                                                @foreach($doneRequest as $done )

                                                
                                                {{-- @if($review === 0 ) --}}

                                        
                                                    <tr>
                                                        <td>
                                                        <b> {{$done->company_name}}</b>
                                                        </td>
                                                        <td>
                                                            {{$done->event_date}}
                                                        </td>
                                                        <td>    
                                                        <i>{{$done->title}}</i>
                                                        </td>

                                                        <td>
                                                            {{$done->location}}
                                                        </td>
                                                    
                                                        <td>
                                                            {{-- <a  href="{{url('/toDetailPropo/'.$done->proposal_id)}}">View</a>
                                                            <a  href="{{url('/toDetailPropo2/'.$done->proposal_id)}}">Revision</a> --}}
                                                        <a class="btn btn-primary" title="Chat Live" data-mycompanyid="{{$done->event_id}}" data-mycompanyname="{{$done->title}}"  data-mycompanyphoto="{{ url($done->photo) }}"  data-mymappingid="{{$done->Mapping_Req_Id}}" style="color:white"  data-toggle="modal" data-target="#edit">Review</a>


                                                        </td>
                                                    </tr>
                                            
                                                @endforeach

                                                

                                            </table>


                                            
                                        </div>
                                
                                    </div>
                                        <br>
                                        <br>
                                    
                                </div>
                            </div>

                            <div id="ReviewEvt" class="tabcontent">
                                    <div class="row mb-5">
                                        <div class="col-md-9 order-2">
                                            
                    
                                            <div class="row">
                                                
                    
                                                <div class="col-md-12 mb-5">
                                                    <div class="float-md-left mb-4"><h2 class="text-black h5">Your Review </h2></div>
                                                </div>
                                            </div>
                                            <div class="row mb-5">
                                                <table>
                                                    <tr>
                                                        <td>
                                                            Owner
                                                            <br>
                                                        </td>
                                                        <td>
                                                            Event Date
                                                            <br>
                                                        </td>
                                                        <td>
                                                        Event
                                                        <br>
                                                        </td>
                                                    
                                                        <td>
                                                            Your Rating
                                                            <br>
                                                        </td>
                                                    </tr>
                                                
                                                    @foreach ($isReviewed as $isrev)
                                                        
                                                    <tr>
                                                        <td> 
                                                        <b> {{$isrev->name}}</b>
                                                        </td> 
                                                        <td>
                                                            {{$isrev->event_date}}
                                                        </td>
                                                        <td>    
                                                        <i>{{$isrev->title}}</i>
                                                        </td>
                    
                                                        <td>
                                                            <i>{{$isrev->review_value}}</i>
                                                        </td>
                                                        <td>
                                                        
                                                        <i>{{$isrev->text1}}</i>
                    
                                                        </td>
                    
                                                        <td>
                                                        
                                                            <i>{{$isrev->review_rating}}</i>
                            
                                                            </td>
                                                    </tr>
                                                
                                                    @endforeach
                    
                    
                                                    
                    
                                                </table>
                    
                    
                                                
                                            </div>
                                    
                                            </div>
                                            <br>
                                            <br>
                                        
                                    </div>
                                    
                            </div>
                    </div>
                </div>        
                            
            </div>
        </div>
</div>

<div class="modal" id="edit" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document" style="padding-top:120px">
          <div class="modal-content" style="height:500px; width:700px;">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Review</h4>
            </div>
            <form  method="post" action="{{url('/getReview')}}">
                {{ csrf_field() }}

                <div class="modal-body" style="min-height:320px">

                    <img  id="ccp"  src="{{url("companyphoto")}}" style="width:40px; height:40px; border-radius:50%">  
                    <input disabled="disabled" name="companyname" id="ccn"  cols="10" rows="1" class="">
                    
                    <input type="hidden" name="review_event" id="cid" cols="20" rows="5" class="form-control">
                    <input type="hidden" name="mappingid" id="cmi" cols="20" rows="5" class="form-control">


                   
                  
                    <div class="form-group">
                        <label for="review_value">Your Review</label>
                        <textarea name="review_value" id="review_value" value="review_value"  width="30px" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="review_rating">Rating Scale</label>
                        <input name="review_rating" id="review_rating" value=" "  width="30px" class="form-control"></textarea>
                        
                    </div>
                
                    {{-- {{$st->Master_id}} --}}

                    <div class="form-group">

                        <label for="review" class="float-md-left mb-4">Satifying :</label>

                        <select id="review">  
                            @foreach ($status as $st)

                            
                                 <option value="{{$st->Master_id}}">{{$st->text1}}</option>
                            @endforeach

                        </select>

                    </div>

                    <div class="form-group">

                        <label for="review" class="float-md-left mb-4">Satifying :</label>


                        <ul style="list-style-type:none;">  

                            <li style="float:left; display:inline-block;">
                           

                                <label class="block"><input type="radio" id="review_status" name="review_status" value="Puas">Puas</label>
                                <label class="block"><input type="radio"  id="review_status" name="review_status" value="Cukup">Cukup</label>
                                <label class="block"><input type="radio" id="review_status"  name="review_status" value="Kurang">Kurang</label>
                            </li>
                           
                        </ul>                   
                      
                    </div>

                        {{-- <input type="hidden" name="category_id" id="cat_id" value="">


                      {{-- <li style="float:left; display:inline-block;"> <img title="{{$member->company_name}}" src= "{{ url($member->company_photo) }}" style="width:40px; height:40px; border-radius:50%"></li>

          
                        {{$member->company_name}} --}}  
                </div>
                
                <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>                
            </form>
          </div>      
        </div>    
</div>

<script type="text/javascript" src="{{ asset('/js/app.js') }}"></script>




<script >
    $('#edit').on('show.bs.modal', function (event) {
                 var button = $(event.relatedTarget) 
                 var data = button.data('mycompanyid') 
                 var companyname = button.data('mycompanyname') 

                 var companyphoto = button.data('mycompanyphoto') 
                 var mappingid= button.data('mymappingid')



                 var modal = $(this)
                 modal.find('.modal-body #cid').val(data);
                 modal.find('.modal-body #ccn').val(companyname);
                 modal.find('.modal-body #ccp').attr("src",companyphoto);
                 modal.find('.modal-body #cmi').val(mappingid);


        
                var acc = document.getElementsByClassName("accordion");
                var i;

                for (i = 0; i < acc.length; i++) {
                acc[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var panel = this.nextElementSibling;
                    if (panel.style.maxHeight) {
                    panel.style.maxHeight = null;
                    } else {
                    panel.style.maxHeight = panel.scrollHeight + "px";
                    } 
                });
                }

                    var modal = document.getElementById("myModal");
                    
                    var btn = document.getElementById("myBtn");

                    var span = document.getElementsByClassName("close")[0];

                    btn.onclick = function() {
                    modal.style.display = "block";
                    }

                    span.onclick = function() {
                    modal.style.display = "none";
                    }

                    window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                    }
                    var close = document.getElementsByClassName("closebtn");
                    var i;

                    for (i = 0; i < close.length; i++) {
                    close[i].onclick = function(){
                        var div = this.parentElement;
                        div.style.opacity = "0";
                        setTimeout(function(){ div.style.display = "none"; }, 600);
                    }
                    }
    });
</script>

<script  >
        function openCity(currEvt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
              tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
              tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            currEvt.currentTarget.className += " active";
        }
        document.getElementById("defaultOpen").click();
          
    
        
</script>
@endsection