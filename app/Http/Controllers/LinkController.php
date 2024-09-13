<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    public function create(Request $request)
    {
        // Если пользователь авторизован, показываем только его ссылки
        if (auth()->check()) {
            $links = Link::where('user_id', auth()->id())->get(); // Только свои ссылки
        } else {
            // Для гостей извлекаем идентификаторы ссылок из куки
            $guestLinks = json_decode($request->cookie('guest_links', '[]'), true);
            $links = Link::whereIn('id', $guestLinks)->get();
        }
    
        return view('link.create', compact('links'));
    }

    public function store(Request $request)
{
    // Валидация URL и пользовательского alias
    $request->validate([
        'original_url' => 'required|url',
        'custom_url' => 'required|alpha_num|unique:links,shortened_url'
    ]);

    // Используем пользовательский alias для сокращённой ссылки
    $shortened_url = $request->input('custom_url');

    if (auth()->check()) {
        // Сохранение ссылки в базу данных с привязкой к пользователю
        $link = Link::create([
            'original_url' => $request->input('original_url'),
            'shortened_url' => $shortened_url,
            'user_id' => auth()->id(),
        ]);
    } else {
        // Для гостей - сохраняем ссылку в базе данных без привязки к пользователю
        $link = Link::create([
            'original_url' => $request->input('original_url'),
            'shortened_url' => $shortened_url,
            'user_id' => null, // Устанавливаем null для гостей
        ]);

        // Добавляем ссылку в куки для гостей
        $guestLinks = json_decode($request->cookie('guest_links', '[]'), true);
        $guestLinks[] = $link->id;

        // Устанавливаем куки на 1 час
        return redirect()->back()->with('success', url('/') . '/' . $shortened_url)
            ->cookie('guest_links', json_encode($guestLinks), 60); // куки на 60 минут
    }

    // Создание полной сокращённой ссылки
    $full_shortened_url = url('/') . '/' . $shortened_url;

    // Возврат ответа с сокращенной ссылкой
    return redirect()->back()->with('success', $full_shortened_url);
}


    public function redirect($shortened_url)
    {
        // Поиск оригинальной ссылки по сокращенной
        $link = Link::where('shortened_url', $shortened_url)->firstOrFail();

        // Перенаправление на оригинальную ссылку
        return redirect($link->original_url);
    }

    public function destroy($id)
    {
        // Проверка, авторизован ли пользователь
        if (!auth()->check()) {
            return redirect()->back()->with('error', 'У вас нет прав на удаление ссылки.');
        }

        // Находим ссылку и проверяем, что она принадлежит пользователю
        $link = Link::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        // Удаляем ссылку
        $link->delete();

        return redirect()->back()->with('success', 'Ссылка успешно удалена.');
    }
}
