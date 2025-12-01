<?php
    include_once '../php/conexao.php';
    include_once '../php/webhooks.php';
    include_once '../php/verificarLogin.php';

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
    <link rel="stylesheet" href="../css/sobre.css">
    <script src="../js/index.js" defer></script>
    <title>Sobre | ToyMania Loja Virtual</title>
</head>

<body>    <!-- area do header -->
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
                    <?php if(isset($_SESSION['idUsuario'])) : ?>
                    <a href="../php/loggout.php" class="btn-red shadow">sair</a>
                    <div class="nome-usuario">
                        <p>Bem vindo: <?php echo $_SESSION['nomeUsuario']?></p>
                    </div>

                    <?php else :?>
                        <a href="login.php#container-cadastro" class="btn-red shadow">Entrar</a>
                    <?php endif;?>
                
                </div>
                <div class="item">
                    <button type="button">
                        <p id="valor-carrinho"><?php include_once '../php/count_cart.php';?></p>
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
                <img id="btnMenu" src="/public/imgs/icons/arrow-right.png" alt="">
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

    <!-- area Sobre-->
    <section id="sobre">
        <div class="titulo">
            <h1>Sobre nós!</h1>
        </div>
        <div class="texto">
            <p>A ToyMania nasceu como um projeto fictício, criado exclusivamente para fins acadêmicos pelos estudantes da UNINASSAU. Embora nossa loja não seja real e não comercialize produtos, tratamos sua concepção com a mesma seriedade, dedicação e profissionalismo empregados em projetos do mercado. A ideia surgiu dentro de uma disciplina voltada para desenvolvimento web e experiência do usuário, onde fomos desafiados a imaginar, estruturar e construir uma plataforma completa de e-commerce, desde sua identidade visual até o funcionamento das páginas e organização dos produtos.</p>

            <p>Durante o processo, estudamos tendências de design, princípios de usabilidade, técnicas de responsividade e boas práticas de navegação para tornar a ToyMania um ambiente intuitivo, atrativo e funcional — mesmo sendo um projeto acadêmico. Nosso objetivo principal não era vender brinquedos de verdade, mas sim transformar teoria em prática, colocando em ação todos os conhecimentos adquiridos ao longo do curso.</p>

            <p>Além disso, dedicamos atenção especial ao desenvolvimento do conceito da marca. Escolhemos “ToyMania” por transmitir leveza, diversão e entusiasmo, características essenciais quando se fala em brinquedos e infância. Em paralelo, construímos uma narrativa que reforça o propósito do projeto: simular uma loja moderna, confiável e acolhedora, como se realmente estivesse pronta para atender famílias, crianças e colecionadores. Todo o conteúdo apresentado — desde categorias de produtos até imagens ilustrativas — foi cuidadosamente idealizado apenas para fins de estudo, sem fins comerciais.</p>

            <p>A etapa de desenvolvimento também nos permitiu experimentar ferramentas, linguagens e tecnologias usadas no mercado atual. Ao testar funcionalidades reais dentro de um contexto fictício, conseguimos ampliar nosso domínio sobre programação, design, organização visual e arquitetura da informação. Essa vivência prática foi essencial para compreender como projetos digitais são estruturados, testados e aprimorados no mundo profissional.</p>

            <p>Mais do que uma simples atividade de curso, a ToyMania representa o compromisso dos estudantes da UNINASSAU em buscar excelência, criatividade e inovação em seus trabalhos. Mesmo não sendo uma loja verdadeira, o projeto simboliza o que podemos criar quando unimos aprendizado, imaginação e vontade de construir algo relevante. A ToyMania é, portanto, uma vitrine do nosso crescimento acadêmico: um espaço onde mostramos não apenas habilidades técnicas, mas também visão estratégica, planejamento e dedicação.</p>
        </div>
    </section>
    <!-- fim, area Sobre-->

    <div class="borda branco"></div>

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