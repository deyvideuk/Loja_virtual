<?php
    include_once '../php/conexao.php';
    include_once '../php/verificarLogin.php';
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
    <link rel="stylesheet" href="../css/cadastrarProdutos.css">
    <script src="../js/index.js" defer></script>
    <title>ToyMania | Loja Virtual</title>
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
                    <?php if(!isset($_SESSION['idUsuario'])) : ?>
                        <a href="login.php#container-cadastro" class="btn-red shadow">Entrar</a>
                    <?php else :?>
                        <a href="../php/loggout.php" class="btn-red shadow">sair</a>
                    <?php endif;?>
                </div>
                <div class="item">
                    <button type="button">
                        <p id="valor-carrinho">0</p>
                        <img src="../public/imgs/icons/carrinho.png" alt="">
                    </button>
                </div>
                <?php if(isset($_SESSION['idUsuario'])) :?>
                    <div class="nome-usuario">
                        <p>Bem vindo: <?php echo $_SESSION['nomeUsuario']?></p>
                    </div>
                <?php endif;?>
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
                        <a onclick="menu()" href="./sobre.php">Sobre</a>
                    </li>
                    <li>
                        <a onclick="menu()" href="./contato.php">Contato</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- fim, area do header -->

    <?php if(isset($_SESSION['idUsuario'])) : ?>
        <section id="container-cadastro">
            <div class="container d-flex justify-content-center align-items-center">
                <div class="card p-5 shadow" style="max-width: 800px; width: 100%">
                    <form id="form-cadastro" class="row g-2" method="post" action="../php/cadastrarProduto.php">
                        <h2 class="text-center mb-4">Cadastrar Produto</h2>

                        <div class="col-md-4">
                            <label class="form-label">Nome Do Produto</label>
                            <input type="text" id="nomeProduto" name="nomeProduto" class="form-control" placeholder="Ex: Carrinho" required>
                            <small class="error-message"></small>
                        </div>

                        <div class="col-md-4">
                            <label for="preco" class="form-label">Preço</label>
                            <input type="number" id="precoProduto" name="precoProduto" class="form-control"
                                placeholder="Ex: R$ 25,00" required />
                            <small class="error-message"></small>
                        </div>

                        <div class="col-md-4">
                            <label for="quantidade" class="form-label">Quantidade Em Estoque</label>
                            <input type="number" id="quantidadeProduto" name="qtdProduto" class="form-control"
                                placeholder="Ex: 100" required />
                            <small class="error-message"></small>
                        </div>

                        <!-- Descrição ocupando toda a largura -->
                        <div class="col-12">
                            <label for="descricao" class="form-label" id="descricao-label">Descrição Do Produto</label>
                            <textarea type="text" id="descricaoProduto" class="form-control" name="descricaoProduto"
                                placeholder="Descrição do produto aqui..." required></textarea>
                            <small class="error-message"></small>
                        </div>

                        <button class="btn btn-primary w-100" id="btn-cadastrar" type="submit" name="cadastrarProduto">Cadastrar Produto</button>
                        <button class="btn btn-secondary w-100" id="btn-cancelar" type="reset">Cancelar</button>

                    </form>
                </div>
            </div>
        </section>
    <?php else: ?>
        <section id="container-cadastro">
            <div class="container d-flex justify-content-center align-items-center">
                <div class="card p-5 shadow justify-content-center align-items-center height" style="max-width: 800px; width: 100%">
                    Efetue Login para acessar!
                </div>
            </div>
        </section>
    <?php endif;?>

    <footer class="footer">
        <div class="footer-container">
            <p>&copy; <span id="current-year"></span> ToyMania 🧸 | Todos os direitos reservados</p>
            <p><a href="#">Política de Privacidade</a> · <a href="#">Contato</a></p>
        </div>
    </footer>


    <script src="../js/cadastrarProduto.js"></script>

</body>

</html>