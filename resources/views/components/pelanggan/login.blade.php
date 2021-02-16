<div class="login">
    <div class="logo">
        <img class="logo" src="{{URL::asset('assets/pelanggan')}}/img/logo.svg" alt="float">
    </div>
    <div class="form-title">
        <h2 class="h2 title">Login</h2>
        <a href="#" title="help" class="help">Help<i class="fas fa-question-circle"></i></a>
    </div>
    <form action="#" class="login-form" method="POST">
        <div class="form-input emai f-body">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Enter your email"/>
        </div>
        <div class="form-input password f-body">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter your password"/>
        </div>
        <div class="form-check rememberme f-body">
            <label for="rememberme" class="rememberme">
                <input type="checkbox" name="rememberme" id="rememberme"> Remember Me
            </label>
        </div>
        <a class="btn btn-md btn-full btn-blue" type="submit">Login</a>
    </form>
    <div class="login-info">
        <span class="register-text">Doesn’t has any account? <a href="#" title="register">Register here</a></span>
        <p class="term f-meta-data">
            Use the application according to policy rules. Any kinds of violations will be subject to sanctions.
        </p>
    </div>
</div>