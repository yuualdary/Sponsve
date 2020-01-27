


<div class="header">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <div class="site-wrap">
        <header class="site-navbar" role="banner">
            <div class="site-navbar-top">
                <div class="container">
                    <div class="row align-items-center">

                        <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left" action="{{url('/doSearch')}}" method="get">
                            <form action="{{url('/doSearch')}}" class="site-block-top-search">
                                <span class="icon icon-search2"></span>
                                <input type="text" class="form-control border-0" name="search" placeholder="Search Image">
                                <input class="btn btn-primary" type="submit" value="Search">
                            </form>
                        </div>

                        <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
                            <div class="site-logo">
                                <a href="{{ url('/') }}" class="js-logo-clone">ScriptSi</a>
                            </div>
                        </div>

                        <div class="col-6 col-md-4 order-3 order-md-3 text-right">
                            <div class="site-top-icons">
                                <ul>
                                    <!-- Right Side Of Navbar -->
                                    <ul class="nav navbar-nav navbar-right">

                                        <!-- Authentication Links -->
                                        <!-- pembeda antara member dengan user dan admindmin-->
                                        @guest
                                            <li><a href="{{ route('login') }}">Login</a></li>
                                        @else

                                            @if(Auth::user()->id=='1')
                                                <li>Hello {{Auth::user()->name}}</li>

                                            @else
                                                <li>Hello {{Auth::user()->name}}</li>
                                            @endif

                                            <li class="dropdown">
                                            <a href="{{url('/RequestList/'.Auth::user()->userid_tocompany)}}"><i class="medium material-icons" style="width:50px; height:50px; position:absolute; top:1px; right:220px; border-radius:50%">notifications</i></a>

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
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <nav class="site-navigation text-right text-md-center" role="navigation">
                <div class="container">
                    <ul class="site-menu js-clone-nav d-none d-md-block">
                        @guest
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{url('view')}}">Shop</a></li>
                        @else
                            @if(Auth::user()->id=='1')
                                {{--navigasi untuk para admin--}}
                                <li><a href="{{ url('/') }}">Home</a></li>

                                <li class="has-children">
                                    <a href="#">Manage Master Data</a>
                                    <ul class="dropdown">
                                        <li><a href="{{url('positioninput')}}">Position</a></li>
                                        <li><a href="{{url('MasterDataInput')}}">Master Add New Data</a></li>

                                    </ul>
                                </li>
                                <li class="has-children">
                                    <a href="#">Manage Category</a>
                                    <ul class="dropdown">
                                        <li><a href="{{url('inputcotegory')}}">Insert</a></li>
                                        <li><a href="{{url('viewupCateg')}}">Update</a></li>
                                        <li><a href="{{url('viewdelCategory')}}">Delete</a></li>
                                    </ul>
                                </li>
                              
                            @endif
                                {{--//navigasi untuk para member--}}
                       
                                <li class="has-children">
                                    <a href="#">Company Profile</a>
                                    <ul class="dropdown">
                                        <li><a href="{{url('/ProfileCompany')}}">New Company Profile</a></li>
                                        <li><a href="{{url('/viewListCompany')}}">Company List </a></li>
                                        </ul>
                                </li>
                                    


                                <li><a href="{{url('view')}}">Sponsor List</a></li>
                                <li class="has-children">
                                    <a href="#">Manage Candidate</a>
                                    <ul class="dropdown">
                                        <li><a href="{{url('viewuser')}}">Candidate List</a></li>
                                    </ul>
                                <li class="has-children">
                                    <a href="#">Manage Your Vancies</a>
                                    <ul class="dropdown">
                                        <li><a href="{{url('input')}}">Insert</a></li>
                                        <li><a href="{{url('viewup')}}">Update</a></li>
                                        <li><a href="{{url('viewdel')}}">Delete</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{url('cartview')}}">Shopping Cart</a></li>
                        @endguest
                    </ul>
                </div>
            </nav>
        </header>
    </div>
</div>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

