<?php
session_start();
require 'db_connection.php'; // połączenie PDO

// 1️⃣ Sprawdzenie metody POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../posts.php'); // gdzie masz listę postów
    exit;
}

if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    die('Nieprawidłowy token CSRF');
}

// 3️⃣ Odbiór danych z formularza
$post_id = (int)$_POST['id'];
$tytul = trim($_POST['tytul']);
$autor = trim($_POST['autor']);
$content = trim($_POST['content']);

// 4️⃣ Prosta walidacja
if ($post_id <= 0 || strlen($tytul) < 3 || strlen($autor) < 3 || strlen($content) < 5) {
    die('Nieprawidłowe dane.');
}

// 5️⃣ Wstawienie do bazy danych
$stmt = $pdo->prepare("
    INSERT INTO komentarze ( tytul, autor, active, przepis_id, content, data)
    VALUES (:tytul, :autor, 1, :post_id, :content, NOW())
");
$stmt->execute([
    ':tytul' => $tytul,
    ':autor' => $autor,
    ':post_id' => $post_id,
    ':content' => $content
]);

// 6️⃣ Przekierowanie lub komunikat
header("Location: ../blog.php");
exit;
