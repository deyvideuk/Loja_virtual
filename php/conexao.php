<?php

    $hostname = "localhost";
    $banco = "toymania";
    $usuario = "root";
    // $senha = "12345678";
    // $senha = "Dwdbrasiloficial12!";
    $senha = "@washesk1ll";

    $mysqli = new mysqli($hostname, $usuario, $senha, $banco);

    $mysqli->set_charset("utf8mb4");

    if($mysqli->connect_error){
        echo "Falha ao conectar: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

?>