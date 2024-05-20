<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
try {
    $db = new PDO('mysql:host=localhost;dbname=arcadia;charset=utf8;port=3307', 'root', '');
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
