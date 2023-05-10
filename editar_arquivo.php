<?php
// Conexão com o banco de dados
$host = 'localhost';
$usuario = 'seu_usuario';
$senha = 'sua_senha';
$bancoDeDados = 'seu_banco_de_dados';
$conexao = new mysqli($host, $usuario, $senha, $bancoDeDados);

// Verifica se foi solicitada a exclusão de um arquivo
if (isset($_GET['excluir'])) {
  $id = $_GET['excluir'];

  // Prepara a consulta para buscar o nome do arquivo
  $consultaNome = $conexao->prepare("SELECT nome FROM tabela_arquivos WHERE id = ?");
  $consultaNome->bind_param("i", $id);
  $consultaNome->execute();
  $consultaNome->bind_result($nomeArquivo);
  $consultaNome->fetch();
  $consultaNome->close();

  // Exclui o arquivo do banco de dados
  $consultaExcluir = $conexao->prepare("DELETE FROM tabela_arquivos WHERE id = ?");
  $consultaExcluir->bind_param("i", $id);
  $consultaExcluir->execute();
  $consultaExcluir->close();

  // Exclui o arquivo do sistema de arquivos
  unlink($nomeArquivo);

  echo "Arquivo excluído com sucesso!";
}

// Verifica se foi solicitada a edição do nome de um arquivo
if (isset($_POST['editar'])) {
  $id = $_POST['id'];
  $novoNome = $_POST['novo_nome'];

  // Prepara a consulta para atualizar o nome do arquivo
  $consultaAtualizar = $conexao->prepare("UPDATE tabela_arquivos SET nome = ? WHERE id = ?");
  $consultaAtualizar->bind_param("si", $novoNome, $id);
  $consultaAtualizar->execute();
  $consultaAtualizar->close();

  echo "Nome do arquivo atualizado com sucesso!";
}

// Consulta os arquivos do banco de dados
$consultaArquivos = $conexao->query("SELECT id, nome FROM tabela_arquivos");

// Exibe os arquivos na página
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

// Fecha a conexão com o banco de dados
$conexao->close();
?>