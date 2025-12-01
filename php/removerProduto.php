<?php
    include_once 'conexao.php';
    include_once 'pegarProdutos.php';

    if(isset($_POST['excluirProduto'])){
        $idProduto = $_GET['produto'];
        

        $stmt = $mysqli->prepare("DELETE FROM produtos WHERE idProduto = ?");
        $stmt->bind_param("i", $idProduto);
        

        if($stmt->execute()){
            header("Location: ../index.php?Produto=202#area-produtos");
        }else{
            header("Location: ../index.php?Produto=444#area-produtos");
        }
    }

    

?>