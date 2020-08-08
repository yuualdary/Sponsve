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

    @if(Auth::user()->id === $checkAssign  && $checkStatus === $submit)

    <div class="container">
        <div class="row" style="margin-top:10px;">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Proposal From </div>
                        {{--melakukan event pada product--}}
                    <div class="panel-body">
                        <form action="{{url('/rejectProposal')}}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}

                         <div class="form-group">
                            {{-- <label for="proposal_id" class="col-md-4 control-label">Id Propo</label>--}}
                                @foreach($getProposalData as $getProposalD)

                                <div class="col-md-6">
                                    <input id="proposal_id" type="hidden" class="form-control" readonly="readonly" name="proposal_id" value="{{$getProposalD->proposal_id}}" required autofocus>
                                    @endforeach  

                                </div>
                            </div>
                            <div class="form-group">

                            <label for="proposal_title" class="col-md-4 control-label">Subject</label>

                            <div class="col-md-6">
                                @foreach($getProposalData as $getProposalD)
                                
                                    {{$getProposalD->proposal_title}}

                                    <br>
                               @endforeach  
                               </div>   
                            </div>
                           

                            <div class="form-group">
                                <label for="ptid_proposal" class="col-md-4 control-label">From</label>
                               <div class="col-md-6">
                               @foreach($getProposalData as $v)
                                   {{$v->company_name}}
                                   <br>
                                @endforeach

                                </div>
                             </div>
                         
                             <input type="hidden" name="statusproposal_id" value="statusproposal_id" >

                        @foreach($getProposalData as $desc) 

                            <div class="form-group">
                                <label for="proposal_description" class="col-md-4 control-label">Description</label>

                                <div class="col-md-6">
                                    <textarea id="proposal_description"  class="form-control" style="width:100%;" readonly>{{$desc->proposal_description}}  </textarea>
 
                                    
                                </div>
                            </div>
                            @endforeach


                            <div class="form-group">
                          
                                 <button type="submit" style="background-color:#3097D1; color:#fafafa; "class="btn waves-effect waves-light"   title="Download Document Contract" name="action" value="Download">Download <i class="medium material-icons">file_download</i></a>
                                </button>
                            </div>
                        


                            <br>
                      
                            <br>
                                <div class="col-md-6 col-md-offset-4">
                                    <br>
                                    @foreach($getProposalData as $idData)
                                   
                                    <a style="background-color:#3097D1; color:#fafafa; " class="btn waves-effect waves-light" data-topropoid="{{$idData->proposal_id}}"  data-toggle="modal" data-target="#approve" >
                                    Approve <i class="medium material-icons">check</i> 
                                    </a>

                                    <a style="background-color:#3097D1; color:#fafafa; "class="btn waves-effect waves-light"  data-topropoid="{{$idData->proposal_id}}"  data-toggle="modal" data-target="#reject" >
                                        Reject <i class="medium material-icons">close</i>
                                    </a>
                                   @endforeach
                                </div>
                            </div>
                            



                         

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @elseif(Auth::user()->id === $checkUser && $checkStatus === $reject)



    {{-------}}


    <div class="container">
        <div class="row" style="margin-top:10px;">
            <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Proposal From </div>
                        {{--melakukan event pada product--}}
                        <div class="panel-body">
                            <form action="{{url('/rejectProposal')}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
    
                            
                   

                    @foreach($getProposalData as $getProposalD)
        
                    <div class="col-md-6">
                        <input id="proposal_id" type="hidden" class="form-control" readonly="readonly" name="proposal_id" value="{{$getProposalD->proposal_id}}" required autofocus>
                    </div>
                        @endforeach  

                    @foreach ($getProposalDataRev as $gC)
                        
                  
                    <div class="form-group">
                         <label for="company_id" class="col-md-4 control-label">To</label>

                             <div class="col-md-6">
                                 <input id="company_id" type="text" class="form-control" name="company_id"  value ="{{$gC->company_name}}" readonly>
                     
                            </div>
                    </div>
                    @endforeach

                    <br>
                    <br>
                    <br>
                  
                    

                        <div class="form-group{{ $errors->has('proposal_title') ? ' has-error' : '' }}">
                            <label for="proposal_title" class="col-md-4 control-label">Subject</label>

                            <div class="col-md-6">
                                <input id="proposal_title" type="text" class="form-control" name="proposal_title" value="{{ old('proposal_title') }}" required autofocus>
                                <br>
                                @if ($errors->has('proposal_title'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('proposal_title') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        {{-- <input type="hidden" name="userid_proposal" value="{{$company_id}}" > --}}


        
                        <br>

                        <div class="form-group{{ $errors->has('proposal_description') ? ' has-error' : '' }}">
                            <label for="proposal_description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                            
                                <textarea id="proposal_description"  class="form-control" name="proposal_description" value="{{ old('proposal_description') }}" style="width:100%;"required></textarea>
                                <br>
                                @if ($errors->has('proposal_description'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('proposal_description') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <br>
                        <div class="form-group{{ $errors->has('proposal_file') ? ' has-error' : '' }}">
                            <label for="proposal_file" class="col-md-4 control-label">File Proposal</label>
                           <div class="col-md-6">
                               <input type="file" name ="proposal_file" >
                               <br>
                             
                            </div>
                       </div>
                        <br>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" name="action" value="Submitted">
                                    Revision 
                                </button>
                            </div>
                        </div>
    
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @else
        
        
        <div class="container">
            <div class="row" style="margin-top:10px;">
                <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-heading">Proposal From </div>
        {{--melakukan event pada product--}}
                            <div class="panel-body">
                                <form action="{{url('/rejectProposal')}}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
        
                                 <div class="form-group">
                                    {{-- <label for="proposal_id" class="col-md-4 control-label">Id Propo</label>--}}
                                        @foreach($getProposalData as $getProposalD)
        
                                        <div class="col-md-6">
                                            <input id="proposal_id" type="hidden" class="form-control" readonly="readonly" name="proposal_id" value="{{$getProposalD->proposal_id}}" required autofocus>
                                            @endforeach  
        
                                        </div>
                                    </div>                                
                                     @foreach($getProposalData as $getProposalD)

                                    <div class="form-group">
        
                                    <label for="proposal_title" class="col-md-4 control-label" style="float:left; padding-right:850px;width:100%;">Subject</label>
                                    <div class="col-md-6">
                                            <input id="proposal_title" type="text" class="form-control" name="proposal_title"  value="{{$getProposalD->proposal_title}}" readonly>
                                    
                                    </div>  
                                    </div>
                                    
                                    @endforeach  

        
                                    <div class="form-group">
                                        <label for="ptid_proposal" class="col-md-4 control-label"style="float:left; padding-right:850px;width:100%;"">From</label>
                                       <div class="col-md-6">

                                       @foreach($getProposalData as $v)
                                       <input id="ptid_proposal" type="text" class="form-control" name="ptid_proposal"  value="{{$v->company_name}}" readonly>


                                        @endforeach

                                        </div>
                                        <br>
                                     </div>
                                 
                                     <input type="hidden" name="statusproposal_id" value="statusproposal_id" >
                                @foreach($getProposalData as $desc) 
        
                                    <div class="form-group">
                                        <label for="proposal_description" class="col-md-4 control-label"style="float:left; padding-right:850px;width:100%;">Description</label>
        
                                        <div class="col-md-6">
                                            <textarea id="proposal_description"  class="form-control" style="width:100%;" readonly>{{$desc->proposal_description}}  </textarea>
                                            
                                        </div>
                                    </div>
                                    @endforeach
        
                                    <div class="form-group">
                                  
                                         <button type="submit" class="btn waves-effect waves-light" style="background-color:#3097D1; color:#fafafa;"name="action" title="Download Document Contract" value="Download">Download <i class="medium material-icons">file_download</i></a>
                                        </button>
                                    </div>
                                
        
        
                                    <br>
                              
                                    <br>
                                       
        
        
                                 
        
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endif

    

   
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Comments</div>
                    {{--menampilkan hasil comment dengan menampilkan nama,foto profile,dan isi comment berdasarkan masing - masing account--}}
                    <div class="panel-body comment-container" >
                        @foreach($comments as $comment)
                        @if(Auth::user()->id === $comment->user_commentid)
    
                        <div class="well">
    
                                <i>{{$comment->comment_created_at}}</i>
                                <hr class="simple" style="border-color:#ccc ;border-width:3px ;">
    
                            <i><b style=" color:#000000"> <img src= "{{url('/' .$comment->image)}}" style="width:40px; height:40px; float:right; border-radius:50%; margin-left:25px;"> <a style="width:40px; height:40px; float:right; border-radius:50%; margin-left:55px;"> {{$comment->name }}</a>     <a href="{{ url('/viewDetailUserProile/'.$comment->id) }}" style="color:#000;"></a> </b></i>&nbsp;&nbsp;
                                <span style="float:right;"> {{ $comment->comment }} </span>
    
                                <div style="margin-left:10px;">
                                    {{-- <a style="cursor: pointer;" id="{{ $comment->event_id }}" name="{{ Auth::user()->name }}" token="{{ csrf_token() }}" class="reply">Reply</a>&nbsp; --}}
    
                                    <a style="cursor: pointer;" title="Delete Comment" class="delete-comment" href="{{url('deleteComment/'.$comment->cmntid)}}"> <i class="material-icons">delete</i></a>
                                </div>
                            </div>
    
                                @else
                                <div class="well">
                                        <i style="width:150px; height:40px; float:right; border-radius:50%; margin-left:105px;">{{$comment->comment_created_at}}</i>
                                        
                                        <hr class="simple" style="border-color:#ccc ;border-width:3px ;">
    
    
                                <i><b style=" color:#000000">   <img src= "{{url('/' .$comment->image)}}" style="width:40px; height:40px; float:left; border-radius:50%; margin-right:25px;"> <a href="{{ url('/viewDetailUserProile/'.$comment->id) }}" style="color:#000;"> {{$comment->name }}</a> </b></i>&nbsp;&nbsp;
                                <span> {{ $comment->comment }} </span>
                                <br>
    
                            </div>
                            @endif
    
                        @endforeach
    
    
                    </div>
                </div>
            </div>
        </div>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Write Coment </div>
{{--melakukan comment pada detail [] product dengan menggunakan masing - masing account dan kita bisa mendelete commetn dan melihat comment orang lain--}}
            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                
                    <form id="comment-form" method="post" action="{{ route('comments.store') }}" >
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" >
                        <div class="row" style="padding: 10px;">
                            <div class="form-group" style="width:100%">
                                <textarea style="width=100px" class="form-control" name="comment" placeholder="Write something" required></textarea>
                            </div>
                        </div>
                        {{-- <!-- @foreach($proposal as $value) -->
                        <input  name="proposal_commentid" value="{{$value}}" type="hidden">
                        <!-- @endforeach --> --}}
                        <input type="hidden" name="proposal_commentid" value="{{$checkId}}" >

                        <div class="row" style="padding: 0 10px 0 10px;">
                            <div class="form-group">
                                <button type="submit"style="background-color:#3097D1; color:#fafafa; "class="btn waves-effect waves-light"   title="Download Document Contract" name="action" value="Download">Submit <i class="small material-icons">send</i></button>
                            </div>
                        </div>
                    </form>

            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="approve" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="col-md-12 modal-content">
                <form method="post" action="{{url('/rejectProposal')}}" >
                    {{csrf_field()}}
      
                        <div class="modal-header">
                                    <h4 class="modal-title">Approve</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                        ×
                                    </button>
                                    
                                </div>
                                <div class="modal-body">
                                        <input type="hidden" name="proposal_id" id="pid" cols="20" rows="5" class="form-control">

                                    <p>
                                        Are you sure want to Approve ?
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                        Cancel
                                    </button>
                                    <button  class="btn btn-primary" type="submit" name="action" value="Approve">
                                        Yes
                                    </button>
                                </div>
                </form>
        </div><!-- /.modal-content -->
    </div>
</div>
<div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="col-md-12 modal-content">
                <form action="{{url('/rejectProposal')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
            
                    <div class="modal-header">
                                    <h4 class="modal-title">Reject</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                        ×
                                    </button>
                                    
                                </div>
                                <div class="modal-body">

                                        <input type="hidden" name="proposal_id" id="pid" cols="20" rows="5" class="form-control">

                                    <p>
                                        Are you sure want to Reject ?
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                        Cancel
                                    </button>
                                    <button class="btn btn-primary" type="submit" name="action" value="Reject">
                                        Yes
                                    </button>
                                </div>
                </form>
        </div><!-- /.modal-content -->
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



        $('#approve').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var propoid = button.data('topropoid') 

            


            var modal = $(this)
            modal.find('.modal-body #pid').val(propoid);
        

        })


        $('#reject').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var propoid = button.data('topropoid') 

            


            var modal = $(this)
            modal.find('.modal-body #pid').val(propoid);
        

        })
        //   export default {
        //     props: ['messages']
        //   };


        $(document).ready(function(){
            $('#auto').load('detailofproposal.blade.php');
            refresh();
        })

        function refresh()
        {
            setTimeout(function(){
                $('#auto').fadeOut('slow').load('detailofproposal.blade.php').fadeIn('slow');
                refresh();
            },1000)
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
