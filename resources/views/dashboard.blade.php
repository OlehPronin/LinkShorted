<x-app-layout>
    <!-- Логотип -->
    <div class="header-left">
        <a href="{{ route('home') }}">
            <img src="{{ asset('images/icon.png') }}" alt="Logo" class="logo">
        </a>
    </div>
    
    <!-- Кнопка Выйти в правом верхнем углу -->
    <div class="header-right">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="button red-button">
                Выйти
            </button>
        </form>
    </div>

    <!-- Подключаем CSS -->
    @vite(['resources/css/dashboard.css'])

    <!-- Фон страницы -->
    <div class="background-container">
        <img src="{{ asset('images/fon.jpg') }}" alt="Фон" class="background-image">
    </div>

    <!-- Убираем блок с "Панелью управления" -->
    <!-- Блок контента -->
    <div class="py-12">
        <div class="container mx-auto sm:px-6 lg:px-8">
            <div class="dashboard-box p-6 text-white">
                {{ __("Вы вошли в систему!") }}

                <div class="mt-4 buttons">
                    <!-- Кнопки -->
                    <a href="{{ url('/') }}" class="button blue-button">
                        На главную
                    </a>

                    <a href="{{ route('profile.edit') }}" class="button green-button">
                        Профиль
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
