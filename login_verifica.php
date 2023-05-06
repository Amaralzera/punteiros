<?php
require('carrega/twig.php');
require('carrega/pdo.inc.php');
require('model/Model.php');
require('model/User.php');

$email = $_POST['email'];
$senha = $_POST['senha'];
$id = $_GET['idusr'];


    $sql = $pdo->prepare('SELECT * FROM usuario WHERE email = :email ');
    $sql->bindParam(':email', $email);
    $sql->execute();

    // Se encontrou o usuário
    if ($sql->rowCount()) {
        // Login feito com sucesso
        $usr = $sql->fetch(PDO::FETCH_OBJ);

        // Verificar se a senha está correta
        if (!password_verify($senha, $usr->senha)) {
            // Falha no login
            header('location:login.php?erro=1');
            die;
        }

        // Cria uma sessão para armazenar o usuário
        session_start();
        $_SESSION['id'] = $usr->idusr;
        $_SESSION['user'] = 'logado';
    
        
        header("location: index.php?idusr=$usr->idusr");
        die;
    } else {
        // Falha no login
        header('location:login.php?erro=1');
        die;
    }