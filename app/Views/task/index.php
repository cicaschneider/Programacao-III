<?php helper('url'); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Lista de Tarefas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            border-radius: 0 0 12px 12px;
        }

        .list-group-item {
            border: none;
            border-radius: 12px;
            margin-bottom: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            background-color: #ffffff;
        }

        .badge {
            font-size: 0.85rem;
            padding: 0.5em 0.7em;
            border-radius: 12px;
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-danger:hover {
            background-color: #bb2d3b;
        }

        .btn-light {
            color: #0d6efd;
            font-weight: 500;
        }

        .btn-light:hover {
            background-color: #e2e6ea;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?= base_url('task') ?>">Lista de Tarefas</a>
        <div>
            <a href="<?= base_url('task/create') ?>" class="btn btn-light">+ Nova Tarefa</a>
        </div>
    </div>
</nav>

<div class="container mb-5">

    <!-- Formulário de busca e filtro -->
    <form method="get" action="<?= base_url('task') ?>" class="mb-4 d-flex gap-2 flex-wrap align-items-center">
        <input
            type="text"
            name="search"
            class="form-control flex-grow-1"
            placeholder="Buscar tarefas..."
            value="<?= esc($search ?? '') ?>"
        >
        <select name="status" class="form-select" style="max-width: 150px;">
            <option value="">Todos os status</option>
            <option value="pending" <?= (isset($status) && $status === 'pending') ? 'selected' : '' ?>>Pendente</option>
            <option value="done" <?= (isset($status) && $status === 'done') ? 'selected' : '' ?>>Feita</option>
        </select>
        <button type="submit" class="btn btn-primary">Filtrar</button>
    </form>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= esc(session()->getFlashdata('success')) ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($tasks)): ?>
        <ul class="list-group">
            <?php foreach ($tasks as $task): ?>
                <li class="list-group-item d-flex justify-content-between align-items-start flex-wrap">
                    <div class="me-auto">
                        <?= esc($task['title']) ?> - <?= esc($task['description']) ?>

                        <?php if (!empty($task['deadline'])): ?>
                            <span class="badge bg-secondary ms-2">Prazo: <?= esc(date('d/m/Y', strtotime($task['deadline']))) ?></span>
                        <?php endif; ?>

                        <?php if (!empty($task['categories'])): ?>
                            <div class="mt-2">
                                <?php foreach ($task['categories'] as $category): ?>
                                    <span class="badge bg-info text-dark"><?= esc($category['name']) ?></span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <div class="mt-2 d-flex align-items-center gap-2">
                            <span class="badge bg-<?= $task['status'] === 'done' ? 'success' : 'warning text-dark' ?>">
                                <?= $task['status'] === 'done' ? 'Feita' : 'Pendente' ?>
                            </span>

                            <?php if ($task['status'] === 'pending'): ?>
                                <form action="<?= base_url('task/markdone/' . $task['id']) ?>" method="post" style="display:inline;">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-sm btn-success" title="Marcar como feita">
                                        ✓
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="d-flex flex-column align-items-end">
                        <a href="<?= base_url('task/edit/' . $task['id']) ?>" class="btn btn-sm btn-primary mb-1">Editar</a>
                        <form action="<?= base_url('task/delete/' . $task['id']) ?>" method="post" onsubmit="return confirm('Tem certeza que deseja excluir esta tarefa?');">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                        </form>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <div class="alert alert-info mt-3">Nenhuma tarefa encontrada.</div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
