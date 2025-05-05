<?php

session_start();

// Limpar todas as variáveis de sessão
session_unset();

// Destruir a sessão
session_destroy();

// Limpar o cookie de sessão
setcookie(session_name(), '', time() - 3600, '/');

// Redirecionar para a página de login
header("Location: ../login.html");
exit();

?>
