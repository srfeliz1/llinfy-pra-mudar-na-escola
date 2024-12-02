<?php

require 'config_db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST["nome"]);
    $mini_descricao = trim($_POST["mini_descricao"]);
    $descricao = trim($_POST["descricao"]);
    $categoria = trim($_POST["categoria"]);
    $preco = floatval($_POST["preco"]);
    $link = trim($_POST["link"]);
    $imagem = $_FILES["imagem"];

    if (!empty($nome) && !empty($mini_descricao) && !empty($descricao) && !empty($categoria) && $preco >= 0 && $imagem["size"] > 0) {
        // Upload da imagem
        $pasta_destino = "uploads/";
        $nome_arquivo = time() . "_" . basename($imagem["name"]);
        $caminho_completo = $pasta_destino . $nome_arquivo;

        if (move_uploaded_file($imagem["tmp_name"], $caminho_completo)) {
            // Insere os dados no banco
            $sql = "INSERT INTO cursos (nome, mini_descricao, descricao, link, categoria, preco, imagem) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssss", $nome, $mini_descricao, $descricao, $link, $categoria, $preco, $caminho_completo);

            if ($stmt->execute()) {
                header("Location: index.php?sucesso=1");
                exit();
            } else {
                $erro =  "Erro ao adicionar curso: " . $conn->error;
            }
        } else {
            $erro = "Falha ao fazer upload da imagem.";
        }
    } else {
        $erro = "Por favor, preencha todos os campos corretamente!";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Curso</title>
    <style>
        /* Corpo geral */
        body {
            font-family: 'Roboto', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Formulário */
        form {
            background-color: #fff;
            max-width: 500px;
            width: 100%;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        form h2 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        /* Labels */
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        /* Inputs, Textarea, Select e Botão */
        input, textarea, select, button {
            width: 100%;
            padding: 12px 16px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }

        input:focus, textarea:focus, select:focus {
            border-color: #999;
            outline: none;
            box-shadow: 0 0 5px rgba(150, 150, 150, 0.5);
        }

        button {
            background-color: #ff4081;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            border: none;
            padding: 14px 16px;
            font-size: 16px;
            text-transform: uppercase;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #e91e63;
        }

        /* Mensagem de erro */
        .erro {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            text-align: center;
        }

        /* Responsividade */
        @media (max-width: 600px) {
            form {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <form method="POST" action="" enctype="multipart/form-data">
        <h2>Adicionar Curso</h2>
        <?php if (isset($erro)): ?>
            <p class="erro"><?php echo $erro; ?></p>
        <?php endif; ?>
        <label for="nome">Nome do Curso:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="mini_descricao">Descrição Curta:</label>
        <input type="text" id="mini_descricao" name="mini_descricao" required>

        <label for="link">Link:</label>
        <input type="text" id="link" name="link" required>

        <label for="descricao">Descrição Completa:</label>
        <textarea id="descricao" name="descricao" rows="4" required></textarea>

        <label for="categoria">Categoria:</label>
        <select id="categoria" name="categoria" required>
            <option value="Programação">Programação</option>
            <option value="Design">Design</option>
            <option value="Marketing">Marketing</option>
            <option value="Negócios">Negócios</option>
            <option value="Saude">Saúde</option>
        </select>

        <label for="preco">Preço (R$):</label>
        <input type="number" id="preco" name="preco" min="0" step="0.01" required>

        <label for="imagem">Imagem do Curso:</label>
        <input type="file" id="imagem" name="imagem" accept="image/*" required>

        <button type="submit">Adicionar Curso</button>
    </form>
</body>
</html>