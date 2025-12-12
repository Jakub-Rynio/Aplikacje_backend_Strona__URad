<?php
session_start();
require 'db_connection.php';

if (!isset($_SESSION['moderator_login'])) {
    header('Location: ../login_form.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../posts.php');
    exit;
}

$coment_id = (int)$_POST['coment_id'];
$active = (int)$_POST['active'];

$stmt = $pdo->prepare("UPDATE komentarze SET active = :active WHERE id = :id");
$stmt->execute([
    ':active' => $active,
    ':id' => $coment_id
]);

header("Location: ../single.php?id=".$_POST['id']);
exit;
