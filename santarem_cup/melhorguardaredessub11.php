<?php
// Conexão com o banco de dados
$conexao = mysqli_connect("localhost", "root", "", "cup1");

// Verificação da conexão
if (mysqli_connect_errno()) {
    echo "Falha ao conectar ao banco de dados: " . mysqli_connect_error();
    exit();
}

// Verificação do envio do formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtenção do id do registro a ser excluído
    $id = $_POST['id'];

    // Execução da query de exclusão
    $query_excluir = "DELETE FROM mvp WHERE id = $id";
    $resultado_excluir = mysqli_query($conexao, $query_excluir);

    // Verificação do resultado da query de exclusão
    if (!$resultado_excluir) {
        echo "Erro ao excluir o registro: " . mysqli_error($conexao);
        exit();
    } else {
        // Redirecionamento para a página atual para atualizar a tabela
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
}

// Execução da query
$query = "SELECT id, equipa, nºcamisola, escalao, COUNT(*) as Pontos FROM mvp WHERE tipo = 1 AND escalao = 'sub-11' GROUP BY  equipa, nºcamisola, escalao ORDER BY Pontos DESC;;";
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
    echo "<tr><td>".$linha['equipa']."</td><td>".$linha['nºcamisola']."</td><td>".$linha['escalao']."</td><td>".$linha['Pontos']."</td><td><form method='POST'><input type='hidden' name='id' value='".$linha['id']."'><button type='submit'>Excluir</button></form></td></tr>";
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

button {
  background-color: red;
  color: white;
  border: none;
  padding: 5px;
  cursor: pointer;
}
</style>
