<?php
require('carrega/twig.php');
require('carrega/pdo.inc.php');
session_start();

$id = $_GET['idusr'];
$perm = $_SESSION['perm'];

if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'logado') {
    header('Location: login.php');
    die;
}

$sql = $pdo->prepare('SELECT doc_share.*, documento.nome_doc AS doc_nome,
 documento.file AS doc_file, documento.usuario_idusr AS doc_uid,
  usuario.nome AS usr_nome 
  FROM doc_share JOIN documento ON documento.iddoc = doc_share.documento_iddoc 
  JOIN usuario ON documento.usuario_idusr = usuario.idusr 
  WHERE doc_share.usr_recebe = ?');
$sql->execute([$id]);

$usuarios = $sql->fetchAll(PDO::FETCH_ASSOC);

echo $twig->render('comp_list.html', [
    'users' => $usuarios,
    'idusr' => $id,
]);