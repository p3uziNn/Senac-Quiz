<?php
session_start();

// Ranking fictício
$jogadores = [
  ["Willow", "Técnico Informática", 10, 35, 1000, "2025-09-01 14:00:00"],
  ["Pedro", "Administração", 10, 42, 980, "2025-09-02 10:20:00"],
  ["Pietro Henry", "Conhecimentos Gerais", 10, 45, 970, "2025-09-03 11:15:00"],
  ["Lucas", "Técnico em Segurança", 10, 48, 960, "2025-09-04 16:45:00"],
  ["Daniel", "Informática", 10, 50, 950, "2025-09-05 09:30:00"],
  ["Pietro Rios", "Administração", 10, 52, 940, "2025-09-05 19:20:00"],
  ["Mariana", "Conhecimentos Gerais", 10, 55, 930, "2025-09-06 14:10:00"],
  ["Ana", "Informática", 10, 58, 920, "2025-09-06 15:50:00"],
  ["João du grau", "Técnico em  sexologia", 10, 60, 910, "2025-09-07 08:40:00"],
  ["Rafael", "Administração", 10, 63, 900, "2025-09-07 17:35:00"],
  ["Carla", "Conhecimentos Gerais", 10, 65, 890, "2025-09-08 12:25:00"],
  ["Gabriel", "Informática", 10, 68, 880, "2025-09-08 18:55:00"],
  ["Juliana", "Administração", 10, 70, 870, "2025-09-08 19:40:00"],
  ["Beatriz", "Conhecimentos Gerais", 10, 72, 860, "2025-09-08 20:15:00"],
  ["Thiago", "Técnico em Segurança", 10, 75, 850, "2025-09-08 21:00:00"]
];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Ranking - Quiz Senac</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      background-color: #172c42;
      color: #e0e6ed;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    header, footer {
      background-color: #23314b;
      padding: 15px 20px;
      border-bottom: 2px solid #ffffff;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    header img {
      height: 50px;
    }

    nav {
      display: flex;
      gap: 20px;
    }

    nav a {
      color: #e0e6ed;
      text-decoration: none;
      font-weight: bold;
    }

    nav a:hover {
      color: #90e0ef;
    }

    main {
      flex: 1;
      padding: 40px 20px;
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: #23314b;
      border-radius: 10px;
      overflow: hidden;
    }

    th, td {
      padding: 12px;
      text-align: center;
    }

    th {
      background: #0077b6;
      color: #fff;
    }

    tr:nth-child(even) {
      background: #1e3a5f;
    }

    tr:hover {
      background: #0096c7;
    }

    footer {
      border-top: 2px solid #ffffff;
      text-align: center;
      font-size: 14px;
      flex-shrink: 0;
    }

    @media (max-width: 768px) {
      table, th, td {
        font-size: 14px;
      }
      nav {
        flex-wrap: wrap;
      }
    }
  </style>
</head>
<body>

  <!-- HEADER -->
  <header>
    <img src="assets/senacquiz.png" alt="Senac Quiz">
    <nav>
      <a href="index.php">🏠 Home</a>
      <a href="ranking.php">🏆 Ranking</a>
      <?php if (isset($_SESSION['email'])): ?>
        <a href="logout.php">🚪 Sair</a>
      <?php else: ?>
        <a href="login.php">🔑 Login</a>
        <a href="cadastro.php">📝 Cadastrar</a>
      <?php endif; ?>
    </nav>
  </header>

  <!-- MAIN -->
  <main>
    <h1>🏆 Ranking dos Jogadores</h1>
    <table>
      <tr>
        <th>Posição</th>
        <th>Jogador</th>
        <th>Tema</th>
        <th>Acertos</th>
        <th>Tempo (s)</th>
        <th>Pontos</th>
        <th>Data</th>
      </tr>
      <?php foreach ($jogadores as $pos => $j): ?>
      <tr>
        <td><?= $pos + 1 ?></td>
        <td><?= htmlspecialchars($j[0]) ?></td>
        <td><?= htmlspecialchars($j[1]) ?></td>
        <td><?= $j[2] ?></td>
        <td><?= $j[3] ?></td>
        <td><strong><?= $j[4] ?></strong></td>
        <td><?= date('d/m/Y H:i', strtotime($j[5])) ?></td>
      </tr>
      <?php endforeach; ?>
    </table>
  </main>

  <!-- FOOTER -->
  <footer>
    <p>Contato: <a href="mailto:contato@senacquiz.com">contato@senacquiz.com</a></p>
    <p>&copy; 2025 Quiz Senac - Todos os direitos reservados.</p>
  </footer>

</body>
</html>
