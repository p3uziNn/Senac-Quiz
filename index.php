<?php
session_start();
include("conexao.php");
if(!isset($_SESSION['usuario'])){
  header("Location: login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quiz Senac</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Botão quiz */
    .buttons {
      display: flex;
      grid-template-columns: repeat(2, minmax(180px, 1fr));
      gap: 18px;
      align-items: center;
      justify-items: center;
      margin-top: 30px;
      width: 100%;
      max-width: 720px;
    }
    .buttons .quiz-btn {
      background: linear-gradient(90deg,#1976d2 0%,#2196f3 100%) !important;
      color: #fff !important;
      border: none !important;
      border-radius: 16px;
      padding: 14px 22px;
      font-size: 1.05rem;
      font-weight: 700;
      box-shadow: 0 6px 18px rgba(25,118,210,0.15);
      cursor: pointer;
      width: 100%;
      max-width: 320px;
      text-align: center;
    }
    .buttons .quiz-btn:hover {
      transform: translateY(-4px);
      background: linear-gradient(90deg,#1565c0,#1976d2) !important;
    }

    /* Fundo com logo atrás */
    main { position: relative; z-index: 1; }
    main::before {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 260px;
      height: 260px;
      transform: translate(-50%, -50%);
      background-image: url('assets/senacquiz.png');
      background-repeat: no-repeat;
      background-position: center;
      background-size: contain;
      opacity: 0.06;
      pointer-events: none;
      z-index: 0;
    }
    main h1, .buttons { position: relative; z-index: 2; text-align: center; }
    header img { height: 46px; width: auto; }
    img { width: 400px; }

    @media (max-width: 600px) {
      .buttons { grid-template-columns: 1fr; padding: 0 20px; }
    }
  </style>
</head>
<body >

  <!-- HEADER -->
  <header class="flex justify-between items-center p-4  shadow-md relative">
    <!-- Logo -->
    <img src="assets/senacquiz.png" alt="Senac Quiz" class="h-12 w-auto">

    <!-- Navegação -->
    <nav class="flex items-center gap-4">
      <a href="index.php">🏠 Home</a>
      <a href="ranking.php">🏆 Ranking</a>
      <?php if ($logado): ?>
        <a href="logout.php">🚪 Sair</a>
      <?php else: ?>
        <a href="login.php">🔑 Login</a>
        <a href="cadastro.php">📝 Cadastrar</a>
      <?php endif; ?>
    </nav>

    <!-- Botão de música no canto direito -->
    <div class="ml-4">
      <button id="music-toggle" class="music-btn px-4 py-2 rounded-full font-bold shadow-md bg-gradient-to-r from-blue-600 to-blue-400 text-white hover:from-blue-700 hover:to-blue-500 transition">
        🔇 Música OFF
      </button>
    </div>
  </header>

  <!-- MAIN -->
  <main class="flex flex-col items-center mt-12">
    <h1 class="text-3xl font-bold mb-6">Escolha seu Quiz</h1>
    <img src="assets/senacquiz.png" alt="logo" class="mb-6">
    <div class="buttons">
      <button class="quiz-btn" onclick="startQuiz('geral')">Clique Aqui!</button>
    </div>
  </main>

  <!-- ÁUDIO DE FUNDO -->
  <audio id="bg-music" loop>
    <source src="audio/quiz_chill.mp3" type="audio/mpeg">
    Seu navegador não suporta áudio.
  </audio>

  <!-- FOOTER -->
  <footer class="text-center mt-12 mb-6">
    <p>Contato: <a href="mailto:contato@senacquiz.com">contato@senacquiz.com</a></p>
    <p>&copy; 2025 Quiz Senac - Todos os direitos reservados.</p>
  </footer>

  <!-- SCRIPT -->
  <script>
    const music = document.getElementById('bg-music');
    const toggle = document.getElementById('music-toggle');

    toggle.addEventListener('click', () => {
      if (music.paused) {
        music.play().then(() => {
          localStorage.setItem('playMusic','1');
          updateToggleText();
        }).catch(err => console.log('Erro ao tocar:', err));
      } else {
        music.pause();
        localStorage.setItem('playMusic','0');
        updateToggleText();
      }
    });

    function updateToggleText() {
      toggle.textContent = (music && !music.paused) ? '🔊 Música ON' : '🔇 Música OFF';
    }

    document.addEventListener('DOMContentLoaded', () => {
      if (localStorage.getItem('playMusic') === '1') {
        music.play().catch(err => console.log('Play bloqueado:', err));
      }
      updateToggleText();
    });

    function startQuiz(categoria) {
      window.location.href = 'quiz.php?categoria=' + encodeURIComponent(categoria);
    }
  </script>
</body>
</html>
