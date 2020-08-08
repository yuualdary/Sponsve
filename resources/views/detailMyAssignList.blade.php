<!DOCTYPE html>
<html lang="en">
    <head>
        {{--bagian kerangka dari website meliputi header,contetnt,footer ,css,js link--}}
       
        <title>SponsVe</title>
        <link rel = "icon" href =  
        "https://media.geeksforgeeks.org/wp-content/cdn-uploads/gfg_200X200.png" 
            type = "image/x-icon"> 
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
       
        <link rel="stylesheet" href="{{url('css/Style.css')}}">
        <link rel="stylesheet" href="{{url('css/bootstrap_min.css')}}">
        <link rel="stylesheet" href="{{url('css/magnific-popup.css')}}">
        <link rel="stylesheet" href="{{url('css/jquery-ui.css')}}">
        <link rel="stylesheet" href="{{url('css/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{url('css/owl.theme.default.min.css')}}">
        <link rel="stylesheet" href="{{url('css/swiper.css')}}">
        <link rel="stylesheet" href="{{url('css/swiper.min.css')}}">
    
        <link rel="stylesheet" href="{{url('css/app.css')}}">
        
        {{-- <link rel="stylesheet" href="{{url('js/jquery/jquery-3.3.1.min.js')}}"> --}}
    
        {{-- <link rel="stylesheet" href="{{url('resource/assets/js/app.js')}}"> --}}
     {{-- <script type="text/javascript" src="{{ asset('/js/app.js') }}"></script> --}}
    
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    
    
    
        <link rel="stylesheet" href="css/aos.css">
    
        <link rel="stylesheet" href="css/Style.css">
    
        <style>
            .chat {
                list-style: none;
                margin: 0;
                padding: 0;
            }
            .chat li {
                margin-bottom: 10px;
                padding-bottom: 5px;
                border-bottom: 1px dotted #B3A9A9;
            }
            .chat li .chat-body p {
                margin: 0;
                color: #777777;
            }
            .panel-body-chat {
                overflow-y: scroll;
                padding:10px 10px 10px 10px;
                height: 350px;
            }
            ::-webkit-scrollbar-track {
                -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
                background-color: #F5F5F5;
            }
            ::-webkit-scrollbar {
                width: 12px;
                background-color: #F5F5F5;
            }
            ::-webkit-scrollbar-thumb {
                -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
                background-color: #555;
            }
            /* The Modal (background) */
            .modal {
                display: none; /* Hidden by default */
                position: fixed; /* Stay in place */
                z-index: 1; /* Sit on top */
                left: 0;
                top: 0;
                width: 100%; /* Full width */
                height: 100%; /* Full height */
                overflow: auto; /* Enable scroll if needed */
                background-color: rgb(0,0,0); /* Fallback color */
                background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            }
    
            /* Modal Content/Box */
            .modal-content {
                background-color: #fefefe;
                margin: 20% auto; /* 15% from the top and centered */
                padding: 20px;
                z-index: 1050;
                border: 1px solid #888;
                width: 40%; /* Could be more or less, depending on screen size */
            }
    
            /* The Close Button */
            .close {
                color: #aaa;
                float: right;
                margin-left: 470px;
                width: 15px;
                font-size: 28px;
                font-weight: bold;
            }
    
            .close:hover,
            .close:focus {
                color: black;
                text-decoration: none;
                cursor: pointer;
            }
            .swiper-container {
                width: 100%;
                height: 100%;
            }
            .swiper-slide {
                text-align: center;
                font-size: 18px;
                background: #fff;
    
                /* Center slide text vertically */
                display: -webkit-box;
                display: -ms-flexbox;
                display: -webkit-flex;
                display: flex;
                -webkit-box-pack: center;
                -ms-flex-pack: center;
                -webkit-justify-content: center;
                justify-content: center;
                -webkit-box-align: center;
                -ms-flex-align: center;
                -webkit-align-items: center;
                align-items: center;
            }
        </style>
    
    </head>
<body style="background-color:#fff">
    <div class="header" style="">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
        <div class="site-wrap">
    
            <header class="site-navbar" role="banner">
                <div class="site-navbar-top">
                    <div class="container">
                        <div class="row align-items-center">
    
                            <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left" action="{{url('/doSearch')}}" method="get">
                                <form action="{{url('/doSearch')}}" class="site-block-top-search">
                                    <span class="icon icon-search2"></span>
                                    <input type="text" class="form-control border-0" name="search" placeholder="Search Event">
                                    <button  type="submit"  class="btn waves-effect waves-light" style="background-color:#3097D1; color:#fafafa" name="action"  title="Search Event" value="name">Search  <i class="small material-icons">search</i></button>
                                </form>
                            </div>
    
                            <div class="col-12 mb-3 mb-md-0 col-md-4 order- order-md-2 text-center">
                                <div class="site-logo">
                                    <a href="{{ url('/') }}" class="js-logo-clone">SponsVe</a>
                                </div>
                            </div>
    
                            <div class="col-6 col-md-4 order-3 order-md-3 text-right">
                                <div class="site-top-icons">
                                        <!-- Right Side Of Navbar -->
                                        
                                        <ul class="nav navbar-nav navbar-right" style="overflow:hidden;display:inline">
                                            <!-- Authentication Links -->
                                            <!-- pembeda antara member dengan user dan admindmin-->
                                                @guest
                                                    <li><a href="{{ route('login') }}">Login</a></li>
                                                @else
    
                                                {{-- @if(Auth::user()->id=='1')
                                                    <li>Hello {{Auth::user()->name}}</li>
    
                                                @else
                                                    <li>Hello {{Auth::user()->name}}</li>
                                                @endif --}}
    
                                                <li style="width:20px;margin-right:10px;margin-top:5px;">
                                                    <a href="{{url('/RequestList/'.Auth::user()->userid_tocompany)}}"><i class="medium material-icons"  style="width:50px; height:50px; position:absolute; top:1px; right:5px; border-radius:50%; color:#3097D1;">notifications</i></a>
                                                </li>
                                                
                                                <li class="dropdown">
                                                
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="position:relative; padding-left:200px;">
                                                        <img src= "{{ url(Auth::user()->image) }}" style="width:50px; height:50px; position:absolute; top:1px; right:160px; border-radius:50%">
                                                        {{ Auth::user()->name }}
                                                    </a>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li>
                                                            <a href="{{ url('/profile') }}"><i class="fa fa-btn fa-user"></i>Profile</a>
    
                                                            <a href="{{ route('logout') }}"
                                                               onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                                Logout
                                                            </a>
    
                                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                                {{ csrf_field() }}
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </li>
                                            @endguest
                                        </ul>
                                </div>
                            </div>
    
                        </div>
                    </div>
                </div>
                <nav class="site-navigation text-right text-md-center" role="navigation" style="box-shadow: 0 4px 6px 0px rgba(0, 0, 0, 0.2)">
                    <div class="container">
                        <ul class="site-menu js-clone-nav d-none d-md-block">
                            @guest
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li class="has-children">
                                            <a href="#">Company</a>
                                            <ul class="dropdown">
                                                    <li><a href="{{url('companyList/')}}">Company List</a></li>
            
                                            </ul>
                                </li>
                             
                                <li><a href="{{url('view')}}">Event List</a></li>
    
                               
                            @else
                                @if(Auth::user()->id=='1')
                                    {{--navigasi untuk para admin--}}
                                    <li><a href="{{ url('/') }}">Home</a></li>
                                    {{-- <li class="has-children active">
                                            <a href="#">Management</a>
                                            <ul class="dropdown">
                                              <li><a href="#">Menu One</a></li>
                                              <li><a href="#">Menu Two</a></li>
                                              <li><a href="#">Menu Three</a></li>
                                              <li class="has-children">
                                                <a href="#">Sub Menu</a>
                                                <ul class="dropdown">
                                                  <li><a href="#">Menu One</a></li>
                                                  <li><a href="#">Menu Two</a></li>
                                                  <li><a href="#">Menu Three</a></li>
                                                </ul>
                                              </li>
                                            </ul>
                                    </li> --}}
                                    <li class="has-children">
                                        <a href="#">Management</a>
                                        <ul class="dropdown">
                                            <li class="has-children">
                                             
                                                    <li><a href="{{url('positioninput')}}">Position</a></li>
                                                    <li><a href="{{url('MasterDataInput')}}">Status</a></li>
                                                    <li><a href="{{url('inputcategory')}}">Category</a></li>
    
                                              
                                            </li>
                                        </ul>
                                    </li>
                                          
                                    
                                  
                                @endif
                                    {{--//navigasi untuk para member--}}
                                    @if(Auth::user()->userid_tocompany === NULL)
                                    <li><a href="{{ url('/') }}">Home</a></li>
                                    <li class="has-children">
                                            <a href="#">Company</a>
                                            <ul class="dropdown">
        
                                                    <li><a href="{{url('/ProfileCompany')}}">New Company Profile</a></li>
                                                    <li><a href="{{url('companyList/')}}">Company List</a></li>
            
                                            </ul>
                                    </li>
                                    {{-- <li class="has-children">
                                        <a href="#">Company Profile</a>
                                        <ul class="dropdown">
                                            <li><a href="{{url('/ProfileCompany')}}">New Company Profile</a></li>
                                            <li><a href="{{url('/viewListCompany')}}">Company List </a></li>
                                            </ul>
                                    </li> --}}
    
                                    <li class="has-children">
                                        <a href="#">Event</a>
                                        <ul class="dropdown">
                                            <li><a href="{{url('view')}}">Event List</a></li>
    
                                        </ul>
                                    </li>
                                    @else
    
    
                                    @if(Auth::user()->id!='1' && Auth::user()->userid_tocompany != NULL)
                                    <li><a href="{{ url('/') }}">Home</a></li>
                                    @endif
                                    <li class="has-children">
                                        
                                    
                                        
                                        <a href="#">Company</a>
                                        <ul class="dropdown">
    
                                                <li><a href="{{url('/toCompanyDet/'.Auth::user()->userid_tocompany)}}">My Company </a></li>
                                                <li><a href="{{url('companyList/')}}">Company List</a></li>
        
                                            </ul>
    
                                            <li class="has-children">
                                                <a href="#">Event</a>
                                                <ul class="dropdown">
                                                    <li><a href="{{url('view')}}">Event List</a></li>
                                                    <li><a href="{{url('CompanyEvent')}}">Company Event</a></li>
            
                                                </ul>
                                            </li>
                                    @endif  
                                        
    
    
    
                                        
                                    <li class="has-children">
                                        {{-- <a href="#">Manage Candidate</a>
                                        <ul class="dropdown">
                                            <li><a href="{{url('viewuser')}}">Candidate List</a></li>
                                        </ul> --}}
                                      @if(Auth::user()->userid_tocompany != NULL)  
                                    <li class="has-children">
                                        <a href="#">Manage Your Event</a>
                                        <ul class="dropdown">
                                            <li><a href="{{url('input')}}">Create Event</a></li>
                                            <li><a href="{{url('viewMyEvent')}}">My Event List</a></li>
    
                                            <li class="has-children js-clone-nav d-none d-md-block">
                                                <a href="#">Contract Event List</a>
                                                <ul class="dropdown ">
                                                        <li><a href="{{url('/ourAssign')}}">All Task</a></li>
                                                        <li><a href="{{url('/viewMyAssignList')}}">My Task</a></li>
                                                </ul>
                                            </li>
    
    
                                            <li><a href="{{url('viewAllRequest')}}">Invited Event</a></li>
    
                                        </ul>
                                    </li>
                                    @endif
    
                                  
                                    {{-- <li><a href="{{url('cartview')}}">Shopping Cart</a></li> --}}
                            @endguest
                        </ul>
                    </div>
                </nav>
            </header>
        </div>
    </div>

    <div class="container" style="margin-top:20px"> 
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                        
                                <div class="panel-heading">Detail Document Contract</div>
                        
                                {{--menampilkan detail dari product dan bisa melihat detail tersebut dan bisa melakukan comment terhadap product tersebut--}}
                                @if(session()->has('successAdd'))
                                <div class="alert success">
                                    <span class="closebtn">&times;</span>  
                                    <b><strong>Success</strong> Change PIC</b>
                                </div>
                                @endif


                                @if(session()->has('accMsg'))
                                <div class="alert success">
                                    <span class="closebtn">&times;</span>  
                                    <b><strong>Success</strong> Approve Your Document</b>
                                </div>
                                @endif
                                @if(session()->has('reMsg'))
                                <div class="alert success">
                                    <span class="closebtn">&times;</span>  
                                    <b><strong>Success</strong> Submit Document</b>
                                </div>
                                @endif
                                @if(session()->has('rejMsg'))
                                <div class="alert success">
                                    <span class="closebtn">&times;</span>  
                                    <b><strong>Success</strong> Reject Your Document</b>
                                </div>
                                @endif

                            
                                <div class="panel-body">
                                
                                    @foreach($detailProposal as $U)
                
                                    <i><b style=" color:#000000"> <img src= "{{url('/' .$U->image)}}" style="width:50px; height:50px; float:left; border-radius:50%; margin-right:25px;"> {{  $U->name }} </b></i>&nbsp;&nbsp;
                                    <br>
                                        <i style="font-size=5px">as {{$U->position}}</i>
                                        
                                        @endforeach
            
                                        <h3>{{$U->proposal_title}}</h3>
                                    
                                        <a href="{{url('/detail/'.$U->eventid_proposal)}}"><img src="{{url('/'.$U->photo)}}" style="width:570px; height:300px;"></a>                                        <br>
                                    
                                
                                            
                                     <h4>   <i class="material-icons" style="color:#3097D1;">chrome_reader_mode</i> Status : {{$U->text1}}</h4>
                                       <h4> <i class="material-icons" style="color:#3097D1;">autorenew</i> Last Update : {{$U->proposal_modified_at}}</h4>
                                        <br>
                                        @if(Auth::user()->position_id === $admin && Auth::user()->userid_tocompany === $U->ptid_proposal)                        

                                    
                                            <a class="btn waves-effect waves-light" style="background-color:#3097D1; color:#fafafa;"title="Change PIC"  data-tomyevent="{{$U->proposal_id}}" data-toassigned="{{$U->assignid_proposal}}" data-toimage="{{url($U->image)}}" data-toname="{{$U->name}}" data-toggle="modal" data-target="#assign" >Change PIC <i class="material-icons">contacts</i></a>
                                            <a class="btn waves-effect waves-light" style="background-color:#3097D1; color:#fafafa;" titile="to proposal" href={{url("toDetailPropo/".$U->proposal_id)}}>Look Document Contract<i class="material-icons">launch</i></a>

                                        @elseif(Auth::user()->userid_tocompany === $U->userid_proposal)

                                            <a class="btn waves-effect waves-light" style="background-color:#3097D1; color:#fafafa;" titile="to proposal" href={{url("toDetailPropo/".$U->proposal_id)}}>Look Document Contract<i class="material-icons">launch</i></a>
                                        
                                        @elseif(Auth::user()->userid_tocompany === $U->ptid_proposal)


                                            <a class="btn waves-effect waves-light" style="background-color:#3097D1; color:#fafafa;" titile="to proposal" href={{url("toDetailPropo/".$U->proposal_id)}}>Look Dcoument Contract<i class="material-icons">launch</i></a>
                                        
                                       
                                       
                                         @endif
                                    
                
                                </div>
                        </div>
                    </div>
                </div>
    </div>


    <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="panel panel-default">
                            
                                <div class="panel-heading">Log Proposal <i class="material-icons" style="color:#3097D1">format_list_bulleted
                                </i></div>
                            
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
                                            <br>
                                                
                                            
                                            
                            
                                    </tr>
                                    
                                     @endforeach
                            
                                </div>
                            
            
                            
            
                            </div>
                        </div>
                    </div>
    </div>
    
    
    <div class="modal fade" id="assign" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <!-- <link src="{{  asset('/js/app.js') }}" rel="stylesheet"> -->
                    
					<div class="modal-dialog">
                        <form  method="post" action="{{url('/changePIC')}}">
                            {{csrf_field()}}
                            <div class="col-md-12 modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Change Assign</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                            ×
                                                        </button>
                                                        
                                                    </div>
                                                    <div class="modal-body">
                                                        <label for="req_userid" class="float-md-left mb-4">Assign from :</label>
                                                        <img  id="toi"  src="{{url("toimage")}}" style="width:40px; height:40px; border-radius:50%">  <input disabled="disabled" name="toname" id="ton"  cols="10" rows="1" class="form-">

                                                        <input type="hidden" name="proposal_id" id="tme" cols="20" rows="5" class="form-control">

                                                        
                                                        @foreach ($detailProposal as $dp)
                                                        <label for="req_userid">To :</label>
                                                        <select id="assignid_proposal" name="assignid_proposal" required>  
                                                        @foreach ($getAssign as $assign)

                                                        @if($dp->assignid_proposal != $assign->id)

                                                
                                                        <option value="{{$assign->id}}" > <img src= "{{ url($assign->image) }}" style="width:10px; height:10px; border-radius:50%">{{$assign->name}} #{{$assign->user_code}}
                                                        </option>  
                                                        @endif                                            
                                                        @endforeach

                                                        </select>

                                                        @endforeach
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">
                                                            Close
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                                    </div>
                            </div><!-- /.modal-content -->
                        </form>
					</div>
    </div>
    
    <footer class="site-footer border-top" style="background-color: white;box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    {{--<div class="row">--}}
                        {{--<div class="col-md-12">--}}
                            {{--<h3 class="footer-heading mb-4">Navigations</h3>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-6 col-lg-4">--}}
                            {{--<ul class="list-unstyled">--}}
                                {{--<li><a href="#">Sell online</a></li>--}}
                                {{--<li><a href="#">Features</a></li>--}}
                                {{--<li><a href="#">Shopping cart</a></li>--}}
                                {{--<li><a href="#">Store builder</a></li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-6 col-lg-4">--}}
                            {{--<ul class="list-unstyled">--}}
                                {{--<li><a href="#">Mobile commerce</a></li>--}}
                                {{--<li><a href="#">Dropshipping</a></li>--}}
                                {{--<li><a href="#">Website development</a></li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-6 col-lg-4">--}}
                            {{--<ul class="list-unstyled">--}}
                                {{--<li><a href="#">Point of sale</a></li>--}}
                                {{--<li><a href="#">Hardware</a></li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="block-5 mb-5">
                        <h3 class="footer-heading mb-4">Contact Info</h3>
                        <ul class="list-unstyled">
                            <li>Jalan Kebon Jeruk Raya No.27 1 9, RT.1/RW.9, Kb. Jeruk, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11530</li>
                            <li><a href="https://hangouts.google.com/webchat/start?hl=en-ID&ht=0&hcb=0&lm1=1544294515958&hs=84&hmv=1&ssc=WyIiLDAsbnVsbCxudWxsLG51bGwsW10sbnVsbCxudWxsLG51bGwsbnVsbCxudWxsLDg0LG51bGwsbnVsbCxudWxsLFsxNTQ0Mjk0NTE1OTU4XSxudWxsLG51bGwsW1tudWxsLG51bGwsW251bGwsIis2MjIxNTM2OTY5NjkiXV1dLG51bGwsbnVsbCx0cnVlLG51bGwsbnVsbCxudWxsLG51bGwsbnVsbCxudWxsLFtdLFtdLG51bGwsbnVsbCxudWxsLFtdLG51bGwsbnVsbCxudWxsLFtdLG51bGwsbnVsbCxbXV0.&action=chat&pn=%2B622153696969">(021) 53696969</a></li>
                            <li>emailbinus@binus.com</li>
                        </ul>
                    </div>

                    {{--<div class="block-7">--}}
                        {{--<form action="#" method="post">--}}
                            {{--<label for="email_subscribe" class="footer-heading">Subscribe</label>--}}
                            {{--<div class="form-group">--}}
                                {{--<input type="text" class="form-control py-4" id="email_subscribe" placeholder="Email">--}}
                                {{--<input type="submit" class="btn btn-sm btn-primary" value="Send">--}}
                            {{--</div>--}}
                        {{--</form>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </footer>



    <script type="text/javascript" src="{{ asset('/js/app.js') }}"></script>

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

            
        //       $.ajax({
        //           url: "te,
        //           type: 'GET',
        //           data: {id:4},
        //            success: function(response){ // What to do if we succeed
        //           if(data == "success")
        //         alert(response); 
        //       },
        // error: function(response){
        //     alert('Error'+response);
        //     }
        //         });
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
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            'pusherKey' => config('broadcasting.connections.pusher.key'),
            'pusherCluster' => config('broadcasting.connections.pusher.options.cluster')
        ]) !!};
    </script>
    <script src="/js/bootstrap.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/aos.js"></script>
    <script>
            
    </script>

    <script src="js/swiper.js"></script>
    <script src="js/swiper.min.js"></script>
    <script>

            var swiper = new Swiper('.swiper-container', {
                slidesPerView: 2,
                spaceBetween: 600,
                centeredSlides: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
    
            // automatic slideshow
            setInterval(function() { 
                swiper.slideNext()
            },  5000);
            
    </script>


</body>
</html>
