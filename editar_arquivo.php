<?php

$host = 'localhost';
$usuario = 'seu_usuario';
$senha = '';
$bancoDeDados = 'mydb';
$conexao = new mysqli($host, $usuario, $senha, $bancoDeDados);


if (isset($_GET['excluir'])) {
  $id = $_GET['excluir'];

  $consultaNome = $conexao->prepare("SELECT nome FROM tabela_arquivos WHERE id = ?");
  $consultaNome->bind_param("i", $id);
  $consultaNome->execute();
  $consultaNome->bind_result($nomeArquivo);
  $consultaNome->fetch();
  $consultaNome->close();

  $consultaExcluir = $conexao->prepare("DELETE FROM tabela_arquivos WHERE id = ?");
  $consultaExcluir->bind_param("i", $id);
  $consultaExcluir->execute();
  $consultaExcluir->close();

  unlink($nomeArquivo);

  echo "Arquivo excluído com sucesso!";
}

if (isset($_POST['editar'])) {
  $id = $_POST['id'];
  $novoNome = $_POST['novo_nome'];


  $consultaAtualizar = $conexao->prepare("UPDATE tabela_arquivos SET nome = ? WHERE id = ?");
  $consultaAtualizar->bind_param("si", $novoNome, $id);
  $consultaAtualizar->execute();
  $consultaAtualizar->close();

  echo "Nome do arquivo atualizado com sucesso!";
}


$consultaArquivos = $conexao->query("SELECT id, nome FROM tabela_arquivos");


while ($arquivo = $consultaArquivos->fetch_assoc()) {
  echo "<p>";
  echo "Arquivo: " . $arquivo['nome'] . " ";
  echo "<a href='seu_arquivo.php?excluir=" . $arquivo['id'] . "'>Excluir</a> ";
  echo "<form action='seu_arquivo.php' method='post'>";
  echo "<input type='hidden' name='id' value='" . $arquivo['id'] . "' />";
  echo "<input type='text' name='novo_nome' placeholder='Novo nome' />";
  echo "<input type='submit' name='editar' value='Editar' />";
  echo "</form>";
  echo "</p>";
}

$conexao->close();
?>