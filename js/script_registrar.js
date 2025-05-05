document.addEventListener('DOMContentLoaded', function() {
    const registrationForm = document.getElementById('registration-form');
    const registrationErrorDiv = document.getElementById('registration-error');
    const registrationSuccessDiv = document.getElementById('registration-success');

    registrationForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Impede o envio padrão do formulário

        const formData = new FormData(registrationForm);

        fetch('php/processa_registro.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                registrationSuccessDiv.textContent = data.message;
                registrationSuccessDiv.style.display = 'block';
                registrationErrorDiv.style.display = 'none';
                registrationForm.reset(); // Limpa o formulário após o sucesso
                setTimeout(() => {
                    window.location.href = 'login.html'; // Redireciona para o login após um tempo
                }, 2000);
            } else {
                registrationErrorDiv.textContent = data.message;
                registrationErrorDiv.style.display = 'block';
                registrationSuccessDiv.style.display = 'none';
            }
        })
        .catch(error => {
            console.error('Erro na requisição:', error);
            registrationErrorDiv.textContent = 'Erro ao tentar registrar.';
            registrationErrorDiv.style.display = 'block';
            registrationSuccessDiv.style.display = 'none';
        });
    });
});
