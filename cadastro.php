<?php
require('carrega/twig.php');
require('model/Model.php');
require('model/User.php');

$nome = $_POST['nome'];
$email = $_POST['email'];
$pass = $_POST['senha'];
$id = $_POST['id'];

if(!$nome || !$email || !$pass){
    header('location:novo_u.php');
    die;
}

$pass = password_hash($pass, PASSWORD_BCRYPT);

$usr = new Usuario();
$usr->insert([
    'idusr' => $id,
    'nome' => $nome,
    'email' => $email,
    'senha' => $pass,
]);



