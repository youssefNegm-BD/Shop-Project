<div class="card border-0 shadow-lg">
                    <div class="card-header  text-white" style="background-color:#051922;">
                        Welcome, {{Auth::user()->name}}                      
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            {{-- @if(Auth::user()->image !="")
                            <img src="{{asset('uploads/profile/thumb/'.Auth::user()->image)}}" class="img-fluid rounded-circle" alt="No Image">                            
                            @endif --}}
                        </div>
                        <div class="h5 text-center">
                            <strong>{{Auth::user()->name}}    </strong>
                        </div>
                    </div>
                </div>
                <div class="card border-0 shadow-lg mt-3">
                    <div class="card-header  text-white" style="background-color:#051922; ">
                        Navigation
                    </div>
                    <div class="card-body sidebar">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="{{ route('homePage') }}">Main Page</a>
                            </li>
                                @if (Auth::user()->role == 'admin')
                                <li class="nav-item">
                                <a href="{{ route('productList') }}">products</a>                               
                            </li>
                                @endif

                            <li class="nav-item">
                                <a href="{{ route('profile') }}">Profile</a>                               
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('changePass') }}">Change Password</a>
                            </li> 
                            <li class="nav-item">
                                <a href="{{ route('logout') }}">Logout</a>
                            </li>                           
                        </ul>
                    </div>
                </div>