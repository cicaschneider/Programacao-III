<!DOCTYPE html>
<html>
<head>
    <title>Criar Tarefa</title>
</head>
<body>
    <h1>Criar Nova Tarefa</h1>
    <form method="post" action="/task/store">
        <label>Título:</label><br>
        <input type="text" name="title" required><br><br>

        <label>Descrição:</label><br>
        <textarea name="description"></textarea><br><br>

        <label>Status:</label><br>
        <select name="status">
            <option value="pending">Pendente</option>
            <option value="in progress">Em progresso</option>
            <option value="done">Concluído</option>
        </select><br><br>

        <button type="submit">Salvar</button>
    </form>
    <br>
    <a href="/task">Voltar</a>
</body>
</html>
