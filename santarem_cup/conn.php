<?php
// Conexão com o banco de dados
$conexao = mysqli_connect("localhost", "root", "", "cup1");

// Verificação da conexão
if (mysqli_connect_errno()) {
    echo "Falha ao conectar ao banco de dados: " . mysqli_connect_error();
    exit();
}