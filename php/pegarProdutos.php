<?php
    include_once 'conexao.php';

    $stmt = $mysqli->prepare("SELECT * FROM produtos ORDER BY idProduto DESC");
    $stmt->execute();

    $resultadoProdutos = $stmt->get_result();

?>