<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        // Валидация входных данных
        $request->validate([
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Настройка PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Настройки SMTP
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io'; // Укажи SMTP-сервер
            $mail->SMTPAuth = true;
            $mail->Username = '8ddee9345429c0'; // Твой email
            $mail->Password = '603d523a648eb7'; // Твой пароль от почты
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Настройки отправки
            $mail->setFrom('egoregorov20232@gmail.com', 'Link Shorten Service');
            $mail->addAddress('olegpronin1998@gmail.com', 'Admin'); // Email получателя

            // Настройки сообщения
            $mail->isHTML(true);
            $mail->Subject = $request->subject;
            $mail->Body    = 'Почта для обратной связи: ' . $request->email . '<br>Сообщение: ' . $request->message;

            // Отправка письма
            $mail->send();

            return redirect()->back()->with('status', 'Сообщение отправлено!');
        } catch (Exception $e) {
            return redirect()->back()->with('status', 'Ошибка при отправке: ' . $mail->ErrorInfo);
        }
    }
}
