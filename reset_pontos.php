<?php
session_start();
include 'conexao.php';

if (!isset($_SESSION['email'])) {
    http_response_code(401);
    echo json_encode(["erro" => "Usuário não autenticado"]);
    exit;
}

$email = $_SESSION['email'];
$tema  = $_POST['tema'] ?? '';

$stmt = $conn->prepare("DELETE FROM resultados_parciais WHERE email = ? AND tema = ?");
$stmt->bind_param("ss", $email, $tema);
$stmt->execute();

echo json_encode(["ok" => true, "msg" => "Pontuação resetada para $tema"]);
