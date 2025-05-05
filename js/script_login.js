document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('login-form');
    const loginErrorDiv = document.getElementById('login-error');

    loginForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Impede o envio padrão do formulário

        const formData = new FormData(loginForm);

        fetch('php/processa_login.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = 'index.html'; // Redireciona em caso de sucesso
            } else {
                loginErrorDiv.textContent = data.message;
                loginErrorDiv.style.display = 'block';
            }
        })
        .catch(error => {
            console.error('Erro na requisição:', error);
            loginErrorDiv.textContent = 'Erro ao tentar fazer login.';
            loginErrorDiv.style.display = 'block';
        });
    });
});
