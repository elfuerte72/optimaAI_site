<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ClientMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display the contact page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * Store a newly created contact in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Валидация данных
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'nullable|string',
        ]);
        
        // Добавляем источник запроса
        $validated['source'] = $request->input('source', 'contact_form');
        
        // Создаем новый контакт
        $contact = Contact::create($validated);
        
        // Создаем новое сообщение клиента (для админки)
        $clientMessage = ClientMessage::create($validated);
        
        // Если запрос AJAX, возвращаем JSON-ответ
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Спасибо за вашу заявку! Мы свяжемся с вами в ближайшее время.'
            ]);
        }
        
        // Редирект с сообщением об успехе
        return redirect()->route('contact.index')
            ->with('success', 'Спасибо за вашу заявку! Мы свяжемся с вами в ближайшее время.');
    }
}
