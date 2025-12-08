<?php
session_start();

if (isset($_SESSION['moderator_login'])) {
    echo "Witaj, " . htmlspecialchars($_SESSION['moderator_login']);
    // użytkownik nie jest zalogowany
    echo "Jestes zalogowany!";
    echo '<a href="/api/logout.php">Wyloguj się!</a>';
    
}

// Generowanie tokenu CSRF, jeśli go nie ma
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<form method="post" action="api/login.php">
    <label>
        Login:
        <input type="text" name="login" required>
    </label><br>
    <label>
        Hasło:
        <input type="password" name="haslo" required>
    </label><br>
    
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    <button type="submit">Zaloguj się</button>
</form>
