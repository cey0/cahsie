<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ url('css/site.css') }}">
    <title>Login</title>
</head>

<body>
    <div class="floating__container">
        <div class="floating__content">
            <h2 class="floating__header">Log-In</h2>
            <form action="/verify" class="floating__form" method="POST">
                @csrf
                <input type="text" name="username" id="username" class="floating_form_input"
                    placeholder="Username" value="{{ Session::get('username') }}">
                @error('username')
                    <p class="input__error">Username harus diisi</p>
                @enderror
                <input type="password" name="password" id="password" class="floating_form_input"
                    placeholder="Password">
                @error('password')
                    <p class="input__error">Password harus diisi</p>
                @enderror

                @if (session('error'))
                    <p class="input__error">Username / Password tidak valid</p>
                @endif
                <input type="submit" value="Log-In" class="floating_form_btn">
            </form>
        </div>
    </div>
</body>

</html>