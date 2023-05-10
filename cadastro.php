<?php
require('carrega/twig.php');
require('carrega/pdo.inc.php');
require('model/Model.php');
require('model/User.php');
session_start();

$nome = $_POST['nome'];
$email = $_POST['email'];
$pass = $_POST['senha'];

if(!$nome || !$email || !$pass){
    header('location:login.html');
}

$pass = password_hash($pass, PASSWORD_BCRYPT);

$usr = new Usuario();

$usr->insert([
    'nome' => $nome,
    'email' => $email,
    'senha' => $pass,
]);

echo $twig->render('login.html');






    
    
