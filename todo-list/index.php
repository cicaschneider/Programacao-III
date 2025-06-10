<?php
require 'db.php';

// Buscar tarefas do banco de dados
$stmt = $pdo->query("SELECT * FROM tasks ORDER BY created_at DESC");
$tasks = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Lista de Tarefas</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
  <div class="container">
    <h1>Lista de Tarefas</h1>

    <form action="add.php" method="POST">
        <input type="text" name="title" required placeholder="Nova tarefa">
        <button type="submit">Adicionar</button>
    </form>

    <ul>
  <?php foreach ($tasks as $task): ?>
    <li class="task <?= $task['is_done'] ? 'done' : '' ?>">
      <?= $task['is_done'] ? '<s>' . htmlspecialchars($task['title']) . '</s>' : htmlspecialchars($task['title']) ?>
      <span class="actions">
        <a href="done.php?id=<?= $task['id'] ?>" title="Marcar como feita">
          <i class="fas fa-check-circle"></i>
        </a>
        <a href="delete.php?id=<?= $task['id'] ?>" title="Excluir tarefa">
          <i class="fas fa-trash-alt"></i>
        </a>
      </span>
    </li>
  <?php endforeach; ?>
</ul>

  </div>
</body>
</html>
