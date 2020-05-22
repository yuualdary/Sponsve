@extends('welcome')

@section('content')
<br>



    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                   
                    <div class="panel-heading">Detail Event</div>
                   
            {{--menampilkan detail dari product dan bisa melihat detail tersebut dan bisa melakukan comment terhadap product tersebut--}}
            @if(session()->has('successAdd'))
                    <div class="alert success">
                        <span class="closebtn">&times;</span>  
                        <b><strong>Success</strong> Change PIC</b>
                    </div>
                    @endif
                    

                    
                    <div class="panel-body">
                    
                        @foreach($detailProposal as $U)
    
                        <i><b style=" color:#000000"> <img src= "{{url('/' .$U->image)}}" style="width:50px; height:50px; float:left; border-radius:50%; margin-right:25px;"> {{  $U->name }} </b></i>&nbsp;&nbsp;
                        <br>
                            <i style="font-size=5px">as {{$U->position}}</i>
                            
                        @endforeach
  
                            <h3>{{$U->proposal_title}}</h3>
                           
                            <img src="{{url('/'.$U->photo)}}" style="width:570px; height:300px;">
                            <br>
                        
                       
                                
                            <h4>Status : {{$U->text1}}</h4>
                            <h4>Last Update : {{$U->proposal_modified_at}}</h4>
                            <br>

                                @if(Auth::user()->position_id === $admin)                        
                                 <a class="btn btn-primary" title="Change PIC"  data-tomyevent="{{$U->proposal_id}}" data-toassigned="{{$U->assignid_proposal}}" data-toimage="{{url($U->image)}}" data-toname="{{$U->name}}" data-toggle="modal" data-target="#assign" >Change PIC</a>
                            @endif
    
                          
    
                        </div>

                

                  

                </div>
            </div>
        </div>
    </div>
  
       

       
       
       
       
                                   

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                       
                        <div class="panel-heading">Log Proposal</div>
                       
                {{--menampilkan detail dari product dan bisa melihat detail tersebut dan bisa melakukan comment terhadap product tersebut--}}
                @if(session()->has('successAdd'))
                        <div class="alert success">
                            <span class="closebtn">&times;</span>  
                            <b><strong>Success</strong> Send Your Request</b>
                        </div>
                        @endif
                        
               
                        
                        <div class="panel-body">
                                @foreach($logProposal as $prop )
                                <br>
                            <tr>
                                    <td>
                                    <img src= "{{url('/' .$prop->image)}}" style="width:40px; height:40px; float:left; border-radius:50%; margin-left:25px; margin-top:10px; margin-bottom:10px;">
                                    <br><i style="margin-left:25px; margin-top:10px;"><b> {{$prop->log_message}}</b></i>
                                    </td>
                                    <td>
                                        
                                    </td>
                                    
                    
                            </tr>
                             
                          @endforeach
                    
                        </div>
                    
    
                      
    
                    </div>
                </div>
            </div>
        </div>
      
           
    
           
           
           
           
                                       
    
                        </div>
                    </div>
                </div>
            </div>
        </div>
 


         <div class="modal fade" id="assign" tabindex="1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-content" style="height:500px; width:700px;position:center">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Assign</h4>
                </div>
                 <form method="post" action="{{url('/changePIC')}}">
                        {{csrf_field()}}
                    <div class="modal-body">
                        <img  id="toi"  src="{{url("toimage")}}" style="width:40px; height:40px; border-radius:50%">  <input disabled="disabled" name="toname" id="ton"  cols="10" rows="1" class="form-">

                        <input type="hidden" name="proposal_id" id="tme" cols="20" rows="5" class="form-control">
                        
                     <label for="req_userid" class="float-md-left mb-4">Assign to :</label>
                    @foreach ($detailProposal as $dp)
                        
                    <select id="assignid_proposal" name="assignid_proposal">  
                    @foreach ($getAssign as $assign)
                  
                        @if($dp->assignid_proposal != $assign->id)

                        
                         <option value="{{$assign->id}}"> <img src= "{{ url($assign->image) }}" style="width:10px; height:10px; border-radius:50%">{{$assign->name}}
                         </option>  
                         @endif                                            
                           @endforeach
        
                    </select>

                    @endforeach

        
        
        
                        
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                     </div>
                 </div>
            
                 </form>
              </div>
        </div>
    </div>





 <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
 {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}


<script>


    $('#request').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var eventreq = button.data('tomyevent') 

        


        var modal = $(this)
        modal.find('.modal-body #rid').val(eventreq);
    

    })


    $('#assign').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var tomyevent = button.data('tomyevent') 
        var toassigned = button.data('toassigned')
        var toimage = button.data('toimage') 
        var toname = button.data('toname') 




        var modal = $(this)
        modal.find('.modal-body #tme').val(tomyevent);
        modal.find('.modal-body #toa').val(toassigned);
        modal.find('.modal-body #ton').val(toname);

        modal.find('.modal-body #toi').attr("src",toimage);
    })



        
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
</script>
<script>



    // $.ajaxSetup({

    //     headers: {

    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

    //     }

    // });



    // $(".btn-submit").click(function(e){

    //     e.preventDefault();



    //     var comment_id = $("input[name=comment_id]").val();
        
    //     var user_id = $("input[name=user_id]").val();

    //     var reply = $("input[name=reply ]").val();

        



    //     $.ajax({

    //        type:'POST',

    //        url:'/detail/{id}',

    //        data:{comment_id:comment_id, user_id:user_id, reply:reply},

    //        success:function(data){

    //           alert(data.success);

    //        }

    //     });



	// });




</script>


@endsection
