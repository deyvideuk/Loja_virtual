<?php
include_once '../php/conexao.php';
include_once '../php/webhooks.php';
include_once '../php/pegarProdutos.php';
include_once '../php/verificarLogin.php';
include_once '../php/removerProduto.php';

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

if (!isset($_SESSION['idUsuario'])) {
    header("Location: ./login.php?login=405");
}

if (isset($_POST["finalizar"])) {
    header("Location: ../pages/obrigado.php");
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
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/checkout.css">
    <script src="../js/index.js" defer></script>
    <title>Sobre | ToyMania Loja Virtual</title>
</head>

<body> <!-- area do header -->
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
                    <?php if (isset($_SESSION['idUsuario'])): ?>
                        <a href="../php/loggout.php" class="btn-red shadow">sair</a>
                        <div class="nome-usuario">
                            <p>Bem vindo: <?php echo $_SESSION['nomeUsuario'] ?></p>
                        </div>

                    <?php else: ?>
                        <a href="login.php#container-cadastro" class="btn-red shadow">Entrar</a>
                    <?php endif; ?>

                </div>
                <div class="item">
                    <button type="button">
                        <p id="valor-carrinho"><?php include_once '../php/count_cart.php'; ?></p>
                        <a href="../pages/checkout.php">
                            <img src="../public/imgs/icons/carrinho.png" alt="cart">
                        </a>
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
                <img id="btnMenu" src="/public/imgs/icons/arrow-right.png" alt="">
            </button>
            <div class="areaLista">
                <ul id="listaMenu">
                    <li>
                        <a onclick="menu()" href="../index.php">Inicio</a>
                    </li>

                    <?php if (isset($_SESSION['cargoUsuario']) && ($_SESSION['cargoUsuario']) == 'admin'): ?>
                        <li>
                            <a onclick="menu()" href="cadastrarProduto.php">Cadastrar Produtos</a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a onclick="menu()" href="cadastrarProduto.php">Lista de Produtos</a>
                        </li>
                    <?php endif; ?>

                    <li>
                        <a onclick="menu()" href="sobre.php">Sobre</a>
                    </li>
                    <li>
                        <a onclick="menu()" href="contato.php">Contato</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- fim, area do header -->


    <!-- Area checkout -->
    <div class="bg">
        <div class="card">

            <h3 class="titulo">Endereço para envio:</h3>

            <div class="endereco">
                <p><strong>Destinatário: <?php echo $_SESSION['nomeUsuario'] ?></strong></p>
                <p><?php echo $_SESSION['enderecoUsuario'] ?></p>
                <p><?php echo $_SESSION['cidadeUsuario'] ?>, <?php echo $_SESSION['estadoUsuario'] ?>,
                    <?php echo $_SESSION['cepUsuario'] ?>
                </p>
                <p><?php echo $_SESSION['bairroUsuario'] ?>, Complemento: <?php echo $_SESSION['complementoUsuario'] ?>
                </p>
                <a href="" class="alterar">mudar endereço</a>
            </div>

            <div class="item">
                <img src="uno.jpg" alt="Produto">

                <div class="item-info">
                    <p class="produto-nome">Nome do produto*</p>
                    <p class="produto-preco">12,80</p>
                </div>

                <div class="quantidade">
                    <span class="menos">-</span>
                    <input type="text" value="1">
                    <span class="mais">+</span>
                </div>
            </div>

            <div class="linha"></div>

            <div class="envio-total">
                <div>
                    <label>Opções de envio:</label>
                    <select>
                        <option>SEDEX</option>
                        <option>PAC</option>
                    </select>
                </div>

                <p class="total">TOTAL DE: 1 ITENS</p>
            </div>

            <div class="pagamento">
                <label>Métodos de pagamento:</label>

                <label class="radio">
                    <input type="radio" name="pagamento" checked>
                    PIX
                </label>

                <label class="radio">
                    <input type="radio" name="pagamento">
                    CARTÃO
                </label>
            </div>

            <form action="checkout.php" method="post">
                <button class="finalizar" type="submit" name="finalizar">finalizar</button>
            </form>
        </div>
    </div>
    <!-- Area checkout -->


    <!-- area do footer -->
    <footer class="footer w-100">
        <div class="footer-container">
            <p>&copy; 2025 ToyMania 🧸 | Todos os direitos reservados</p>
            <p><a href="#">Política de Privacidade</a> · <a href="/pages/contato.html">Contato</a></p>
        </div>
    </footer>
    <!-- fim, area do footer -->
</body>

</html>