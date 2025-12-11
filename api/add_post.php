<?php
session_start();
require 'db_connection.php'; // Twoje połączenie PDO

if (!isset($_SESSION['moderator_login'])) {
    header('Location: login_form.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: add_post_form.php');
    exit;
}

if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    die('Nieprawidłowy token CSRF');
}
$moderator = $_SESSION['moderator_login'];
$tytul = trim($_POST['tytul']);
$kategoria = trim($_POST['kategoria']);
$content = trim($_POST['content']);
$opis = trim($_POST['opis']);

// Walidacja podstawowa
if (strlen($tytul) < 3 || strlen($kategoria) < 3 || strlen($content) < 5) {
    die('Nieprawidłowe dane');
}

$zdjecieFileName = null; // domyślnie brak zdjęcia

if (isset($_FILES['zdjecie']) && $_FILES['zdjecie']['error'] === UPLOAD_ERR_OK) {
    $tmpName = $_FILES['zdjecie']['tmp_name'];
    
    // Sprawdzenie typu pliku (tylko obrazki)
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array(mime_content_type($tmpName), $allowedTypes)) {
        die('Niepoprawny typ pliku!');
    }

    // Pobranie rozszerzenia
    $extension = pathinfo($_FILES['zdjecie']['name'], PATHINFO_EXTENSION);

    // Generowanie unikalnej nazwy
    $zdjecieFileName = time() . '_' . uniqid() . '.' . $extension;

    // Przeniesienie pliku
    move_uploaded_file($tmpName, "../assets/img/blog/$zdjecieFileName");
}

$stmt = $pdo->prepare("
    INSERT INTO przepisy (tytul, kategoria, obrazek, tresc, dodane_przez, active, data, opis)
    VALUES (:tytul, :kategoria, :obrazek, :tresc, :dodane_przez, 1, NOW(), :opis)
");
$stmt->execute([
    ':tytul' => $tytul,
    ':kategoria' => $kategoria,
    ':obrazek' => $zdjecieFileName,
    ':tresc' => $content,
    ':dodane_przez' => $moderator,
    ':opis' => $opis
]);

echo "Post został dodany pomyślnie!";
