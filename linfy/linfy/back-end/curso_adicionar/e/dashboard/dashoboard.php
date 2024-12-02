<?php 

require 'config_db.php';

$sql = "SELECT id, nome, preco, link, mini_descricao, descricao, categoria, imagem FROM cursos ORDER BY nome ASC ";
$result = $conn->query($sql);

if (!$result) {
    die("Erro ao executar consulta: " . $conn->error);
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DEDSEC DashBorad - Linfy</title>
    <style>
/* Estilo Global */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Arial', sans-serif;
}

body {
    background-color: #f4f4f9;
    color: #333;
    padding: 20px;
}

main {
    max-width: 1200px;
    margin: 0 auto;
}

/* Container dos Cursos */
section {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

/* Estilização dos Cards de Cursos */
.course {
    background-color: #ffffff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease;
}

.course:hover {
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
}

.course-image img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-radius: 6px;
    margin-bottom: 15px;
}

.course h3 {
    font-size: 1.5rem;
    color: #333;
    margin-bottom: 10px;
}

.course p {
    font-size: 1rem;
    color: #555;
    margin-bottom: 15px;
}

button {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #0056b3;
}

/* Resposta para quando não houver cursos */
section p {
    grid-column: 1 / -1;
    text-align: center;
    font-size: 1.2rem;
    color: #999;
}

/* Responsividade */
@media (max-width: 600px) {
    .course h3 {
        font-size: 1.2rem;
    }
    button {
        font-size: 0.9rem;
    }
}
        
    </style>
</head>
<body>
    <main>
        <section>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="course" data-category="' . htmlspecialchars($row["categoria"]) . '" data-price="' . htmlspecialchars($row["preco"]) . '">';
                    echo '<div class="course-image">
                    <img src="' . $row["imagem"] . '" alt="' . htmlspecialchars($row["nome"]) . '">';
                    echo '</div>';
                    echo '<h3>' . htmlspecialchars($row["nome"]) . '</h3>';
                    echo '<p>Preço: R$' . htmlspecialchars($row["preco"]) . '</p>';
                    echo '<p>' . htmlspecialchars($row["mini_descricao"]) . '</p>';
                    echo '<button onclick="location.href=\'' . $row["link"] . '\'">Ver Curso</button>';
                    
                    echo '</div>';    
                }
            } else {
                echo '<p>Nenhum curso encontrado.</p>';
            }
            ?>
        </section>
    </main>
</body>
</html>