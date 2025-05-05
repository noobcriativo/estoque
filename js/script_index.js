document.addEventListener('DOMContentLoaded', function() {
    const botaoSair = document.querySelector('.menu-sair a'); // Seleciona o link de sair

    if (botaoSair) {
        botaoSair.addEventListener('click', function(event) {
            event.preventDefault(); // Impede o comportamento padrão do link (navegar imediatamente)

            // Redireciona para a página de logout (que fará o processamento no servidor)
            window.location.href = 'php/logout.php';
        });
    }
});


document.addEventListener('DOMContentLoaded', function() {
    verificarAutenticacao();
});

function verificarAutenticacao() {
    fetch('php/check.php') // Endpoint para verificar a autenticação
        .then(response => response.json())
        .then(data => {
            if (data.authenticated) {
                // Usuário autenticado, buscar dados
                buscarDadosUsuario();
            } else {
                // Usuário não autenticado, redirecionar para login
                window.location.href = 'login.html';
            }
        })
        .catch(error => {
            console.error('Erro ao verificar autenticação:', error);
            // Lidar com o erro (ex: exibir mensagem ao usuário)
        });
}

function buscarDadosUsuario() {
    fetch('php/me.php') // Endpoint para buscar dados do usuário
        .then(response => response.json())
        .then(data => {
            if (data.username) {
                document.getElementById('nome-usuario').textContent = data.username;
                // Exibir outras informações do usuário, se necessário
                document.getElementById('main-content').style.display = 'block'; // Mostrar conteúdo principal
            } else {
                console.error('Erro ao buscar dados do usuário:', data.error);
                // Lidar com o erro (ex: exibir mensagem de erro ou redirecionar para login)
                window.location.href = 'login.html';
            }
        })
        .catch(error => {
            console.error('Erro ao buscar dados do usuário:', error);
            // Lidar com o erro
        });
}
