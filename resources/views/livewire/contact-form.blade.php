<div>
    <div class="contact-form-container">
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form wire:submit.prevent="submit" class="contact-form">
            <div class="mb-3">
                <label for="name" class="form-label">Ваше имя *</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model.live="name" placeholder="Введите ваше имя">
                </div>
                @error('name') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email *</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" wire:model.live="email" placeholder="Введите ваш email">
                </div>
                @error('email') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>
            
            <div class="mb-3">
                <label for="phone" class="form-label">Телефон *</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" wire:model.live="phone" placeholder="Введите ваш телефон">
                </div>
                @error('phone') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>
            
            <div class="mb-3">
                <label for="message" class="form-label">Сообщение</label>
                <textarea class="form-control @error('message') is-invalid @enderror" id="message" wire:model.live="message" rows="4" placeholder="Введите ваше сообщение"></textarea>
                @error('message') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>
            
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="privacyPolicy" required>
                <label class="form-check-label" for="privacyPolicy">
                    Я согласен с <a href="#" target="_blank">политикой конфиденциальности</a>
                </label>
            </div>
            
            <div class="text-end">
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                    <span wire:loading.remove>Отправить заявку</span>
                    <span wire:loading><i class="bi bi-arrow-repeat spinner"></i> Отправка...</span>
                </button>
            </div>
        </form>
    </div>

    <style>
        .contact-form-container {
            max-width: 100%;
        }
        
        .contact-form {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 2rem;
            box-shadow: var(--shadow-md);
            transition: var(--transition-normal);
        }
        
        .contact-form:hover {
            box-shadow: var(--shadow-lg);
        }
        
        .spinner {
            display: inline-block;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
    </style>
</div>
