<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Pega o ID do produto
$id = $_POST['id'];

// Se já existe no cart, soma +1
if (isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id]++;
} else {
    $_SESSION['cart'][$id] = 1;
}

echo json_encode(["status" => "ok"]);
