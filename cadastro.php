<?php
require('carrega/twig.php');
require('carrega/pdo.inc.php');

$nome = $_POST['nome'];
$user = $_POST['username'];
$pass = $_POST['senha'];

$usr = new Usuario();
$usr->create([
    'nome' => $nome,
    'username' => $user,
    'senha' => $senha,
]);

