<?php
// Conexão com o banco de dados
$conexao = mysqli_connect("localhost", "root", "", "cup1");

// Verificação da conexão
if (mysqli_connect_errno()) {
    echo "Falha ao conectar ao banco de dados: " . mysqli_connect_error();
    exit();
}

// Verifica se foi enviado o id do registro a ser excluído via POST
if (!empty($_POST['id'])) {
    $id = mysqli_real_escape_string($conexao, $_POST['id']);

    // Executa a query de exclusão do registro
    $query = "DELETE FROM mvp WHERE id = '$id'";
    $resultado = mysqli_query($conexao, $query);

    // Verifica se a query foi executada com sucesso
    if ($resultado) {
        echo "Registro excluído com sucesso!";
        header("Location: menu.html");  
        exit();

    } else {
        echo "Erro ao excluir registro: " . mysqli_error($conexao);
    }
} else {
    echo "Erro ao excluir registro: ID não fornecido.";
}

// Encerramento da conexão com o banco de dados
mysqli_close($conexao);
?>

