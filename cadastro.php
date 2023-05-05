<?php
require('carrega/twig.php');
require('carrega/pdo.inc.php');

$nome = $_POST['nome'];
$email = $_POST['email'];
$pass = $_POST['senha'];

$usr = new Usuario();
$usr->create([
    'nome' => $nome,
    'email' => $email,
    'senha' => $senha,
]);

