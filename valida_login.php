<?php
session_start();
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $senha = $_POST['senha'];

    $sql = "SELECT id, nome, email, senha FROM usuarios WHERE email = '$email' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($senha, $user['senha'])) {
            $_SESSION['id']   = $user['id'];
            $_SESSION['nome'] = $user['nome'];
            $_SESSION['email'] = $user['email'];

            header("Location: index.php"); // ou quiz.php
            exit();
        } else {
            header("Location: erro.html");
            exit();
        }
    } else {
        header("Location: erro.html");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
