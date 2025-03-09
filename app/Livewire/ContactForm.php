<?php

namespace App\Livewire;

use App\Models\ClientMessage;
use App\Models\Contact;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;

class ContactForm extends Component
{
    public $name = '';
    public $email = '';
    public $phone = '';
    public $message = '';
    public $source = 'livewire_form';
    
    public function mount($source = null)
    {
        if ($source) {
            $this->source = $source;
        }
    }
    
    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
        'message' => 'nullable|string',
    ];
    
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    
    public function submit()
    {
        $validated = $this->validate();
        $validated['source'] = $this->source;
        
        // Создаем новый контакт
        $contact = Contact::create($validated);
        
        // Создаем новое сообщение клиента
        $clientMessage = ClientMessage::create($validated);
        
        // Отправляем email с данными заявки
        try {
            Mail::raw("Новая заявка с сайта\n\nИмя: {$validated['name']}\nEmail: {$validated['email']}\nТелефон: {$validated['phone']}\nСообщение: {$validated['message']}\nИсточник: {$validated['source']}", function ($message) {
                $message->to('info@optimaai.ru')
                        ->subject('Новая заявка с сайта OptimaAI');
            });
        } catch (\Exception $e) {
            // Логируем ошибку, но не прерываем выполнение
            \Illuminate\Support\Facades\Log::error('Ошибка отправки email: ' . $e->getMessage());
        }
        
        // Очищаем форму
        $this->reset(['name', 'email', 'phone', 'message']);
        
        // Если это модальное окно, закрываем его
        if ($this->source === 'modal_form') {
            $this->dispatch('closeModal');
        }
        
        // Показываем сообщение об успехе
        session()->flash('message', 'Спасибо за вашу заявку! Мы свяжемся с вами в ближайшее время.');
    }
    
    public function render()
    {
        return view('livewire.contact-form');
    }
}
