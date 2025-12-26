<?php
session_start();
$logado = isset($_SESSION['email']); // define a variável
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Quiz Interativo</title>
<link rel="stylesheet" href="seu-estilo.css">
<style>
  .hidden { display: none; }
  .fade {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.3s, transform 0.3s;
  }
  .fade.show {
    opacity: 1;
    transform: translateY(0);
  }
  body {
  margin: 0;
  padding: 0;
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  background: linear-gradient(180deg, #0f2027, #172c42, #23314b);
  color: #e0e6ed;
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
}

/* === CONTAINER === */
.quiz-container {
  background-color: #23314b;
  padding: 30px 25px;
  border-radius: 16px;
  border: 2px solid #ffffff;
  max-width: 600px;
  width: 100%;
  text-align: center;
  box-shadow: 0 8px 25px rgba(0,0,0,0.5);
  animation: fadeIn 0.5s ease-in-out;
}

.quiz-container h1 {
  margin-bottom: 20px;
  font-size: 26px;
  color: #ff8500;
}

.quiz-container h2 {
  margin-bottom: 15px;
  font-size: 20px;
}

/* === BOTÕES === */
button {
  display: block;
  width: 100%;
  margin: 8px 0;
  padding: 12px;
  border: none;
  border-radius: 8px;
  background-color: #0077b6;
  color: #fff;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
  transition: all 0.3s ease;
}

button:hover {
  background-color: #0096c7;
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(0,0,0,0.4);
}

button:active {
  transform: scale(0.98);
}

/* === TEXTO DE STATUS === */
#timer, #progress {
  margin-top: 10px;
  font-size: 15px;
  font-weight: bold;
  color: #90e0ef;
}
  /* HEADER */
  header {
    background-color: #23314b;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    border-bottom: 2px solid #ffffff;
    position: relative;
  }

  header img {
    height: 50px;
    background-color: rgb(183, 214, 255);
    border-radius: 50px;
  }

  nav {
    display: flex;
    gap: 20px;
  }

  nav a {
    color: #e0e6ed;
    text-decoration: none;
    font-weight: bold;
    transition: 0.3s;
  }

  nav a:hover {
    color: #90e0ef;
  }

/* === ANIMAÇÕES === */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(15px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>
</head>
<body>
<div class="quiz-container">
  <h1>Quiz Interativo</h1>
  <div class="header-controls">
    <button id="music-toggle" class="music-btn" onclick="toggleMusic()">🔇 Música ON/OFF</button>
  </div>
  <header>
    <img src="assets/senacquiz.png" alt="Senac Quiz">

    <!-- Botão hambúrguer -->
    <div class="menu-toggle" onclick="document.querySelector('nav').classList.toggle('show')">
      <span></span>
      <span></span>
      <span></span>
    </div>
    
    <!-- Menu -->
    <nav>
      <a href="index.php">🏠 Home</a>
      <a href="ranking.php">🏆 Ranking</a>
      <?php if ($logado): ?>
        <a href="logout.php">🚪 Sair</a>
      <?php else: ?>
        <a href="login.php">🔑 Login</a>
        <a href="cadastro.html  ">📝 Cadastrar</a>
      <?php endif; ?>
    </nav>
  </header>

  <!-- Seleção de categoria -->
  <div id="category-screen" class="fade show">
    <h2>Escolha uma categoria</h2>
    <button onclick="startQuiz('gerais')">Conhecimentos Gerais</button>
    <button onclick="startQuiz('informatica')">Informática</button>
    <button onclick="startQuiz('administracao')">Administração</button>
    <button onclick="startQuiz('seguranca')">Segurança do Trabalho</button>
  </div>

  <!-- Área do quiz -->
  <div id="quiz-screen" class="hidden fade">
    <h2 id="question"></h2>
    <div id="options"></div>
    <p id="timer">Tempo: 30</p>
    <p id="progress">Questão 1/15</p>
  </div>

  <!-- Resultado final -->
  <div id="result-screen" class="hidden fade">
    <h2>Fim do Quiz!</h2>
    <p id="final-score"></p>
    <a href="index.php"><button onclick="resetQuiz()">Voltar ao início</button></a>
  </div>
</div>
  <!-- ÁUDIO DE FUNDO -->
  <audio id="bg-music" loop>
    <source src="audio/quiz_chill.mp3" type="audio/mpeg">
    Seu navegador não suporta áudio.
  </audio>

<script>
const questions = {
  gerais: [
    { question: "Qual a capital do Brasil?", options: ["Rio de Janeiro","Brasília","São Paulo","Salvador"], answer: 1 },
    { question: "Quantos estados tem o Brasil?", options: ["26","27","25","28"], answer: 0 },
    { question: "Quem descobriu o Brasil em 1500?", options: ["Pedro Álvares Cabral","Dom Pedro I","Cristóvão Colombo","Vasco da Gama"], answer: 0 },
    { question: "Qual é o maior planeta do sistema solar?", options: ["Terra","Marte","Júpiter","Saturno"], answer: 2 },
    { question: "Qual é o país mais populoso do mundo?", options: ["Índia","EUA","China","Rússia"], answer: 0 },
    { question: "Em que continente fica o Egito?", options: ["África","Ásia","Europa","América"], answer: 0 },
    { question: "Quem pintou a Mona Lisa?", options: ["Michelangelo","Da Vinci","Van Gogh","Picasso"], answer: 1 },
    { question: "Quantos lados tem um hexágono?", options: ["5","6","7","8"], answer: 1 },
    { question: "Qual é o idioma oficial da Argentina?", options: ["Português","Espanhol","Italiano","Inglês"], answer: 1 },
    { question: "Quem escreveu 'Dom Quixote'?", options: ["Machado de Assis","José Saramago","Miguel de Cervantes","Camões"], answer: 2 },
    { question: "Qual é o elemento químico do símbolo O?", options: ["Ouro","Oxigênio","Ósmio","Óxido"], answer: 1 },
    { question: "Qual oceano banha o litoral brasileiro?", options: ["Pacífico","Atlântico","Índico","Ártico"], answer: 1 },
    { question: "Qual o esporte de Pelé?", options: ["Basquete","Vôlei","Futebol","Tênis"], answer: 2 },
    { question: "Quem foi o primeiro homem a pisar na Lua?", options: ["Neil Armstrong","Buzz Aldrin","Yuri Gagarin","John Glenn"], answer: 0 },
    { question: "Em que continente fica a França?", options: ["América","Ásia","Europa","Oceania"], answer: 2 }
  ],
  informatica: [
    { question: "O que significa HTML?", options: ["HyperText Markup Language","Hyper Tool Multi Language","HighText Machine Language","Nenhuma"], answer: 0 },
    { question: "Qual empresa criou o Windows?", options: ["Apple","IBM","Microsoft","Google"], answer: 2 },
    { question: "O que é RAM?", options: ["Memória de leitura","Memória de acesso aleatório","Armazenamento em disco","Rede de acesso"], answer: 1 },
    { question: "O que é CPU?", options: ["Unidade Central de Processamento","Unidade de Memória","Fonte de Energia","Placa de Vídeo"], answer: 0 },
    { question: "O que significa URL?", options: ["User Random Line","Uniform Resource Locator","Universal Research List","Nenhuma"], answer: 1 },
    { question: "O que é um algoritmo?", options: ["Sequência de passos","Memória do PC","Linguagem de programação","Erro de sistema"], answer: 0 },
    { question: "O que é JavaScript?", options: ["Sistema Operacional","Banco de Dados","Linguagem de Programação","Editor de Texto"], answer: 2 },
    { question: "Qual extensão é usada para arquivos do Word?", options: [".xls",".docx",".ppt",".txt"], answer: 1 },
    { question: "Qual empresa criou o iPhone?", options: ["Samsung","Microsoft","Apple","Nokia"], answer: 2 },
    { question: "O que é um IP?", options: ["Endereço de Rede","Protocolo de Internet","Cabo de rede","Tipo de software"], answer: 1 },
    { question: "O que é phishing?", options: ["Vírus de computador","Ataque de roubo de dados","Software pago","Firewall"], answer: 1 },
    { question: "O que significa Wi-Fi?", options: ["Wireless Fidelity","Wired Function","Wide Field","Nenhuma"], answer: 0 },
    { question: "O que é Linux?", options: ["Antivírus","Sistema Operacional","Navegador","Banco de Dados"], answer: 1 },
    { question: "Qual linguagem é usada para bancos de dados?", options: ["SQL","Python","C++","HTML"], answer: 0 },
    { question: "O que é cloud computing?", options: ["Computação em nuvem","Computador rápido","Rede sem fio","Armazenamento em HD"], answer: 0 }
  ],
  administracao: [
    { question: "Quem é considerado o pai da Administração Científica?", options: ["Taylor","Fayol","Weber","Drucker"], answer: 0 },
    { question: "Qual a função do planejamento?", options: ["Definir metas e ações","Executar tarefas","Controlar recursos","Avaliar desempenho"], answer: 0 },
    { question: "Qual é uma função administrativa segundo Fayol?", options: ["Organizar","Programar","Inventar","Empreender"], answer: 0 },
    { question: "O que é liderança?", options: ["Capacidade de influenciar pessoas","Fazer relatórios","Controlar máquinas","Criar regras"], answer: 0 },
    { question: "Qual a principal função do RH?", options: ["Gerenciar pessoas","Gerenciar máquinas","Vender produtos","Controlar estoques"], answer: 0 },
    { question: "O que é missão de uma empresa?", options: ["Razão de existir","Plano financeiro","Regra de conduta","Organograma"], answer: 0 },
    { question: "Quem criou a Teoria da Burocracia?", options: ["Max Weber","Taylor","Maslow","Drucker"], answer: 0 },
    { question: "Qual é a pirâmide de Maslow?", options: ["Necessidades Humanas","Organograma","Fluxograma","Marketing"], answer: 0 },
    { question: "O que é organograma?", options: ["Estrutura organizacional","Plano de vendas","Estratégia de marketing","Controle de estoque"], answer: 0 },
    { question: "Qual documento define a visão da empresa?", options: ["Plano Estratégico","Missão","Estatuto","Fluxograma"], answer: 0 },
    { question: "O que é SWOT?", options: ["Análise estratégica","Imposto","Software","Plano contábil"], answer: 0 },
    { question: "O que é controle administrativo?", options: ["Acompanhar resultados","Planejar vendas","Organizar pessoas","Produzir relatórios"], answer: 0 },
    { question: "Quem popularizou a administração por objetivos (APO)?", options: ["Peter Drucker","Taylor","Weber","Fayol"], answer: 0 },
    { question: "O que é um KPI?", options: ["Indicador de desempenho","Plano financeiro","Contrato","Regra trabalhista"], answer: 0 },
    { question: "Qual é o foco da gestão de qualidade?", options: ["Satisfação do cliente","Reduzir custos","Aumentar produção","Diminuir pessoal"], answer: 0 }
  ],
  seguranca: [
    { question: "Qual a cor do capacete de segurança para engenheiros?", options: ["Branco","Azul","Amarelo","Verde"], answer: 0 },
    { question: "O que significa EPI?", options: ["Equipamento de Proteção Individual","Equipe de Prevenção Interna","Esquema de Proteção Industrial","Nenhuma"], answer: 0 },
    { question: "O que é CIPA?", options: ["Comissão Interna de Prevenção de Acidentes","Certificado Internacional de Proteção Ambiental","Controle Interno de Produtos","Nenhuma"], answer: 0 },
    { question: "Qual é a sigla de Norma Regulamentadora?", options: ["NR","NBR","ISO","ABNT"], answer: 0 },
    { question: "Qual a cor do extintor de água?", options: ["Vermelho com faixa verde","Vermelho com faixa preta","Vermelho com faixa azul","Vermelho com faixa cinza"], answer: 1 },
    { question: "Qual extintor é indicado para incêndios elétricos?", options: ["Água","CO2","Espuma","Pó químico"], answer: 1 },
    { question: "Qual a sigla de Programa de Controle Médico de Saúde Ocupacional?", options: ["PCMSO","PPRA","CIPA","PGR"], answer: 0 },
    { question: "Qual é a sigla de Programa de Prevenção de Riscos Ambientais?", options: ["PPRA","PCMSO","NR","CIPA"], answer: 0 },
    { question: "Qual é a cor da faixa no extintor de CO2?", options: ["Preta","Azul","Verde","Amarela"], answer: 0 },
    { question: "Qual órgão fiscaliza as NRs?", options: ["Ministério do Trabalho","INSS","ANVISA","Prefeitura"], answer: 0 },
    { question: "Qual o tempo mínimo de pausa para trabalhadores em jornada acima de 6h?", options: ["30 minutos","15 minutos","1 hora","45 minutos"], answer: 2 },
    { question: "Qual a principal função do PPRA?", options: ["Prevenção de riscos ambientais","Controle financeiro","Gestão de pessoal","Plano de marketing"], answer: 0 },
    { question: "O que é LTCAT?", options: ["Laudo Técnico das Condições Ambientais de Trabalho","Lista de Controle de Acidentes de Trabalho","Lei Trabalhista de Condições Ambientais","Nenhuma"], answer: 0 },
    { question: "Qual EPI é usado para proteção auditiva?", options: ["Protetor auricular","Óculos de segurança","Luvas","Capacete"], answer: 0 },
    { question: "Qual NR trata sobre ergonomia?", options: ["NR-17","NR-12","NR-10","NR-5"], answer: 0 }
  ]
};

let currentCategory = null;
let currentQuestionIndex = 0;
let score = 0;
let timer;
let timeLeft = 30;

function showScreen(screenId) {
  ["category-screen", "quiz-screen", "result-screen"].forEach(id => {
    const el = document.getElementById(id);
    el.classList.add("hidden");
    el.classList.remove("show"); // tira o show de quem não está ativo
  });

  const target = document.getElementById(screenId);
  target.classList.remove("hidden");
  target.classList.add("show"); // garante visível (fade.show)
}
function startQuiz(category) {
  currentCategory = category;
  currentQuestionIndex = 0;
  score = 0;
  showScreen('quiz-screen');
  showQuestion();
}

function showQuestion() {
  const q = questions[currentCategory][currentQuestionIndex];
  document.getElementById("question").textContent = q.question;
  const optionsDiv = document.getElementById("options");
  optionsDiv.innerHTML = "";
  q.options.forEach((opt, i) => {
    const btn = document.createElement("button");
    btn.textContent = opt;
    btn.onclick = () => checkAnswer(i);
    optionsDiv.appendChild(btn);
  });
  document.getElementById("progress").textContent = `Questão ${currentQuestionIndex+1}/15`;
  startTimer();
}

function startTimer() {
  timeLeft = 30;
  document.getElementById("timer").textContent = `Tempo: ${timeLeft}`;
  clearInterval(timer);
  timer = setInterval(() => {
    timeLeft--;
    document.getElementById("timer").textContent = `Tempo: ${timeLeft}`;
    if(timeLeft <=0){
      clearInterval(timer);
      nextQuestion();
    }
  },1000);
}

function checkAnswer(selected) {
  clearInterval(timer);
  if(selected === questions[currentCategory][currentQuestionIndex].answer){
    score++;
  }
  nextQuestion();
}

function nextQuestion() {
  currentQuestionIndex++;
  if(currentQuestionIndex < 15){
    showQuestion();
  } else {
    finishQuiz();
  }
}

function finishQuiz() {
  showScreen('result-screen');
  document.getElementById("final-score").textContent = `Você finalizou o quiz! Acertou ${score} de 15.`;
}

function resetQuiz() {
  showScreen('category-screen');
}
function toggleMusic() {
      const music = document.getElementById('bg-music');
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
    }
</script>
</body>
</html>
