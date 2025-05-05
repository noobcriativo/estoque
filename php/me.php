<?php
session_start();
header('Content-Type: application/json');
require_once 'conexao.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT username FROM tb_usuarios WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        echo json_encode(['username' => $row['username']]);
    } else {
        echo json_encode(['error' => 'Usuário não encontrado']);
    }
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['error' => 'Usuário não autenticado']);
}
?>
