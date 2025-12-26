<?php
$host = "localhost";
$user = "root"; // seu usuário do MySQL
$pass = "";     // sua senha do MySQL
$db   = "quiz_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
