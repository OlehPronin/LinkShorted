<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница</title>
    @vite(['resources/css/app.css']) <!-- Подключаем только CSS -->
</head>
<body>
    <!-- Логотип и кнопка Контакты -->
    <div class="header-left">
        <a href="{{ route('home') }}">
            <img src="{{ asset('images/icon.png') }}" alt="Logo" class="logo">
        </a>
        <a href="{{ route('contact') }}" class="contact-button">Контакты</a>
    </div>

    <!-- Кнопки Авторизация, Регистрация и Профиль (если авторизован) справа -->
    <div class="header-right">
        @guest
            <a href="{{ route('login') }}" class="auth-button">Авторизация</a>
            <a href="{{ route('register') }}" class="auth-button">Регистрация</a>
        @endguest
        @auth
            <a href="{{ route('profile') }}" class="auth-button">Профиль</a> <!-- Ссылка на профиль -->
            <a href="{{ route('logout') }}" class="auth-button"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Выйти
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @endauth
    </div>

    <!-- Контент с кнопкой Сократить ссылку по центру -->
    <div class="container">
        <h1>Добро пожаловать на сервис сокращения ссылок</h1>
        <p>
            @auth
                Здравствуйте, {{ Auth::user()->name }}!
            @else
                Здравствуйте, Гость!
            @endauth
        </p>
        <p>Здесь вы можете сократить свои ссылки легко и быстро.</p>
        <a href="{{ route('link.shorten') }}" class="center-button">Сократить ссылку</a>
    </div>

    <!-- Подключаем фон через HTML -->
    <div class="background-container">
        <img src="{{ asset('images/fon.jpg') }}" alt="Фон" class="background-image">
    </div>
</body>
</html>
