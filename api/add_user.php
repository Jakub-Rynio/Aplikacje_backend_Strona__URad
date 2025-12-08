<?php
require 'db_connection.php'; // podłączamy połączenie


session_start();

if (!isset($_SESSION['moderator_login'])) {
    // użytkownik nie jest zalogowany
    header("Location: ../login_form.php");
    exit;
}

// tutaj możesz np. wyświetlić panel
echo "Witaj, " . htmlspecialchars($_SESSION['moderator_login']);

if (!isset($_POST['login'], $_POST['haslo'])) {
    die('Brak danych');
}

if ($_POST['login'])

$moderator = trim($_POST['login']);
// Sprawdzenie długości
if (strlen($moderator) < 3 || strlen($moderator) > 20) {
    die('Login musi mieć od 3 do 20 znaków');
}
// Sprawdzenie dozwolonych znaków (litery, cyfry, podkreślenie)
if (!preg_match('/^[a-zA-Z0-9_]+$/', $moderator)) {
    die('Login może zawierać tylko litery, cyfry i znak podkreślenia');
}

$password = $_POST['haslo'];
$active = True;
$password_hash = password_hash($password, PASSWORD_DEFAULT);
// hash


try {
    $stmt = $pdo->prepare(
        "INSERT INTO moderatorzy (login, password, active)
        VALUES (:moderator, :password, :active)"
    );

    $stmt->execute([
        ':moderator' => $moderator,
        ':password'  => $password_hash,
        ':active'    => $active
    ]);

} catch (PDOException $e) {
     if ($e->getCode() == 23000) {
        echo "UŻYTKOWNIK_ISTNIEJE";
    } else {
        echo "BŁĄD_SERWERA";
    }
}