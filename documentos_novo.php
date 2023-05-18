<?php
require('carrega/twig.php');
require('carrega/pdo.inc.php');
require('model/Model.php');
require('model/Docs.php');
require('func/sanitize_filename.php');
require('func/verifica_nome_arquivo.php');

if (!isset($_GET['idusr'])) {
    echo "Invalid request";
    exit;
}

date_default_timezone_set('America/Sao_Paulo');

$id = $_GET['idusr'];

$allowedExtensions = ['pdf', 'doc', 'docx'];
$allowedMimeTypes = ['application/pdf',
 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !$_FILES['arquivo']['error']) {
    $nome = $_POST['nome'];

    $fileExtension = pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);
    $fileMimeType = $_FILES['arquivo']['type'];

    if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
        die('Tipo de arquivo não permitido, aceitomos apenas PDF, DOC e DOCX por aqui! 😊');
    }

    if (!in_array($fileMimeType, $allowedMimeTypes)) {
        die('Tipo de arquivo não permitido, aceitomos apenas PDF, DOC e DOCX por aqui! 😊');
    }

    $arquivo = sanitize_filename($_FILES['arquivo']['name']);
    $arquivo = verifica_nome_arquivo('uploads/', $arquivo);

    if (!move_uploaded_file($_FILES['arquivo']['tmp_name'], 'uploads/' . $arquivo)) {
        echo "Error uploading file";
        die;
    }

    $doc = new Documento();
    try {
        $doc->insert([
            'iddoc' => null,
            'nome_doc' => $nome,
            'publicado' => date('Y-m-d'), 
            'file' => $arquivo,
            'usuario_idusr' => $id,
        ]);
    } catch (Exception $e) {
        echo "Error inserting document into database: " . $e->getMessage();
        die;
    }
    header("location:arquivos.php?idusr=$id");
    die;
}

echo $twig->render('documentos_novo.html',[
    'idusr' => $id,
]);