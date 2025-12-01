<?php
    include_once 'conexao.php';
    include_once 'verificarLogin.php';
    include_once 'pegarDadosUsuario.php';

    if(isset($_POST['cadastrarProduto'])){

        if(!isset($_SESSION['idUsuario'])){
            die("Erro: ID do usuario não encontrado na sessão");
        }

        $idUser = $_SESSION['idUsuario'];
        $nomeProduto = mysqli_real_escape_string($mysqli, $_POST['nomeProduto']);
        $precoProduto = floatval(str_replace(',', '.', $_POST['precoProduto']));
        $qtdProduto = intval($_POST['qtdProduto']);
        $descricaoProduto = mysqli_real_escape_string($mysqli, $_POST['descricaoProduto']);
        
        $stmt = $mysqli->prepare("INSERT INTO produtos (idUsuario,nomeProduto,precoProduto,qtdProduto,descricaoProduto) VALUES (?,?,?,?,?)");
        $stmt->bind_param("issis", $idUser, $nomeProduto, $precoProduto, $qtdProduto, $descricaoProduto);
        
        if($stmt->execute()){
            header("Location: ../index.php?cadastroProduto=200#area-produtos");
        }else{
            header("Location: ../pages/cadastrarProduto.php?cadastroProduto=409#area-produtos");
        }


    }
?>