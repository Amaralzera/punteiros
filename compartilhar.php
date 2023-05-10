<?php
require('carrega/twig.php');
require('carrega/pdo.inc.php');
session_start();

$idD = $_GET['iddoc'];
$idU = $_GET['idusr'];
$perm = $_POST['select'];

$_SESSION['perm'] = $perm;


if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'logado') {
    header('Location: login.php');
    die;
}

$sql = $pdo->prepare('INSERT INTO `doc_share` (`iddoc_share`,`permissao`, `documento_iddoc`, `usr_recebe`) 
VALUES (NULL, :perm, :idD, :idU)');
$sql->BindParam(':perm',$perm);
$sql->BindParam(':idD',$idD);
$sql->BindParam(':idU',$idU);
$sql->execute();


header("Location: index.php?idusr={$_SESSION['id']}&permissao={$_SESSION['perm']}");
