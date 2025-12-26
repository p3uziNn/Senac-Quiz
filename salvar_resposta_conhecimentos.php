<?php
session_start();
include "conexao.php";

if (!isset($_SESSION['email'])) {
    http_response_code(401);
    echo "Usuário não logado.";
    exit;
}

$email     = $_SESSION['email'];
$tema      = $_POST['tema'] ?? 'conhecimentos';
$pergunta  = $_POST['pergunta'] ?? '';
$opcao     = intval($_POST['opcao'] ?? -1);
$correta   = intval($_POST['correta'] ?? 0);
$tempo     = intval($_POST['tempo'] ?? 0);

// pontos: 10 por acerto + bônus se responder rápido
$pontos = $correta ? max(1, 10 - intval($tempo / 3)) : 0;

$sql = "INSERT INTO respostas (email, tema, questao, resposta, acerto, pontos, tempo)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssiiii", $email, $tema, $pergunta, $opcao, $correta, $pontos, $tempo);

if ($stmt->execute()) {
    echo "Resposta salva com sucesso!";
} else {
    echo "Erro: " . $stmt->error;
}
?>
