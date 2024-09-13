<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контакты</title>
    @vite(['resources/css/contact.css']) <!-- Подключаем стили -->
</head>
<body>
    <!-- Логотип и кнопка Контакты -->
    <div class="header-left">
        <a href="{{ route('home') }}">
            <img src="{{ asset('images/icon.png') }}" alt="Logo" class="logo">
        </a>
    </div>

    <h1>Контакты</h1>

    @if (auth()->check())
        <!-- Форма для авторизованных пользователей -->
        @if (session('status'))
            <p class="status-message">{{ session('status') }}</p>
        @endif
        <form action="{{ route('contact.send') }}" method="POST">
            @csrf
            <div class="form-field">
                <label for="email">Ваша почта для обратной связи</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-field">
                <label for="subject">Тема сообщения</label>
                <input type="text" id="subject" name="subject" required>
            </div>

            <div class="form-field">
                <label for="message">Сообщение</label>
                <textarea id="message" name="message" required></textarea>
            </div>

            <div class="buttons">
                <button type="submit">Отправить</button>
            </div>
        </form>
    @else
        <!-- Сообщение для неавторизованных пользователей -->
        <p class="not-auth-message">Авторизуйтесь для отправки сообщения или же напишите нам напрямую на нашу почту <a href="mailto:linkshorten.com">linkshorten.com</a></p>
    @endif

    <div class="buttons">
        <a href="{{ url('/') }}">На главную</a>
    </div>

    <!-- Подключаем фон через HTML -->
    <div class="background-container">
        <img src="{{ asset('images/fon.jpg') }}" alt="Фон" class="background-image">
    </div>
</body>
</html>
