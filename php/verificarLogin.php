<?php
    include_once './conexao.php';

    if(!isset($_SESSION)){
        session_start();
    }

    if(isset($_POST['login'])){
        $emailUsuario = $_POST['email'];
        $senhaUsuario = $_POST['senha'];

        $stmt = $mysqli->prepare("SELECT * FROM usuarios WHERE emailUsuario = ?");
        $stmt->bind_param("s", $emailUsuario);
        $stmt->execute();

        $resultado = $stmt->get_result();

        if($resultado->num_rows > 0){
            $usuario = $resultado->fetch_assoc();
            $_SESSION['id'] = $usuario['idUsuario'];
            $_SESSION['senhaUsuario'] = $usuario['senhaUsuario'];

            if(password_verify($senhaUsuario, $_SESSION['senhaUsuario'])){
                $_SESSION['nomeUsuario'] = $usuario['nomeUsuario'];
                $_SESSION['cpfUsuario'] = $usuario['cpfUsuario'];
                $_SESSION['emailUsuario'] = $usuario['emailUsuario'];
                $_SESSION['telefoneUsuario'] = $usuario['telefoneUsuario'];
                $_SESSION['dataUsuario'] = $usuario['dataUsuario'];
                $_SESSION['cepUsuario'] = $usuario['cepUsuario'];
                $_SESSION['numeroUsuario'] = $usuario['numeroUsuario'];
                $_SESSION['enderecoUsuario'] = $usuario['enderecoUsuario'];
                $_SESSION['complementoUsuario'] = $usuario['complementoUsuario'];
                $_SESSION['bairroUsuario'] = $usuario['bairroUsuario'];
                $_SESSION['estadoUsuario'] = $usuario['estadoUsuario'];
                $_SESSION['cidadeUsuario'] = $usuario['cidadeUsuario'];  
                
                header("Location: ../index.php?login=200");
            }else{
                session_destroy();
                header("Location: ../pages/login.php?login=401");
            }
        }

    }


?>