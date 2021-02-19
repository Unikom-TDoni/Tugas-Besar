<header class="header">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-4 logo">
                <a href="{{route('pelanggan.homepage.index')}}" title="Rentall"><img class="logo" src="{{URL::asset('assets/pelanggan')}}/img/logo.svg" alt="float"></a> 
            </div>
            <div class="col-8 col-sm-4 offset-sm-4 menu">
                <nav class="nav">
                    <ul class="nav-inner">
                        @guest('pelanggan')
                            <li><a class=" btn btn-secondary nav-item" href="{{route('pelanggan.register.index')}}" title="register">Register</a></li>
                            <li><a class=" btn btn-secondary nav-item" href="{{route('pelanggan.login.index')}}" title="login">Login</a></li>  
                        @endguest
                        @auth('pelanggan')
                            <li>
                                <a class=" btn btn-secondary nav-item" href="{{route('pelanggan.recipt.index')}}" title="login">My Order</a></li>  
                            </li>
                            <li>
                                <div class="dropdown">
                                    <a href="javascript:void(0)" class="btn btn-secondary nav-item dropdown-toggle" title="login" id="profileButtonDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileButtonDropdown">
                                        <a class="dropdown-item" href="{{route('pelanggan.profile.index')}}" title="profile">Profile</a>
                                        <form method="POST" action="{{route('pelanggan.profile.logout')}}">
                                           @csrf
                                           <button class="dropdown-item" type="submit">Logout</button>
                                       </form>
                                      </div>
                                </div>
                            </li>
                        @endauth
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>