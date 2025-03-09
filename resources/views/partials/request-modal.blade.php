<div class="modal fade" id="requestModal" tabindex="-1" aria-labelledby="requestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="requestModalLabel">Оставить заявку</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="requestForm" action="{{ route('submit-form') }}" method="POST">
                    @csrf
                    <input type="hidden" name="source" value="modal_form">
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Ваше имя *</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="phone" class="form-label">Телефон *</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="message" class="form-label">Сообщение</label>
                        <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                    </div>
                    
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="privacyPolicy" required>
                        <label class="form-check-label" for="privacyPolicy">
                            Я согласен с <a href="#" target="_blank">политикой конфиденциальности</a>
                        </label>
                    </div>
                    
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Отправить заявку</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const requestForm = document.getElementById('requestForm');
        
        if (requestForm) {
            requestForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Очищаем форму
                        requestForm.reset();
                        
                        // Закрываем модальное окно
                        const modal = bootstrap.Modal.getInstance(document.getElementById('requestModal'));
                        modal.hide();
                        
                        // Показываем сообщение об успехе
                        alert(data.message);
                    } else {
                        // Показываем ошибки
                        console.error(data.errors);
                        alert('Произошла ошибка при отправке формы. Пожалуйста, проверьте введенные данные.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Произошла ошибка при отправке формы. Пожалуйста, попробуйте позже.');
                });
            });
        }
    });
</script>
@endpush 