<?php

$hostname = "localhost";
$banco = "toymania";
$usuario = "root";
$senha = "Dwdbrasiloficial12!";

$mysqli = new mysqli($hostname, $usuario, $senha, $banco);

if($mysqli->connect_error){
    echo "Falha ao conectar: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

?>