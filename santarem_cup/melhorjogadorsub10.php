<?php
// Conexão com o banco de dados
$conexao = mysqli_connect("localhost", "root", "", "cup1");

// Verificação da conexão
if (mysqli_connect_errno()) {
    echo "Falha ao conectar ao banco de dados: " . mysqli_connect_error();
    exit();
}

// Processamento do formulário de exclusão
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $query = "DELETE FROM mvp WHERE id = $id";
    if (!mysqli_query($conexao, $query)) {
        echo "Erro ao excluir registro: " . mysqli_error($conexao);
    }
}

// Execução da query
$query = "SELECT id, equipa, `nºcamisola`, escalao, COUNT(*) as Pontos FROM mvp WHERE tipo = 2 AND escalao = 'sub-10' GROUP BY  equipa, `nºcamisola`, escalao ORDER BY Pontos DESC;";
$resultado = mysqli_query($conexao, $query);

// Verificação do resultado da query
if (!$resultado) {
    echo "Erro ao executar a query: " . mysqli_error($conexao);
    exit();
}
echo '<a href="menu.html" style="background-color: blue; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">Voltar para o menu</a>';
// Criação da tabela
echo "<table>";
echo "<tr><th>Equipa</th><th>Nº Camisola</th><th>Escalão</th><th>Pontos</th><th>Excluir</th></tr>";
while ($linha = mysqli_fetch_assoc($resultado)) {
    echo "<tr><td>".$linha['equipa']."</td><td>".$linha['nºcamisola']."</td><td>".$linha['escalao']."</td><td>".$linha['Pontos']."</td>";
    echo "<td><form method='POST'><input type='hidden' name='id' value='".$linha['id']."'><button type='submit'>Excluir</button></form></td></tr>";
}
echo "</table>";

// Encerramento da conexão com o banco de dados
mysqli_close($conexao);
?>

<style>
    table {
  border-collapse: collapse;
  width: 100%;
  max-width: 800px;
  margin: 0 auto;
}

th, td {
  text-align: center;
  padding: 10px;
  border: 1px solid #ddd;
}

th {
  background-color: blue;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

tr:hover {
  background-color: #ddd;
}
</style>