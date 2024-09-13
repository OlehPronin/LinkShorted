<x-app-layout>
    <!-- Логотип -->
    <div class="header-left">
        <a href="{{ route('home') }}">
            <img src="{{ asset('images/icon.png') }}" alt="Logo" class="logo">
        </a>
    </div>

    <!-- Фон страницы -->
    <div class="background-container">
        <img src="{{ asset('images/fon.jpg') }}" alt="Фон" class="background-image">
    </div>

    <div class="container">
        <h2>Профиль</h2>

        <!-- Проверка на успешное обновление пароля -->
        @if (session('status') === 'password-updated')
            <div class="alert alert-success">
                {{ __('Пароль успешно обновлен.') }}
            </div>
        @endif

        <h3>Информация профиля</h3>
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <div class="form-field">
                <label for="name">Имя</label>
                <input id="name" type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required />
            </div>

            <div class="form-field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required />
            </div>

            <button type="submit">Сохранить</button>
        </form>

        <h3>Обновление пароля</h3>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('PUT')

            <div class="form-field">
                <label for="current_password">Текущий пароль</label>
                <input id="current_password" type="password" name="current_password" required />
            </div>

            <div class="form-field">
                <label for="password">Новый пароль</label>
                <input id="password" type="password" name="password" required />
            </div>

            <div class="form-field">
                <label for="password_confirmation">Подтвердите пароль</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required />
            </div>

            <button type="submit">Сохранить</button>
        </form>

        <!-- Кнопки выхода и на главную -->
        <div class="buttons">
            <a href="{{ url('/') }}" class="button home-button">На главную</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="button logout-button">Выйти</button>
            </form>
        </div>
    </div>
</x-app-layout>
