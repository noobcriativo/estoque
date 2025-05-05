<?php

    $servername = "localhost"; // Altere para o seu servidor MySQL
    $username   = "noobcriativo"; // Seu nome de usuário do MySQL
    $password   = "noobcriativo"; // Sua senha do MySQL
    $dbname     = "estoque"; // O nome do seu banco de dados

    $conn = null; // Inicializa a variável de conexão

    try {
        
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        
        // Defina o modo de erro do PDO para exceções
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Definir o modo de fetch padrão para objetos
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    } catch (PDOException $e) {
        
        // Em caso de erro na conexão, exibe a mensagem
        echo "Erro na conexão com o banco de dados: " . $e->getMessage();
        
        // É importante logar esse erro em um ambiente de produção
        die(); // Encerra a execução do script
    }

?>
