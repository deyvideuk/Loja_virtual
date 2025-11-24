<?php
include_once 'conexao.php';

    if (isset($_POST["cadastrar"])) {

        session_start();

        $nomeUsuario = mysqli_real_escape_string($mysqli, $_POST['nomeUsuario']);
        $cpfUsuario = mysqli_real_escape_string($mysqli, $_POST['cpfUsuario']);
        $emailUsuario = mysqli_real_escape_string($mysqli, $_POST['emailUsuario']);
        $cargoUsuario = 'usuario';
        $telefoneUsuario = mysqli_real_escape_string($mysqli, $_POST['telefoneUsuario']);
        $dataUsuario = mysqli_real_escape_string($mysqli, $_POST['dataUsuario']);
        $cepUsuario = mysqli_real_escape_string($mysqli, $_POST['cepUsuario']);
        $numeroUsuario = mysqli_real_escape_string($mysqli, $_POST['numeroUsuario']);
        $enderecoUsuario = mysqli_real_escape_string($mysqli, $_POST['enderecoUsuario']);
        $complementoUsuario = mysqli_real_escape_string($mysqli, $_POST['complementoUsuario']);
        $bairroUsuario = mysqli_real_escape_string($mysqli, $_POST['bairroUsuario']);
        $estadoUsuario = mysqli_real_escape_string($mysqli, $_POST['estadoUsuario']);
        $cidadeUsuario = mysqli_real_escape_string($mysqli, $_POST['cidadeUsuario']);
        $senhaUsuario = mysqli_real_escape_string($mysqli, $_POST['senhaUsuario']);

        $stmt = $mysqli->prepare("SELECT * FROM usuarios WHERE cpfUsuario = ? OR emailUsuario = ?");
        $stmt->bind_param("ss", $cpfUsuario, $emailUsuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            header("Location: ../pages/cadastro.php?cadastro=409#container-cadastro");
            exit;
        }


        $senhaProtegida = password_hash($senhaUsuario, PASSWORD_DEFAULT);


        $stmt = $mysqli->prepare("INSERT INTO usuarios 
        (nomeUsuario, cpfUsuario, emailUsuario, cargoUsuario, telefoneUsuario, dataUsuario, cepUsuario, numeroUsuario, enderecoUsuario, complementoUsuario, bairroUsuario, estadoUsuario, cidadeUsuario, senhaUsuario) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

        $stmt->bind_param("ssssssssssssss",
            $nomeUsuario, 
            $cpfUsuario,
            $emailUsuario,
            $cargoUsuario,
            $telefoneUsuario,
            $dataUsuario,
            $cepUsuario,
            $numeroUsuario,
            $enderecoUsuario,
            $complementoUsuario,
            $bairroUsuario,
            $estadoUsuario,
            $cidadeUsuario,
            $senhaProtegida
        );

        if ($stmt->execute()) {
            header("Location: ../pages/login.php?cadastro=200#container-cadastro");
            exit;
        } else {
            echo "Erro ao cadastrar: " . $stmt->error;
        }
    }
?>
