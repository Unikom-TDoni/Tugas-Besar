<header class="header">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-3 logo">
                <a href="{{route('pelanggan.homepage.index')}}" title="Rentall"><img class="logo" src="{{URL::asset('assets/pelanggan')}}/img/logo.svg" alt="float"></a> 
            </div>
            <div class="col-5 offset-4 menu">
                <nav class="nav">
                    <ul class="nav-inner">
                        @guest('pelanggan')
                            <li><a class=" btn btn-secondary nav-item" href="{{route('pelanggan.register.index')}}" title="register">Register</a></li>
                            <li><a class=" btn btn-secondary nav-item" href="{{route('pelanggan.login.index')}}" title="login">Login</a></li>  
                        @endguest
                        @auth('pelanggan')
                            <li>
                                {{-- <form method="POST" action="{{route('pelanggan.profile.logout')}}">
                                    @csrf
                                    <button class=" btn btn-secondary nav-item" title="register" type="submit">Log Out</button>
                                </form> --}}
                                <a class=" btn btn-secondary nav-item" href="{{route('pelanggan.profile.index')}}" title="login">Profile</a>
                            </li>
                        @endauth
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>