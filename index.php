<?php
include_once './php/conexao.php';
include_once './php/webhooks.php';
include_once './php/pegarProdutos.php';
include_once './php/verificarLogin.php';

if (!isset($_SESSION)) {
    session_start();

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
} else {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="shortcut icon" href="public/imgs/favicon/favicon.ico" type="image/x-icon">
    <meta property="og:title" content="ToyMania — Diversão em Cada Clique">
    <meta property="og:description"
        content="Loja virtual com os brinquedos mais divertidos e criativos! Explore, escolha e se divirta com a ToyMania.">
    <meta property="og:image" content="https://toymania.netlify.app/public/imgs/logo/logotipo-toymania.png">
    <meta property="og:url" content="https://toymania.netlify.app/">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="ToyMania">
    <meta property="og:locale" content="pt_BR">
    <meta name="theme-color" content="#6BF178">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/index.css">
    <script src="js/index.js" defer></script>
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
                        <img src="public/imgs/icons/lupa.png" alt="">
                    </label>
                    <input type="search" id="pequisa" class="shadow" placeholder="Buscar produtos">
                </form>
            </div>
            <div class="box logo">
                <a id="logo-header" href="./index.php">
                    <img src="public/imgs/logo/logotipo-toymania-semfundo.png" alt="logos">
                </a>
            </div>
            <div class="box">
                <div class="item">
                    <?php if (!isset($_SESSION['idUsuario'])): ?>
                        <a href="./pages/login.php#container-cadastro" class="btn-red shadow">Entrar</a>
                    <?php else: ?>
                        <a href="./php/loggout.php" class="btn-red shadow">sair</a>
                    <?php endif; ?>
                </div>
                <div class="item">
                    <button type="button">
                        <p id="valor-carrinho"><?php include_once './php/count_cart.php'; ?></p>
                        <img src="public/imgs/icons/carrinho.png" alt="">
                    </button>
                </div>
                <?php if (isset($_SESSION['idUsuario'])): ?>
                    <div class="nome-usuario">
                        <p>Bem vindo: <?php echo $_SESSION['nomeUsuario'] ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <nav id="menu">
            <button type="button" class="btnClose" onclick="menu()">
                <img id="btnMenu" src="public/imgs/icons/arrow-right.png" alt="">
            </button>
            <div class="areaLista">
                <ul id="listaMenu">
                    <li>
                        <a onclick="menu()" href="./index.php">Inicio</a>
                    </li>

                    <?php if (isset($_SESSION['cargoUsuario']) && ($_SESSION['cargoUsuario']) == 'admin'): ?>
                        <li>
                            <a onclick="menu()" href="./pages/cadastrarProduto.php">Cadastrar Produtos</a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a onclick="menu()" href="./pages/cadastrarProduto.php">Lista de Produtos</a>
                        </li>
                    <?php endif; ?>

                    <li>
                        <a onclick="menu()" href="./pages/sobre.php">Sobre</a>
                    </li>
                    <li>
                        <a onclick="menu()" href="./pages/contato.php">Contato</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- fim, area do header -->

    <!-- area do banner carousel -->
    <section id="Carousel" class="container-fluid p-0">
        <div id="banner" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#banner" data-bs-slide-to="0" class="active"
                    aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#banner" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#banner" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#banner" data-bs-slide-to="3" aria-label="Slide 4"></button>
                <button type="button" data-bs-target="#banner" data-bs-slide-to="4" aria-label="Slide 5"></button>
                <button type="button" data-bs-target="#banner" data-bs-slide-to="5" aria-label="Slide 6"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="public/imgs/banners/BANNER 4.png" class="w-100 d-block img-fluid" alt="">
                </div>
                <div class="carousel-item">
                    <img src="public/imgs/banners/BANNER 1.png" class="w-100 d-block img-fluid" alt="">
                </div>
                <div class="carousel-item">
                    <img src="public/imgs/banners/BANNER 2.png" class="w-100 d-block img-fluid" alt="">
                </div>
                <div class="carousel-item">
                    <img src="public/imgs/banners/BANNER 3.png" class="w-100 d-block img-fluid" alt="">
                </div>
                <div class="carousel-item">
                    <img src="public/imgs/banners/BANNER 5.png" class="w-100 d-block img-fluid" alt="">
                </div>
                <div class="carousel-item">
                    <img src="public/imgs/banners/BANNER 6.png" class="w-100 d-block img-fluid" alt="">
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#banner" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previus</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#banner" data-bs-slide="next">
                <span class="carousel-control-next-icon" arial-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <!-- fim, area do banner carousel -->

    <span class="borda verde"></span>

    <!-- area de produtos-->
    <section id="area-produtos">
        <h2>Novos Produtos</h2>
        <?php if ($resultadoProdutos->num_rows > 0): ?>
            <div class="tela-produtos">

                <button type="button" class="btn-next" onclick="next()">&gt;</button>
                <button type="button" class="btn-prev" onclick="prev()">&lt;</button>

                <?php while ($dados_produtos = mysqli_fetch_assoc($resultadoProdutos)): ?>
                    <div id="produtos" class="produtos">
                        <div class="box-card card d-flex justify-content-center">
                            <img src="https://picsum.photos/seed/<?php echo $dados_produtos['idProduto']; ?>/300/200"
                                class="card-img-top" alt="Imagem do Produto"> <!-- api que gera imagens aleatorias -->
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $dados_produtos['nomeProduto'] ?></h4>
                                <h6 class="card-text">R$
                                    <?php echo number_format(($dados_produtos['precoProduto']), 2, ',', '.') ?> Reais</h6>
                                <p class="card-text"><?php echo $dados_produtos['descricaoProduto'] ?> Reais</p>
                                <h6 class="card-text">Disponível: <?php echo $dados_produtos['qtdProduto'] ?> Unidades.</h6>
                                <br>
                                <button class="add-cart btn btn-primary"
                                    data-id="<?php echo $dados_produtos['idProduto'] ?>">Adicionar ao Carrinho</button>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="tela-produtos">

                <div class="sem-produtos">
                    <h2>Não há produtos cadastrados para anúncio!</h2>
                </div>

            </div>
        <?php endif; ?>
    </section>
    <!-- fim, area de produtos-->

    <span class="borda azul"></span>

    <!-- area do footer -->
    <footer class="footer mt-5 w-100">
        <div class="footer-container">
            <p>&copy; 2025 ToyMania 🧸 | Todos os direitos reservados</p>
            <p><a href="#">Política de Privacidade</a> · <a href="#">Contato</a></p>
        </div>
    </footer>

    <!-- fim, area do footer -->
</body>

</html>