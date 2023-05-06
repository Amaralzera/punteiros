<?php
require('carrega/twig.php');
require('carrega/pdo.inc.php');
require('model/Model.php');
require('model/User.php');
session_start();

$user = null;

if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'logado') {
    header('Location: login.php');
    die;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['idusr'] ?? false;
    if ($id) {
        $sql = $pdo->prepare('SELECT * FROM usuario WHERE idusr = ?');
        $sql->execute([$id]);
        $user = $sql->fetch(PDO::FETCH_ASSOC);
    }
}

if (!$user) {
    die("Usuario não encontrado");
}

echo $twig->render('index.html', [
    'usr' => $user,
]);