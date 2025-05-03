<?php

$servername = "localhost"; // Altere para o seu servidor MySQL
$username   = "noobcriativo"; // Seu nome de usuário do MySQL
$password   = "noobcriativo"; // Sua senha do MySQL
$dbname     = "estoque"; // O nome do seu banco de dados

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

?>
