<?php
// Conexão com o banco de dados
$conexao = mysqli_connect("localhost", "root", "", "cup1");

// Verificação da conexão
if (mysqli_connect_errno()) {
    echo "Falha ao conectar ao banco de dados: " . mysqli_connect_error();
    exit();
}

// Execução da query
$query = "SELECT id,equipa,nºcamisola,escalao, sum(golos) as golos FROM melhormarcador WHERE escalao='sub-11' GROUP BY equipa,nºcamisola, escalao='sub-11' ORDER BY golos DESC;";
$resultado = mysqli_query($conexao, $query);

// Verificação do resultado da query
if (!$resultado) {
    echo "Erro ao executar a query: " . mysqli_error($conexao);
    exit();
}
echo '<a href="menu.html" style="background-color: blue; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">Voltar para o menu</a>';

// Criação da tabela
echo "<table>";
echo "<tr><th>Equipa</th><th>Nº Camisola</th><th>Escalão</th><th>Golos</th><th>Excluir</th></tr>";
while ($linha = mysqli_fetch_assoc($resultado)) {
    echo "<tr><td>".$linha['equipa']."</td><td>".$linha['nºcamisola']."</td><td>".$linha['escalao']."</td><td>".$linha['golos']."</td>";
    echo "<td><form action='processar_excluir.php' method='post'><input type='hidden' name='id' value='".$linha['id']."'/><button type='submit'>Excluir</button></form></td></tr>";
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