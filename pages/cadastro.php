<?php
  include_once '../php/webhooks.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="shortcut icon" href="../public/imgs/favicon/favicon.ico" type="image/x-icon">
  <meta property="og:title" content="ToyMania — Diversão em Cada Clique">
  <meta property="og:description"
    content="Loja virtual com os brinquedos mais divertidos e criativos! Explore, escolha e se divirta com a ToyMania.">
  <meta property="og:image" content="https://toymania.netlify.app/public/imgs/logo/logotipo-toymania.png">
  <meta property="og:url" content="https://toymania.netlify.app/">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="ToyMania">
  <meta property="og:locale" content="pt_BR">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../css/index.css">
  <link rel="stylesheet" href="../css/cadastro.css">
  <script src="../js/index.js" defer></script>
  <script src="../js/cadastro.js" defer>
    carregarEstados();
  </script>

  <title>Cadastro | ToyMania Loja Virtual</title>
</head>

<body>
  <!-- area do header -->
  <header id="header">
    <div id="news">
      <p>🎉 Promoção Relâmpago na ToyMania! garante até 50% OFF 🧸</p>
    </div>
    <div class="topo">
      <div class="box">
        <form action="#">
          <label for="pequisa">
            <img src="../public/imgs/icons/lupa.png" alt="">
          </label>
          <input type="search" id="pequisa" class="shadow" placeholder="Buscar produtos">
        </form>
      </div>
      <div class="box logo">
        <a id="logo-header" href="../index.html">
          <img src="../public/imgs/logo/logotipo-toymania-semfundo.png" alt="logo">
        </a>
      </div>
      <div class="box">
        <div class="item">
          <a href="login.php#container-cadastro" class="btn-red shadow">Entrar</a>
        </div>
        <div class="item">
          <button type="button">
            <p id="valor-carrinho">0</p>
            <img src="../public/imgs/icons/carrinho.png" alt="">
          </button>
        </div>
      </div>
    </div>
    <nav id="menu">
      <button type="button" class="btnClose" onclick="menu()">
        <img id="btnMenu" src="../public/imgs/icons/arrow-right.png" alt="">
      </button>
      <div class="areaLista">
        <ul id="listaMenu">
          <li>
            <a onclick="menu()" href="../index.php">Inicio</a>
          </li>
          <li>
            <a onclick="menu()" href="./cadastrarProduto.php">Produtos</a>
          </li>
          <li>
            <a onclick="menu()" href="./sobre.html">Sobre</a>
          </li>
          <li>
            <a onclick="menu()" href="./contato.html">Contato</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- fim, area do header -->

  <section id="container-cadastro">
    <div class="container d-flex justify-content-center align-items-center">
      <div class="card p-5 shadow" style="max-width: 600px; width: 100%">

        <form action="../php/cadastrarUsuario.php" method="POST" id="form-cadastro" class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Nome completo</label>
            <input type="text" id="nomeUsuario" name="nomeUsuario" class="form-control" placeholder="Ex: Ana Souza" required>
          </div>

          <div class="col-md-6">
            <label for="cpfUsuario" class="form-label">CPF ou CNPJ</label>
            <input type="text" id="cpfUsuario" name="cpfUsuario" class="form-control" placeholder="Ex: 123.456.789-09" required>
          </div>

          <div class="col-md-6">
            <label for="emailUsuario" class="form-label">E-mail</label>
            <input type="email" id="emailUsuario" name="emailUsuario" class="form-control" placeholder="seuemail@exemplo.com" required>
          </div>

          <div class="col-md-6">
            <label for="telefoneUsuario" class="form-label">Telefone</label>
            <input type="tel" id="telefoneUsuario" name="telefoneUsuario" class="form-control" placeholder="Ex: (11) 91234-5678" required>
          </div>

          <div class="col-md-6">
            <label for="dataUsuario" class="form-label">Data de nascimento</label>
            <input type="date" id="dataUsuario" name="dataUsuario" class="form-control" required>
          </div>

          <div class="col-md-6">
            <label for="cepUsuario" class="form-label">CEP</label>
            <input type="text" id="cepUsuario" name="cepUsuario" class="form-control" placeholder="Ex: 58000-000" required>
          </div>

          <div class="col-md-6">
            <label for="numeroUsuario" class="form-label">Número</label>
            <input type="number" id="numeroUsuario" name="numeroUsuario" class="form-control" placeholder="Ex: 123" required>
          </div>

          <div class="col-md-6">
            <label for="enderecoUsuario" class="form-label">Endereço</label>
            <input type="text" id="enderecoUsuario" name="enderecoUsuario" class="form-control" placeholder="Ex: Rua das Flores" required>
          </div>

          <div class="col-md-6">
            <label for="complementoUsuario" class="form-label">Complemento</label>
            <input type="text" id="complementoUsuario" name="complementoUsuario" class="form-control" placeholder="Ex: casa, apartamento">
          </div>

          <div class="col-md-6">
            <label for="bairroUsuario" class="form-label">Bairro</label>
            <input type="text" id="bairroUsuario" name="bairroUsuario" class="form-control" placeholder="Ex: Centro" required>
          </div>

          <div class="col-md-6">
            <select id="estadoUsuario" name="estadoUsuario" class="form-control" required>
              <option value="">Selecione o estado</option>
            </select>
          </div>

          <div class="col-md-6">
            <select id="cidadeUsuario" name="cidadeUsuario" class="form-control" required>
              <option value="">Selecione a cidade</option>
            </select>
          </div>

          <div class="col-md-6">
            <label for="senhaUsuario" class="form-label">Senha</label>
            <input type="password" id="senhaUsuario" name="senhaUsuario" class="form-control" placeholder="********" required>
          </div>

          <div class="col-md-6">
            <label for="confirmarSenha" class="form-label">Confirmar senha</label>
            <input type="password" id="confirmarSenha" class="form-control" placeholder="********" required>
          </div>

          <div class="alert alert-warning">
            <p id="msg"></p>
          </div>

          <button class="btn btn-primary w-100" id="btn-cadastrar" type="submit" name="cadastrar">Cadastrar</button>
        </form>

      </div>
    </div>
  </section>

  <footer class="footer">
    <div class="footer-container">
      <p>© 2025 ToyMania 🧸 | Todos os direitos reservados</p>
      <p><a href="#">Política de Privacidade</a> · <a href="#">Contato</a></p>
    </div>
  </footer>

</body>

</html>