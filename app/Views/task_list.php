<!DOCTYPE html>
<html>
<head>
    <title>Lista de Tarefas</title>
</head>
<body>
    <h1>Lista de Tarefas</h1>

    <?php if (!empty($tasks) && is_array($tasks)): ?>
        <ul>
            <?php foreach ($tasks as $task): ?>
                <li>
                    <strong><?= esc($task['title']) ?></strong>
                    - <?= esc($task['description']) ?>
                    (<?= esc($task['status']) ?>)
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Nenhuma tarefa encontrada.</p>
    <?php endif; ?>
</body>
</html>
