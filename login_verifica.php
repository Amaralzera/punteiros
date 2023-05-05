<?php

    require('pdo.inc.php');
    $email = $_POST['email'];
    $senha = $_POST['senha'];


    $sql = $pdo->prepare('SELECT * FROM usuario WHERE username = :usr AND ativo = 1');
    $sql->bindParam(':email', $email);

    $sql->execute();

    // Se encontrou o usuário
    if ($sql->rowCount()) {
        // Login feito com sucesso
        $email = $sql->fetch(PDO::FETCH_OBJ);

        // Verificar se a senha está correta
        if (!password_verify($senha, $email->senha)) {
            // Falha no login
            header('location:login.php?erro=1');
            die;
        }

        // Cria uma sessão para armazenar o usuário
        session_start();
        $_SESSION['email'] = $email->nome;
        
        // Redireciona o usuário
        header('location:boasvindas.php');
        die;
    } else {
        // Falha no login
        header('location:login.php?erro=1');
        die;
    }