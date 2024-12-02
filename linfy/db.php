<?php
// Configurações do banco de dados
$host = 'localhost';       // Endereço do servidor do banco de dados
$dbname = 'databaselinfy'; // Nome do banco de dados
$user = 'root';         // Nome de usuário do banco de dados
$pass = '';           // Senha do usuário do banco de dados
// Criar conexão com o banco de dados usando PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    // Configurações para modo de erro
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexão bem-sucedida!";
} catch (PDOException $e) {
    // Caso ocorra um erro, exibe a mensagem
    echo "Erro na conexão: " . $e->getMessage();
}
?>
