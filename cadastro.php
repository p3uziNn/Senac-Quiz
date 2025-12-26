<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        background-color: #172c42;
        color: #e0e6ed;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 15px;
      }
      .card {
        background-color: #23314b;
        border: 2px solid #ffffff;
        width: 100%;
        max-width: 400px;
        color: #e0e6ed;
      }
      .form-label {
        color: #e0e6ed !important;
      }
      .form-control {
        background-color: #152a41;
        color: #e0e6ed;
        border: 1px solid #415a77;
      }
      .form-control::placeholder {
        color: #a9bcd0;
      }
      .form-control:focus {
        background-color: #1b263b;
        border-color: #778da9;
        color: #e0e6ed;
        box-shadow: 0 0 0 0.25rem rgba(119, 141, 169, 0.25);
      }
      .btn-success {
        background-color: #0077b6;
        border: none;
      }
      .btn-success:hover {
        background-color: #0096c7;
      }
      a.link-light {
        color: #90e0ef;
        display: inline-block;
        margin-top: 10px;
      }
      a.link-light:hover {
        color: #caf0f8;
      }
      img {
        width: 100px;
        height: 100px;
      }
      /* link home laranja e centralizado */
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
        h2 {
          font-size: 1.5rem;
        }
        img {
          width: 80px;
          height: 80px;
        }
        .card {
          padding: 20px;
        }
      }
    </style>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
          <div class="card shadow-lg p-4 rounded-3 mx-auto">
            <img src="assets/senacquiz.png" alt="logo" class="mx-auto d-block mb-3 img-fluid">
            <h2 class="text-center mb-4">Cadastro</h2>
            <a href="index.php" class="link-home">🏠 Home</a>
            <form action="processa-cadastro.php" method="post">
              <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite seu nome" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail" required>
              </div>
              <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua senha" required>
              </div>
              <button type="submit" class="btn btn-success w-100">Cadastrar</button>
            </form>
            <div class="mt-3 text-center">
              <a href="login.php" class="link-light d-block">Já tenho conta</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
