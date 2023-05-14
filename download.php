<?php
require('carrega/pdo.inc.php');

session_start();
$idD = $_GET['iddoc'];
$idU = $_GET['idusr'];

$_SESSION['id'] = $idU;

if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'logado') {
    header('Location: login.php');
    die;
}

// Query the database to get the file name
$stmt = $pdo->prepare('SELECT file FROM documento WHERE iddoc = ?');
$stmt->execute([$idD]);
$doc = $stmt->fetch();

// Send the file to the browser
$file = 'uploads/'.$doc['file'];
if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
}

header("location: arquivos.php?idusr={$_SESSION['id']}");