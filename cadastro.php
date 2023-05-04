<?php
require('carrega/twig.php');
require('carrega/pdo.inc.php');

$nome = $_POST['nome'];
$user = $_POST['username'];
$pass = $_POST['senha'];

$usr = new Usuario();
$usr->create([
    'username' => $user,
    'senha' => $pass,
    'email' => $email,
    'admin' => $adm,
    'ativo' => 1,
]);

