<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toko Online</title>
</head>
<body>
    <h3>{{ $judul }}</h3>
    <!-- error -->
    @if (session()->has('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <strong>{{ session('error') }}</strong>
        </button>
    </div>
    @endif
    <!-- errorEnd -->

    <form action="{{ route('backend.login') }}" method="post">
        @csrf
        <label for="email">User</label><br>
        <input type="text" name="email" id="email" value="{{ old('email') }}" class="form-control @error('email')
            is-invalid
        @enderror" placeholder="Masukkan Email">
        @error('email')
            <span class="invalid-feedback alert-danger" role="alert">
                {{ $message }}
            </span>
        @enderror
        <p></p>
        <label for="password">Password</label><br>
        <input type="password" name="password" id="password" value="{{ old('password') }}" class="form-control @error('password')
            is-invalid
        @enderror" placeholder="Masukkan Password">
        @error('password')
            <span class="invalid-feedback alert-danger" role="alert">
                {{ $message }}
            </span>
        @enderror
        <p></p>

        <button type="submit">Login</button>
    </form>
</body>
</html>