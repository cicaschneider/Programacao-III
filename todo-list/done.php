<?php
require 'db.php';

if (!empty($_GET['id'])) {
    $stmt = $pdo->prepare("UPDATE tasks SET is_done = 1 WHERE id = :id");
    $stmt->execute(['id' => $_GET['id']]);
}

header('Location: index.php');
