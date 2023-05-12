<?php
require('carrega/twig.php');
require('carrega/pdo.inc.php');
session_start();
$idD = $_GET['iddoc'];
$idU = $_GET['idusr'];

if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'logado') {
    header('Location: login.php');
    die;
}

$doc = $pdo->prepare('SELECT * FROM documento WHERE iddoc = ?');
$doc->execute([$idD]);
$doc = $doc->fetch(PDO::FETCH_ASSOC);

$sql = $pdo->prepare('SELECT * FROM usuario WHERE idusr = ?');
$sql->execute([$idU]);
$usuarios = $sql->fetch(PDO::FETCH_ASSOC);

echo $twig->render('del_conf.html', [
    'users' => $usuarios,
    'doc' => $doc,
]);