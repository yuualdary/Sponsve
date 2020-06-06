
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

                                <li class="has-children">
                                        <a href="#">Company</a>
                                        <ul class="dropdown">
    
                                                <li><a href="{{url('/ProfileCompany')}}">New Company Profile</a></li>
                                                <li><a href="{{url('companyList/')}}">Company List</a></li>
        
                                            </ul>
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
<!-- Scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

