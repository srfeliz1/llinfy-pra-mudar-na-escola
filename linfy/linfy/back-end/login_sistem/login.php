<?php
require 'config_db.php'; // Inclui a configuração do banco de dados


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os valores do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica se o e-mail existe no banco
    $sql = "SELECT * FROM users WHERE username = :email"; // Certifique-se de que o campo 'username' é um e-mail
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    // Verifica a senha
    if ($user && password_verify($senha, $user['password'])) {
        $_SESSION['user_id'] = $user['id']; // Define a sessão do usuário
        header("Location: http://localhost/linfy/back-end/curso_adicionar/index.php?sucesso=1"); // Redireciona para a página de boas-vindas
        exit;
    } else {
        $error = "E-mail ou senha incorretos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
                /* Resetando alguns estilos padrão */
                * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        /* Estilos gerais */
        body {
            background-color: #fff;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
        }

        .form-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            color: #ff00d4; /* Rosa suave */
            font-size: 24px;
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            color: #666;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            color: #333;
        }

        input:focus {
            border-color: #ff00d4; /* Cor do foco rosa */
            outline: none;
        }

        button {
            background-color: #ff00d4; /* Rosa */
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #e200bc; /* Rosa mais escuro no hover */
        }

        button:active {
            background-color: #c200a1; /* Rosa mais forte no click */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Linfy</h2>
            <p>Bem-vindo de volta!</p>
            <?php if (isset($error)): ?>
                <p style="color: red;"><?= $error ?></p> <!-- Exibe mensagem de erro -->
            <?php endif; ?>
            <form action="login.php" method="POST">
                <div class="input-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="Seu e-mail" required>
                </div>
                <div class="input-group">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" placeholder="Sua senha" required>
                </div>
                <button type="submit" class="btn">Entrar</button>
            </form>
        </div>
    </div>
</body>
</html>
