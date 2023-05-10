
<?php
// Conexão com o banco de dados
$host = 'localhost';
$usuario = 'seu_usuario';
$senha = 'sua_senha';
$bancoDeDados = 'seu_banco_de_dados';
$conexao = new mysqli($host, $usuario, $senha, $bancoDeDados);

// Verifica se o arquivo foi enviado corretamente
if ($_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
  // Informações sobre o arquivo
  $nomeArquivo = $_FILES['arquivo']['name'];
  $tipoArquivo = $_FILES['arquivo']['type'];
  $caminhoArquivo = $_FILES['arquivo']['tmp_name'];

  // Lê o conteúdo do arquivo
  $conteudoArquivo = file_get_contents($caminhoArquivo);

  // Prepara a consulta para inserir no banco de dados
  $consulta = $conexao->prepare("INSERT INTO tabela_arquivos (nome, tipo, conteudo) VALUES (?, ?, ?)");
  $consulta->bind_param("sss", $nomeArquivo, $tipoArquivo, $conteudoArquivo);

  // Executa a consulta
  $consulta->execute();

  // Verifica se a inserção foi bem-sucedida
  if ($consulta->affected_rows > 0) {
    echo "Arquivo enviado com sucesso!";
  } else {
    echo "Erro ao enviar o arquivo.";
  }

  // Fecha a consulta
  $consulta->close();
} else {
  echo "Erro ao enviar o arquivo: " . $_FILES['arquivo']['error'];
}

// Fecha a conexão com o banco de dados
$conexao->close();
?>