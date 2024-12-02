<?php

require 'config_db.php';


if (!isset($_SESSION['nome'])) {
    // Redirecionar para login 
    header('location: welcome.php');
    exit(); 
}

$nome = $_SESSION['nome'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    hello  <?php echo htmlspecialchars($nome); ?>
</body>
</html>