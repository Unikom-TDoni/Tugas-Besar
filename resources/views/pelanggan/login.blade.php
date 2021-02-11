<x-auth-session-status class="mb-4" :status="session('status')" />

<!-- Validation Errors -->
<x-auth-validation-errors class="mb-4" :errors="$errors" />

<form method="POST" action="{{route('pelanggan.login.store')}}">
    @csrf
    <input placeholder="Email" name="email" value="{{old('email')}}"><br><br>
    <input placeholder="Password" type="password" name="password"><br><br>
    <label><input type="checkbox" name="remember">Remember Me</label><br><br>
    <button type="submit">Login</button>
</form>

<a href="{{route("pelanggan.register.index")}}">
    <button>Register</button>
</a>