<?
require 'db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Localtion: localhost/linfy/back-end/login_system/register.php")
    exit();
}
$user = $_POST['username'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página de Cursos - Lynfi</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }
    body {
      display: flex;
      flex-direction: column;
      align-items: center;
      background-color: #f5f7fa;
      color: #333;
    }
    header {
      width: 100%;
      background-color: #4a90e2;
      color: #fff;
      padding: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 15px;
      position: relative;
    }
    header h1 {
      margin-bottom: 10px;
    }
    .add-course-button {
      position: absolute;
      top: 20px;
      left: 20px;
      padding: 12px 20px;
      width: 180px;
      border-radius: 5px;
      background-color: #fff;
      color: #4a90e2;
      font-size: 14px;
      border: none;
      cursor: pointer;
      box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
      transition: background-color 0.3s;
      text-align: center;
    }
    .add-course-button:hover {
      background-color: #e0e0e0;
    }
    .filters {
      display: flex;
      align-items: center;
      gap: 15px;
      width: 100%;
      max-width: 900px;
      justify-content: center;
    }
    .filters input[type="text"] {
      width: 40%;
      padding: 10px;
      border-radius: 5px;
      border: none;
      font-size: 16px;
    }
    .category-filter {
      position: relative;
    }
    .category-filter select {
      padding: 10px;
      border-radius: 5px;
      border: none;
      font-size: 14px;
      color: #4a90e2;
      background-color: #fff;
      cursor: pointer;
    }
    .price-filter {
      display: flex;
      align-items: center;
      color: #fff;
      font-size: 14px;
    }
    #priceFilter {
      margin: 0 10px;
      width: 100px;
    }
    #priceDisplay {
      font-weight: bold;
    }
    main {
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 20px;
      width: 100%;
    }
    #courses {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
      width: 100%;
      max-width: 900px;
    }
    .course {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      width: 250px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s, box-shadow 0.3s;
      cursor: pointer;
      opacity: 0;
      transform: translateY(20px);
    }
    .course:hover {
      transform: scale(1.05);
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
    }
    .course h3 {
      font-size: 18px;
      margin-bottom: 10px;
      color: #333;
    }
    .course p {
      font-size: 16px;
      color: #666;
    }
    .container {
      width: 100%;
      max-width: 500px;
      margin-top: 20px;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
    }
    .message {
      color: red;
      margin-bottom: 15px;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <header>
    <button class="add-course-button" onclick="document.getElementById('add-course-form').scrollIntoView();">Adicione seu curso</button>
    <h3>
        <? 
            echo $user htmlspecialchars['username'];
        ?>
    </h3>
    <h1>Cursos Online</h1>
    <div class="filters">
      <input type="text" id="search" placeholder="Buscar curso...">
      <div class="category-filter">
        <select id="categorySelect">
          <option value="">Todas as Categorias</option>
          <option value="Programação">Programação</option>
          <option value="Design">Design</option>
          <option value="Marketing">Marketing</option>
          <option value="Negócios">Negócios</option>
        </select>
      </div>
      <div class="price-filter">
        <label for="priceFilter">Preço:</label>
        <input type="range" id="priceFilter" min="0" max="500" step="50">
        <span id="priceDisplay">Até R$500</span>
      </div>
    </div>
  </header>
  <main>
    <section id="courses">
      <div class="course" data-category="Programação">
        <h3>Curso de JavaScript</h3>
        <p>Preço: R$150</p>
      </div>
      <div class="course" data-category="Programação">
        <h3>Curso de HTML e CSS</h3>
        <p>Preço: R$100</p>
      </div>
      <div class="course" data-category="Marketing">
        <h3>Curso de Marketing Digital</h3>
        <p>Preço: R$200</p>
      </div>
      <div class="course" data-category="Design">
        <h3>Curso de Design Gráfico</h3>
        <p>Preço: R$300</p>
      </div>
    </section>
    <!-- Formulário para adicionar um novo curso -->
    <?php
    include 'db.php';
    $mensagem = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['nome'];
        $categoria = $_POST['categoria'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        if (!empty($nome) && !empty($categoria) && !empty($preco)) {
            try {
                $sql = "INSERT INTO cursos (nome, categoria, descricao, preco) VALUES (:nome, :categoria, :descricao, :preco)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':categoria', $categoria);
                $stmt->bindParam(':descricao', $descricao);
                $stmt->bindParam(':preco', $preco);
                if ($stmt->execute()) {
                    header("Location: index.php");
                    exit();
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
    <div class="container" id="add-course-form">
        <h1>Adicionar Novo Curso</h1>
        <?php if (!empty($mensagem)): ?>
            <p class="message"><?php echo $mensagem; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
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
  </main>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const courses = document.querySelectorAll(".course");
      courses.forEach((course, index) => {
        setTimeout(() => {
          course.style.opacity = "1";
          course.style.transform = "translateY(0)";
        }, index * 100);
      });
    });
    const priceFilter = document.getElementById("priceFilter");
    const priceDisplay = document.getElementById("priceDisplay");
    priceFilter.addEventListener("input", () => {
      const maxPrice = priceFilter.value;
      priceDisplay.textContent = `Até R$${maxPrice}`;
      const courses = document.querySelectorAll(".course");
      courses.forEach((course) => {
        const price = parseInt(course.querySelector("p").textContent.replace("Preço: R$", ""));
        course.style.display = price <= maxPrice ? "block" : "none";
      });
    });
    const searchInput = document.getElementById("search");
    searchInput.addEventListener("input", () => {
      const searchText = searchInput.value.toLowerCase();
      const courses = document.querySelectorAll(".course");
      courses.forEach((course) => {
        const title = course.querySelector("h3").textContent.toLowerCase();
        course.style.display = title.includes(searchText) ? "block" : "none";
      });
    });
    const categorySelect = document.getElementById("categorySelect");
    categorySelect.addEventListener("change", () => {
      const selectedCategory = categorySelect.value;
      const courses = document.querySelectorAll(".course");
      courses.forEach((course) => {
        const courseCategory = course.getAttribute("data-category");
        course.style.display = selectedCategory === "" || selectedCategory === courseCategory ? "block" : "none";
      });
    });
  </script>
</body>
</html>