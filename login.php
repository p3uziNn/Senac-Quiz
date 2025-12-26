<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Login - Quiz Senac</title>
  <style>
body {
  margin: 0;
  padding: 0;
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  background-color: #172c42; /* fundo principal */
  color: #e0e6ed;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 15px; /* margem extra para telas pequenas */
}

.login-container {
  background-color: #23314b; /* fundo do card */
  padding: 30px 25px;
  border-radius: 16px;
  border: 2px solid #ffffff;
  max-width: 380px;
  width: 100%;
  color: #e0e6ed;
  text-align: center;
  box-shadow: 0 8px 20px rgba(0,0,0,0.5);
  display: flex;
  flex-direction: column;
  align-items: center;
}

.login-container img {
  width: 100px;
  height: auto;
  margin-bottom: 20px;
}

form {
  width: 100%;
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.form-group {
  width: 100%;
}

.form-group input {
  width: 100%;
  padding: 12px;
  border-radius: 8px;
  border: 1px solid #415a77;
  background-color: #152a41;
  color: #e0e6ed;
  font-size: 15px;
  box-sizing: border-box;
}

.form-group input::placeholder {
  color: #a9bcd0;
}

.form-group input:focus {
  background-color: #1b263b;
  border-color: #778da9;
  color: #e0e6ed;
  box-shadow: 0 0 0 0.25rem rgba(119, 141, 169, 0.25);
  outline: none;
}

.form-group button {
  width: 100%;
  padding: 12px;
  background-color: #0077b6;
  border: none;
  color: white;
  font-size: 16px;
  font-weight: bold;
  border-radius: 8px;
  cursor: pointer;
  transition: 0.3s;
}

.form-group button:hover {
  background-color: #0096c7;
}

.login-footer {
  margin-top: 15px;
  font-size: 13px;
  text-align: center;
}

.login-footer a {
  color: #90e0ef;
  text-decoration: none;
  display: block;
  margin: 5px 0;
}

.login-footer a:hover {
  color: #caf0f8;
}

/* link home laranja */
.link-home {
  color: #ff8800;
  font-weight: bold;
  text-decoration: none;
  display: block;
  text-align: center;
  margin-top: 10px;
}
.link-home:hover {
  color: #ffb84d;
}

/* Responsividade */
@media (max-width: 576px) {
  .login-container {
    padding: 20px;
  }
  .login-container img {
    width: 80px;
  }
  .form-group input,
  .form-group button {
    font-size: 14px;
    padding: 10px;
  }
}
  </style>
</head>
<body>
  <div class="login-container">
    <img src="assets/senacquiz.png" alt="senacquiz">
    <a href="index.php" class="link-home">🏠 Home</a><br><br>
    <form method="POST" action="valida_login.php">
      <div class="form-group">
        <input type="email" name="email" placeholder="Digite seu e-mail" required>
      </div>
      <div class="form-group">
        <input type="password" name="senha" placeholder="Digite sua senha" required>
      </div>
      <div class="form-group">
        <button type="submit">Acessar</button>
      </div>
    </form>

    <div class="login-footer">
      <a href="cadastro.php">Não tem uma conta? Cadastra-se</a>
    </div>
  </div>
</body>
</html>
