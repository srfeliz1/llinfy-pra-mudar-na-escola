<?php
$host = 'localhost'; // Servidor do banco de dados
$user = 'root';      // Usuário do banco de dados
$password = '';      // Senha do banco de dados
$database = 'linfy_database'; // Nome do banco de dados

// Criar conexão com o banco de dados
$conn = new mysqli($host, $user, $password, $database);

// Verificar se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}
?>
