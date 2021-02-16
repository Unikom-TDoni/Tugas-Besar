<header class="header">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-3 logo">
                <img class="logo" src="{{URL::asset('assets/pelanggan')}}/img/logo.svg" alt="float">
            </div>
            <div class="col-5 offset-4 menu">
                <nav class="nav">
                    <ul class="nav-inner">
                        <li><a class=" btn btn-secondary nav-item" href="{{route('pelanggan.register.index')}}" title="register">Register</a></li>
                        <li><a class=" btn btn-secondary nav-item" href="{{route('pelanggan.login.index')}}" title="login">Login</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>