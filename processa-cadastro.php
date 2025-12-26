<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "quiz_db";

$conn = new mysqli($host, $user, $pass, $db);
include 'db.php';

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recebe e "escapa" os dados
    $nome  = $conn->real_escape_string($_POST['nome']);
    $email = $conn->real_escape_string($_POST['email']);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // criptografa a senha

    // Verifica se já existe usuário com o mesmo email
    $check = $conn->query("SELECT id FROM usuarios WHERE email = '$email'");
    if ($check->num_rows > 0) {
        // Redireciona para a página de erro
        header("Location: erro.html");
        exit;
    }

    // Insere no banco
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
    if ($conn->query($sql) === TRUE) {
        header("Location: sucesso.html");
        exit;
    } else {
        header("Location: erro.html");
        exit;
    }
} else {
    // Se acessar direto o arquivo sem POST
    header("Location: cadastro.php");
    exit;
}
?>