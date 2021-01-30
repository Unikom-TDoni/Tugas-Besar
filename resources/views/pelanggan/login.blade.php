<x-auth-session-status class="mb-4" :status="session('status')" />

<!-- Validation Errors -->
<x-auth-validation-errors class="mb-4" :errors="$errors" />

<form method="POST" action="{{route('pelanggan.login.store')}}">
    @csrf
    <input placeholder="Email" type="email" name="email" id="email"><br><br>
    <input placeholder="Password" type="password" name="password" id="password"><br><br>
    <input type="checkbox" id="remember" name="remember"><br><br>
    <button type="submit">Login</button>
</form>