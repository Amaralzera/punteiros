<?php
require('carrega/twig.php');
require('model/Model.php');
require('model/User.php');
session_start();

$nome = $_POST['nome'];
$email = $_POST['email'];
$pass = $_POST['senha'];
$id = $_POST['id'];

if(!$nome || !$email || !$pass || !$id){
    header('location:cadastro.html');
    die;
}

$pass = password_hash($pass, PASSWORD_BCRYPT);

$usr = new Usuario();
if($usr->insert([
    'idusr' => $id,
    'nome' => $nome,
    'email' => $email,
    'senha' => $pass,
])){
    $_SESSION["user"] = $id;

    header('home.html');
    
}elseif(mysqli_errno() == 1062){
    echo('ocorreu um erro ao realizar o cadastro');
    echo "<a href='cadastro.html'>Voltar</a>";
}




