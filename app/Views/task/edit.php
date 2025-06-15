<?php helper('url'); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Tarefa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            padding: 2rem;
            background-color: #fff;
        }

        .form-label {
            font-weight: 500;
        }

        .btn-primary {
            background-color: #4a90e2;
            border: none;
        }

        .btn-primary:hover {
            background-color: #3a78c2;
        }

        .btn-secondary {
            background-color: #adb5bd;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #929ba1;
        }

        .alert {
            border-radius: 12px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card">
                <h3 class="mb-4 text-center">Editar Tarefa</h3>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                        <?= esc(session()->getFlashdata('success')) ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php
                // Ajusta valor do deadline para evitar data inválida (0000-00-00)
                $deadlineValue = old('deadline', $task['deadline'] ?? '');
                if ($deadlineValue === '0000-00-00' || empty($deadlineValue)) {
                    $deadlineValue = '';
                }

                // Define categorias selecionadas: do POST ou da tarefa (array de IDs)
                $selectedCategories = old('categories') ?? $taskCategoryIds ?? [];
                if (!is_array($selectedCategories)) {
                    $selectedCategories = [];
                }
                ?>

                <form method="post" action="<?= base_url('task/update/' . esc($task['id'])) ?>">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="title" class="form-label">Título</label>
                        <input type="text" class="form-control" id="title" name="title"
                               value="<?= old('title', $task['title']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descrição</label>
                        <textarea class="form-control" id="description" name="description" rows="3"><?= old('description', $task['description']) ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="pending" <?= old('status', $task['status']) === 'pending' ? 'selected' : '' ?>>Pendente</option>
                            <option value="done" <?= old('status', $task['status']) === 'done' ? 'selected' : '' ?>>Feita</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="deadline" class="form-label">Prazo:</label>
                        <input type="date" class="form-control" id="deadline" name="deadline" value="<?= esc($deadlineValue) ?>">
                    </div>

                    <!-- ✅ Categorias -->
                    <div class="mb-3">
                        <label class="form-label">Categorias</label>
                        <div class="row">
                            <?php foreach ($categories as $category): ?>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                               name="categories[]"
                                               id="cat<?= $category['id'] ?>"
                                               value="<?= $category['id'] ?>"
                                               <?= in_array($category['id'], $selectedCategories) ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="cat<?= $category['id'] ?>">
                                            <?= esc($category['name']) ?>
                                        </label>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="<?= base_url('task') ?>" class="btn btn-secondary">Voltar</a>
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
