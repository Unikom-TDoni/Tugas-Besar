<x-auth-session-status class="mb-4" :status="session('status')" />

<!-- Validation Errors -->
<x-auth-validation-errors class="mb-4" :errors="$errors" />

<form method="POST" action="{{route('pelanggan.register.store')}}">
    @csrf
    <input placeholder="Name" type="text" name="nama" id="nama"><br><br>
    <input placeholder="Email" type="email" name="email" id="email"><br><br>
    <input placeholder="Password" type="password" name="password" id="password"><br><br>
    <button type="submit">Register</button>
</form>