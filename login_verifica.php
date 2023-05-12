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


    if ($sql->rowCount()) {

        $usr = $sql->fetch(PDO::FETCH_OBJ);


        if (!password_verify($senha, $usr->senha)) {
            // Falha no login
            header('location:login.php?erro=1');
            die;
        }

        session_start();
        $_SESSION['id'] = $usr->idusr;
        $_SESSION['user'] = 'logado';
    
        
        header("location: index.php?idusr=$usr->idusr");
        die;
    } else {
  
        header('location:login.php?erro=1');
        die;
    }