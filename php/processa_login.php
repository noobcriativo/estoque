<?php
session_start();
require_once 'conexao.php';

header('Content-Type: application/json'); // Define o tipo de conteúdo da resposta como JSON

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, username, password FROM tb_usuarios WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            echo json_encode(['success' => true]);
            exit();
        } else {
            echo json_encode(['success' => false, 'message' => 'Usuário ou senha inválidos.']);
            exit();
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Usuário ou senha inválidos.']);
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Acesso inválido.']);
    exit();
}
?>
