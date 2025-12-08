<?php
session_start();
echo "Witaj, " . htmlspecialchars($_SESSION['moderator_login']);
if (!isset($_SESSION['moderator_login'])) {
    // użytkownik nie jest zalogowany
    header("Location: ../login_form.php");
    exit;
}

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<form method="post" action="/api/add_user.php">
    <label>
        Login:
        <input type="text" name="login" required minlength="3">
    </label><br>

    <label>
        Hasło:
        <input type="password" name="haslo" required minlength="8">
    </label><br>

    <button type="submit">Dodaj moderatora</button>
</form>

<?php

// Generowanie tokenu CSRF, jeśli go nie ma
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<form method="post" action="/api/add_post.php" enctype="multipart/form-data">
    <label>
        Tytuł:
        <input type="text" name="tytul" required minlength="3">
    </label><br>

    <label>
        Kategoria:
        <input type="text" name="kategoria" required minlength="3">
    </label><br>

    <label>
        Zdjęcie:
        <input type="file" name="zdjecie" accept="image/*" required>
    </label><br>

    <label>
        Treść:
        <textarea name="content" required minlength="5"></textarea>
    </label><br>

    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <button type="submit">Dodaj post</button>
</form>
