<?php
if(!isset($_SESSION['cart'])){
        session_start();
}else{
    if (!isset($_SESSION['cart'])) {
        echo 0;
        exit;
    }
}

echo array_sum($_SESSION['cart']);
