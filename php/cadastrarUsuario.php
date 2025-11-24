<?php
    include_once 'conexao.php';

   if(isset($_POST["cadastrar"])){
    
    if(!isset($_SESSION)){
        session_start();
    }

    $_SESSION['nomeUsuario'] = mysqli_real_escape_string($mysqli, $_POST['nomeUsuario']);
    $_SESSION['cpfUsuario'] = mysqli_real_escape_string($mysqli, $_POST['cpfUsuario']);
    $_SESSION['emailUsuario'] = mysqli_real_escape_string($mysqli, $_POST['emailUsuario']);
    $_SESSION['telefoneUsuario'] = mysqli_real_escape_string($mysqli, $_POST['telefoneUsuario']);
    $_SESSION['dataUsuario'] = mysqli_real_escape_string($mysqli, $_POST['dataUsuario']);
    $_SESSION['cepUsuario'] = mysqli_real_escape_string($mysqli, $_POST['cepUsuario']);
    $_SESSION['numeroUsuario'] = mysqli_real_escape_string($mysqli, $_POST['numeroUsuario']);
    $_SESSION['enderecoUsuario'] = mysqli_real_escape_string($mysqli, $_POST['enderecoUsuario']);
    $_SESSION['complementoUsuario'] = mysqli_real_escape_string($mysqli, $_POST['complementoUsuario']);
    $_SESSION['bairroUsuario'] = mysqli_real_escape_string($mysqli, $_POST['bairroUsuario']);
    $_SESSION['estadoUsuario'] = mysqli_real_escape_string($mysqli, $_POST['estadoUsuario']);
    $_SESSION['cidadeUsuario'] = mysqli_real_escape_string($mysqli, $_POST['cidadeUsuario']);
    $_SESSION['senhaUsuario'] = mysqli_real_escape_string($mysqli, $_POST['senhaUsuario']);

    $stmt = $mysqli->prepare("SELECT * FROM usuarios WHERE cpfUsuario = ?");
    $stmt->bind_param("s", $_SESSION['cpfUsuario']);

    $stmt->execute();
    $resultado = $stmt->get_result();

    if($resultado->num_rows > 0){
        echo "Já existe";
        $stmt->close();
        header("Location: ../pages/cadastro.php?cadastro=409#container-cadastro");
    }else{
        echo "não existe";
        $stmt->close();

        $senhaProtegida = password_hash($_SESSION['senhaUsuario'], PASSWORD_DEFAULT);
        

        $stmt = $mysqli->prepare("INSERT INTO usuarios (nomeUsuario, cpfUsuario, emailUsuario, telefoneUsuario, dataUsuario, cepUsuario, numeroUsuario, enderecoUsuario, complementoUsuario, bairroUsuario, estadoUsuario, cidadeUsuario, senhaUsuario) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssssssssss", $_SESSION['nomeUsuario'], $_SESSION['cpfUsuario'], $_SESSION['emailUsuario'], $_SESSION['telefoneUsuario'], $_SESSION['dataUsuario'], $_SESSION['cepUsuario'], $_SESSION['numeroUsuario'], $_SESSION['enderecoUsuario'], $_SESSION['complementoUsuario'], $_SESSION['bairroUsuario'], $_SESSION['estadoUsuario'], $_SESSION['cidadeUsuario'], $senhaProtegida);

        if($stmt->execute()){
            $stmt->close();
            session_destroy();
            header("Location: ../pages/login.php?cadastro=200#container-cadastro");
        }else{
            $stmt->close();
            session_destroy();
            echo "Falha ao cadastrar";
        }
    }
}

?>