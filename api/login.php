<?php
session_start();
require 'db_connection.php';

$PEPPER = getenv('PASSWORD_PEPPER')
    or die('Nie przyprawione :)');

if (!isset($_POST['login'], $_POST['haslo'], $_POST['csrf_token'])) {
    die('Brak danych');
}

// Weryfikacja tokenu CSRF
if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    die('Nieprawidłowy token CSRF');
}

$login = trim($_POST['login']);
$password = $_POST['haslo'];
$pepper_passwd = hash_hmac('sha256', $password, $PEPPER);

// Pobranie hash z bazy
$stmt = $pdo->prepare("SELECT password FROM moderatorzy WHERE login = :login AND active = 1");
$stmt->execute([':login' => $login]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($pepper_passwd, $user['password'])) {

    // Opcjonalny rehash
    if (password_needs_rehash($user['password'], PASSWORD_DEFAULT)) {
        $newHash = password_hash($pepper_passwd, PASSWORD_DEFAULT);
        $update = $pdo->prepare("UPDATE moderatorzy SET password = :password WHERE login = :login");
        $update->execute([
            ':password' => $newHash,
            ':login' => $login
        ]);
    }

    // Zapisanie info do sesji
    $_SESSION['moderator_login'] = $login;
    header('Location: ../control_panel.php');

} else {
    header('Location: ../invalid_password.php');
}
