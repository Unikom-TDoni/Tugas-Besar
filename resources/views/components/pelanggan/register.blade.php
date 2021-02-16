<div class="register">
    <div class="logo">
        <img class="logo" src="{{URL::asset('assets/pelanggan')}}/img/logo.svg" alt="float">
    </div>
    <div class="form-title">
        <h2 class="h2 title">Register</h2>
        <a href="#" title="help" class="help">Help<i class="fas fa-question-circle"></i></a>
    </div>
    <form action="{{route('pelanggan.register.store')}}" class="register-form" method="POST">
        <x-auth-validation-errors class="mb-4" :errors="$errors"/>
        @csrf
        <div class="form-input emai f-body">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Enter your email" value="{{old('email')}}"/>
        </div>
        <div class="form-input password f-body">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter your password"/>
        </div>
        <div class="form-input confirm-password f-body">
            <label for="confirm-password">Password</label>
            <input type="password" name="password_confirmation" id="confirm-password" placeholder="Re-enter your password"/>
        </div>
        <div class="form-check tos-check f-body">
            <label for="tos-check" class="tos-check">
                <input type="checkbox" name="tos" id="tos-check"> I agree to <a href="#" title="Terms and Condition">Terms and Condition</a>
            </label>
        </div>
        <button class="btn btn-md btn-full btn-blue" type="submit">Register</button>
    </form>
    <div class="register-info">
        <span class="register-text">Has an account? <a href="{{route('pelanggan.login.index')}}" title="register">Login here</a></span>
        <p class="term f-meta-data">
            Use the application according to policy rules. Any kinds of violations will be subject to sanctions.
        </p>
    </div>
</div>