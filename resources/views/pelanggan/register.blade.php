<x-auth-session-status class="mb-4" :status="session('status')" />

<!-- Validation Errors -->
<x-auth-validation-errors class="mb-4" :errors="$errors" />

<form method="POST" action="{{route('pelanggan.register.store')}}">
    @csrf
    <input placeholder="Name" type="text" placeholder="Nama" name="nama" value="{{old('nama')}}"><br><br>
    <input placeholder="Email" placeholder="Email" name="email" value="{{old('email')}}"><br><br>
    <input placeholder="Password" type="password" name="password"><br><br>
    <input placeholder="Confrim Password" type="password" name="password_confirmation"><br><br>
    <button type="submit">hahaha</button>
</form>