<?php
// Inclui o arquivo de conexão com o banco de dados
include 'db.php';
// Inicializa uma mensagem de sucesso ou erro
$mensagem = '';
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $categoria = $_POST['categoria'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    // Validação simples para garantir que todos os campos obrigatórios estão preenchidos
    if (!empty($nome) && !empty($categoria) && !empty($preco)) {
        try {
            // Prepara e executa o comando de inserção no banco de dados
            $sql = "INSERT INTO cursos (nome, categoria, descricao, preco) VALUES (:nome, :categoria, :descricao, :preco)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':categoria', $categoria);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':preco', $preco);
            // Executa a consulta e verifica se foi bem-sucedida
            if ($stmt->execute()) {
                // Redireciona para a página de pesquisa após a inserção
                header("Location: index.php");
                exit(); // Importante para encerrar o script após o redirecionamento
            } else {
                $mensagem = "Erro ao adicionar o curso.";
            }
        } catch (PDOException $e) {
            $mensagem = "Erro: " . $e->getMessage();
        }
    } else {
        $mensagem = "Por favor, preencha todos os campos obrigatórios.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Curso</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Adicionar Novo Curso</h1>
        <!-- Exibe a mensagem de sucesso ou erro -->
        <?php if (!empty($mensagem)): ?>
            <p class="message"><?php echo $mensagem; ?></p>
        <?php endif; ?>
        <!-- Formulário para adicionar um novo curso -->
        <form method="POST" action="adicionar_curso.php">
            <label for="nome">Nome do Curso</label>
            <input type="text" name="nome" id="nome" required>
            <label for="categoria">Categoria</label>
            <input type="text" name="categoria" id="categoria" required>
            <label for="descricao">Descrição</label>
            <textarea name="descricao" id="descricao"></textarea>
            <label for="preco">Preço (R$)</label>
            <input type="number" name="preco" id="preco" step="0.01" required>
            <button type="submit">Adicionar Curso</button>
        </form>
    </div>
</body>
</html>