<?php
session_start();
require 'db_connection.php'; // połączenie PDO

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../blog.php'); // gdzie masz listę postów
    exit;
}

if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    die('Nieprawidłowy token CSRF');
}

$post_id = (int)$_POST['id'];
$autor = trim($_POST['autor']);
$content = trim($_POST['content']);

if ($post_id <= 0 || strlen($autor) < 3 || strlen($content) < 5) {
    die('Nieprawidłowe dane.');
}

$stmt = $pdo->prepare("
    INSERT INTO komentarze (autor, active, przepis_id, content, data)
    VALUES (:autor, 1, :post_id, :content, NOW())
");
$stmt->execute([
    ':autor' => $autor,
    ':post_id' => $post_id,
    ':content' => $content
]);

header("Location: ../single.php?id=".$post_id);
exit;
