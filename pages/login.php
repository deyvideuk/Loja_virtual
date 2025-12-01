<?php
    if(!isset($_SESSION)){
        session_start();
        
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }else{
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    include_once '../php/conexao.php';
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
    <link rel="stylesheet" href="../css/login.css">
    <script src="../js/index.js" defer></script>
    <title>Login | ToyMania Loja Virtual</title>
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
                        <p id="valor-carrinho"><?php include_once './php/count_cart.php';?></p>
                        <img src="public/imgs/icons/carrinho.png" alt="">
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

                    <?php if(isset($_SESSION['cargoUsuario']) && ($_SESSION['cargoUsuario']) == 'admin'): ?>     
                        <li>
                            <a onclick="menu()" href="cadastrarProduto.php">Cadastrar Produtos</a>
                        </li>
                    <?php else : ?>
                        <li>
                            <a onclick="menu()" href="cadastrarProduto.php">Lista de Produtos</a>
                        </li>
                    <?php endif;?>

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

    <main>
        <section id="container-cadastro">
            <div class="container pt-5 pb-5 d-flex justify-content-center align-items-center">
                <div class="card p-5 shadow" style="max-width: 600px; width: 100%">
                    <h2 class="text-center mb-4 ">Login</h2>

                    <form id="form-cadastro" class="d-flex gap-4 flex-column" action="../php/verificarLogin.php" method="post">

                        <div class="w-100">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" id="email" class="form-control" name="email"
                                placeholder="seuemail@exemplo.com" required />
                        </div>

                        <div class="w-100">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" id="senha" name="senha" class="form-control" placeholder="********"
                                required />
                        </div>

                        <button class="btn btn-primary w-75 m-auto" id="btn-cadastrar" name="login">Entrar</button>
                    </form>

                    <br>
                    <p id="tem-conta">Não tem uma conta? <a href="cadastro.php#container-cadastro">Cadastrar-se</a></p>

                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="footer-container">
            <p>© 2025 ToyMania 🧸 | Todos os direitos reservados</p>
            <p><a href="#">Política de Privacidade</a> · <a href="#">Contato</a></p>
        </div>
    </footer>

</body>

</html>