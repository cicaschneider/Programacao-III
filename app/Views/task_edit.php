<!DOCTYPE html>
<html>
<head>
    <title>Editar Tarefa</title>
</head>
<body>
    <h1>Editar Tarefa</h1>
    <form method="post" action="/task/update/<?= $task['id'] ?>">
        <label>Título:</label><br>
        <input type="text" name="title" value="<?= esc($task['title']) ?>" required><br><br>

        <label>Descrição:</label><br>
        <textarea name="description"><?= esc($task['description']) ?></textarea><br><br>

        <label>Status:</label><br>
        <select name="status">
            <option value="pending" <?= $task['status'] == 'pending' ? 'selected' : '' ?>>Pendente</option>
            <option value="in progress" <?= $task['status'] == 'in progress' ? 'selected' : '' ?>>Em progresso</option>
            <option value="done" <?= $task['status'] == 'done' ? 'selected' : '' ?>>Concluído</option>
        </select><br><br>

        <button type="submit">Atualizar</button>
    </form>
    <br>
    <a href="/task">Voltar</a>
</body>
</html>
