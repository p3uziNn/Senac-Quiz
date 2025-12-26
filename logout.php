<?php
session_start(); // inicia a sessão

// remove todas as variáveis de sessão
$_SESSION = [];

// destrói a sessão
session_destroy();

// redireciona para a página de login
header("Location: index.php");
exit;
?>