<?php
$user = "";
$password = "";
$dbname = "`mydb";

$conn = mysqli_connect($user, $password, $dbname);

if (!$conn) {
  die("Conexão falhou: " . mysqli_connect_error());
}


$nome = $_POST['nome'];
$proprietario = $_POST['proprietario'];

$sql = "SELECT * FROM documentos WHERE 1=1";

if (!empty($nome)) {
  $sql .= " AND nome LIKE '%$nome%'";
}

if (!empty($data)) {
  $sql .= " AND data_upload = '$data'";
}

if (!empty($proprietario)) {
  $sql .= " AND proprietario = '$proprietario'";
}


$resultado = mysqli_query($conn, $sql);

if (mysqli_num_rows($resultado) > 0) {
  while ($row = mysqli_fetch_assoc($resultado)) {
    echo "Nome: " . $row["nome"] . "<br>";
    echo "Data de upload: " . $row["data_upload"] . "<br>";
    echo "Proprietário: " . $row["proprietario"] . "<br><br>";
  }
} else {
  echo "Nenhum documento encontrado.";
}


mysqli_close($conn);
?>