<?php
require 'db.php';

if (!empty($_POST['title'])) {
    $stmt = $pdo->prepare("INSERT INTO tasks (title) VALUES (:title)");
    $stmt->execute(['title' => $_POST['title']]);
}

header('Location: index.php');
