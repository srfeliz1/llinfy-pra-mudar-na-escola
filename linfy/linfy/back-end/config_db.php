<?php
$localhost = "localhost";
$db = "linfy_database";
$pass = "";
$root = "root";

try {
    $pdo = new PDO(dsn: "mysqli:host=$localhost;dbname=$db", username: $root, password: $pass);
    $pdo->setAttribute(attribute: PDO::ATTR_ERRMODE, value: PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        exit;
    
}

?>