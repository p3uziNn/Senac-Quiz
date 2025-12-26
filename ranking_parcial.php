<?php
session_start();
include 'conexao.php';

$tema = $_GET['tema'] ?? '';

// soma dos pontos por jogador
$sql = "SELECT email, SUM(pontos) AS total_pontos
        FROM resultados_parciais
        WHERE tema = ?
        GROUP BY email
        ORDER BY total_pontos DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $tema);
$stmt->execute();
$res = $stmt->get_result();

$ranking = [];
$pos = 1;
while ($row = $res->fetch_assoc()) {
    $ranking[] = [
        "posicao" => $pos++,
        "jogador" => $row['email'],
        "pontos" => $row['total_pontos']
    ];
}

header('Content-Type: application/json');
echo json_encode($ranking);
