<?php
require_once 'conexao.php';
header('Content-Type: application/json'); // Define o tipo de conteúdo da resposta como JSON

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        echo json_encode(['success' => false, 'message' => 'As senhas não coincidem.']);
        exit();
    }

    $stmt_check = $conn->prepare("SELECT username FROM tb_usuarios WHERE username = ?");
    $stmt_check->bind_param("s", $new_username);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'Este usuário já está cadastrado.']);
        exit();
    }

    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    $stmt_insert = $conn->prepare("INSERT INTO tb_usuarios (username, password) VALUES (?, ?)");
    $stmt_insert->bind_param("ss", $new_username, $hashed_password);

    if ($stmt_insert->execute()) {
        echo json_encode(['success' => true, 'message' => 'Registro realizado com sucesso! Redirecionando para o login...']);
        exit();
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao registrar o usuário.']);
        exit();
    }

    $stmt_check->close();
    $stmt_insert->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Acesso inválido.']);
    exit();
}
?>
