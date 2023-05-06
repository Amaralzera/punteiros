<?php
require('carrega/twig.php');
require('carrega/pdo.inc.php');
require('model/Model.php');
require('model/Docs.php');

$id = $_GET['idusr'];

session_start();

$user = null;

if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'logado') {
    header('Location: login.php');
    die;
}

$doc = new Documento();
$documentos = $doc->getAll(['usuario_idusr' => $id]);

echo $twig->render('arquivos.html', ['documentos' => $documentos,]);