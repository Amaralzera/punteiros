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

$id = $_GET['idusr'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !$_FILES['arquivo']['error']) {
    $nome = $_POST['nome'];

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