<?php

$localhost = "localhost";
$db = "linfy_database";
$user = "root";
$pass = "";

try {
    // Corrigindo o DSN para "mysql" ao invés de "mysqli" e passando parâmetros de forma correta
    $pdo = new PDO("mysql:host=$localhost;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "";
} catch (PDOException $e) {
    echo "Falha na conexão: " . $e->getMessage();
    exit;
}

?>
