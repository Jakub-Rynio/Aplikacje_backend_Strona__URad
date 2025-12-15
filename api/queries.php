<?php

// posts
require 'db_connection.php';

function isSqlInjectionAttempt(string $input): bool {
    return (bool) preg_match(
        '/(\bor\b|\band\b)\s+1=1'
        . '|union\s+select'
        . '|--'
        . '|#'
        . '|;'
        . '|\bdrop\b|\bdelete\b|\bupdate\b|\binsert\b'
        . '|\'\s+or\s+\''
        . '|"?\s+or\s+"?/i',
        $input
);
}

function get_post_by_id($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM przepisy WHERE id = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function get_posts($admin = false, $zapytanie = "", $kategoria = "", $tytul = "", $autor = "") {
    global $pdo;

    $sql = "SELECT * FROM przepisy ";
    $params = [];

    if(isSqlInjectionAttempt($zapytanie) || isSqlInjectionAttempt($kategoria) || isSqlInjectionAttempt($tytul) || isSqlInjectionAttempt($autor)){
        header("Location: https://www.youtube.com/watch?v=20zdTZjvhUA");
        exit;

    };


    if ($admin) {
        $sql .= "WHERE (active = 1 OR active = 0)";
    }else{$sql .= "WHERE active = 1";}

    if ($zapytanie !== "") {
        $sql .= " AND ( tresc LIKE :zapytanie)";
        $params['zapytanie'] = "%" . $zapytanie . "%";
    }

    if ($kategoria !== "") {
        $sql .= " AND kategoria LIKE :kategoria";
        $params['kategoria'] = "%" . $kategoria . "%";
    }

    if ($tytul !== "") {
        $sql .= " AND tytul LIKE :tytul";
        $params['tytul'] = "%" . $tytul . "%";
    }

    if ($autor !== "") {
        $sql .= " AND dodane_przez LIKE :autor";
        $params['autor'] = "%" . $autor . "%";
    }

    $sql .= " ORDER BY id DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_post_title($post) {
    return htmlspecialchars($post['tytul']);
}

function get_post_active($post) {
    return htmlspecialchars($post['active']);
}

function get_post_category($post) {
    return htmlspecialchars($post['kategoria']);
}

function get_post_content($post) {
    return nl2br(htmlspecialchars($post['tresc']));
}

function get_post_opis($post) {
    return nl2br(htmlspecialchars($post['opis']));
}

function get_post_image($post) {
    if (empty($post['obrazek'])) {
        return null;
    }
    return '../assets/img/blog/' . htmlspecialchars($post['obrazek']);
}

function get_post_id($post) {
    return htmlspecialchars($post['id']);
}

function get_post_date($post){
    return htmlspecialchars($post['data']);
}
 
// Pobranie wszystkich komentarzy
function get_all_comments() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM komentarze ORDER BY data DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Pobranie komentarzy tylko dla konkretnego posta
function get_comments_by_post($post_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM komentarze WHERE przepis_id = :id ORDER BY data ASC");
    $stmt->execute([':id' => $post_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Pobranie komentarzy tylko dla konkretnego posta
function get_active_comments_by_post($post_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM komentarze WHERE przepis_id = :id AND active = 1 ORDER BY data ASC");
    $stmt->execute([':id' => $post_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Funkcje pomocnicze dla pojedynczego komentarza

function get_comment_author($comment) {
    return htmlspecialchars($comment['autor']);
}

function get_comment_content($comment) {
    return nl2br(htmlspecialchars($comment['content']));
}

function get_comment_date($comment) {
    return htmlspecialchars($comment['data']);
}
