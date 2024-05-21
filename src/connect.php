<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$host = getenv('DATABASE_HOST') ?: 'localhost';
$dbname = getenv('DATABASE_NAME') ?: 'arcadia';
$username = getenv('DATABASE_USER') ?: 'root';
$password = getenv('DATABASE_PASSWORD') ?: '';
$port = getenv('DATABASE_PORT') ?: '3307';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8;port=$port", $username, $password);
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

if (isset($_SESSION['role_id'])) {
    $req = $db->prepare('SELECT * FROM roles WHERE role_id = ?');
    $req->execute(array($_SESSION['role_id']));
    $current_user_role = $req->fetch();
}

$req = $db->query("SELECT * FROM habitat");
$headerHabitats = $req->fetchAll();
?>
