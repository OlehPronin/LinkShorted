<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход в систему</title>
    @vite(['resources/css/login.css'])
</head>
<body>
    <!-- Логотип и кнопка на главную -->
    <div class="header-left">
        <a href="{{ route('home') }}">
            <img src="{{ asset('images/icon.png') }}" alt="Logo" class="logo">
        </a>
    </div>

    <!-- Контейнер для формы -->
    <div class="login-container">
        <h1>Вход в систему</h1>

        <form method="POST" action="{{ route('login') }}" class="login-form">
            @csrf

            <!-- Email Address -->
            <div class="form-field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" required autofocus autocomplete="username" placeholder="Введите ваш Email">
                <x-input-error :messages="$errors->get('email')" class="mt-2 error-message" />
            </div>

            <!-- Password -->
            <div class="form-field">
                <label for="password">Пароль</label>
                <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Введите ваш пароль">
                <x-input-error :messages="$errors->get('password')" class="mt-2 error-message" />
            </div>

            <!-- Remember Me -->
            <div class="form-field remember-me">
                <label for="remember_me" class="remember-label">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span class="remember-text">Запомнить меня</span>
                </label>
            </div>

            <!-- Forgot Password and Login Button -->
            <div class="buttons">
                @if (Route::has('password.request'))
                    <a class="forgot-password" href="{{ route('password.request') }}">
                        Забыли пароль?
                    </a>
                @endif
                <button type="submit" class="login-button">Войти</button>
            </div>
        </form>
    </div>
</body>
</html>
