<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сокращение ссылок</title>

    <!-- Подключение файла CSS -->
    @vite(['resources/css/shorten.css'])
</head>
<body>
    <!-- Фон -->
    <div class="background-container">
        <img src="{{ asset('images/fon.jpg') }}" alt="Фон" class="background-image">
    </div>

    <h1>Сократить ссылку</h1>

    <div class="container">
        @if(session('success'))
            <div class="result-field">
            </div>
        @endif

        <form action="{{ route('link.store') }}" method="POST">
            @csrf
            <div class="input-field">
                <label for="original_url">Введите оригинальную ссылку:</label>
                <input type="url" name="original_url" id="original_url" required>
            </div>

            <div class="input-field">
                <label for="custom_url">Введите желаемый короткий URL:</label>
                <input type="text" name="custom_url" id="custom_url" placeholder="Введите alias для вашей ссылки" required>
            </div>

            <button type="submit">Сократить</button>
        </form>

        <div class="buttons">
            <a href="{{ url('/') }}">На главную</a>
            <a href="{{ route('login') }}">Авторизация</a>
            <a href="{{ route('register') }}">Регистрация</a>
        </div>

        <h2>Ваши сокращенные ссылки</h2>

        @if($links->isEmpty())
            <p>У вас еще нет сокращенных ссылок.</p>
        @else
            @foreach($links as $link)
                <div class="result-field">
                    <p>
                        <strong>Оригинальная ссылка:</strong> {{ $link->original_url }}<br>
                        <strong>Сокращенная ссылка:</strong> <a href="{{ url($link->shortened_url) }}" target="_blank">{{ url($link->shortened_url) }}</a>
                    </p>
                </div>
            @endforeach
        @endif
    </div>
</body>
</html>
