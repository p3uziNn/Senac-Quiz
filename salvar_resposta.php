<?php
session_start();
include 'conexao.php';

if (!isset($_SESSION['email'])) {
    http_response_code(401);
    echo json_encode(["erro" => "Usuário não autenticado"]);
    exit;
}

$email   = $_SESSION['email'];
$tema    = $_POST['tema'] ?? '';
$questao = $_POST['pergunta'] ?? ''; // agora guarda o texto da pergunta
$acerto  = (int)($_POST['correta'] ?? 0);
$tempo   = (int)($_POST['tempo'] ?? 0);

// fórmula dos pontos: 100 por acerto + bônus de velocidade (até 50 pontos se responder em 1s)
$pontos = 0;
if ($acerto) {
    $bonus  = max(0, 50 - $tempo);
    $pontos = 100 + $bonus;
}

// salvar no banco
$stmt = $conn->prepare("INSERT INTO resultados_parciais (email, tema, questao, acerto, tempo_resposta, pontos) 
                        VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssiii", $email, $tema, $questao, $acerto, $tempo, $pontos);
$stmt->execute();

// retorno JSON
echo json_encode([
    "ok"     => true,
    "pontos" => $pontos
]);