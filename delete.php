<?php
require('carrega/twig.php');
require('carrega/pdo.inc.php');
session_start();
$idD = $_GET['iddoc'];
$idU = $_GET['idusr'];

$_SESSION['id'] = $idU;

if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'logado') {
    header('Location: login.php');
    die;
}

$sql = $pdo->prepare('SELECT file FROM documento WHERE iddoc = ?');
$sql->execute([$idD]);

$file = $sql->fetchColumn();

if ($file) {
    unlink('uploads/' . $file);
}

$share = $pdo->prepare('DELETE FROM doc_share WHERE documento_iddoc = ?');
$share->execute([$idD]);

$sql = $pdo->prepare('DELETE FROM documento WHERE iddoc = ?');
$sql->execute([$idD]);

header("Location: index.php?idusr={$_SESSION['id']}");