<?php
require_once ('src/connect.php');
if (isset($_SESSION['connect']) && $current_user_role['role_name'] == 'admin') {
    if (isset($_GET['role']) && !empty($_GET['role'])) {
        $role = (int) $_GET['role'];
        $req = $db->prepare('UPDATE users SET role_id = 1 WHERE id = ?');
        $req->execute(array($role));
        if ($role == 0) {
            header('location:logout.php');
        }
    }
    //Devenir administrateur
    if (isset($_GET['administrateur']) && !empty($_GET['administrateur'])) {
        $role = (int) $_GET['administrateur'];
        $req = $db->prepare('UPDATE users SET role_id = 1 WHERE id = ?');
        $req->execute(array($role));
    }
    //Devenir veterinaire
    if (isset($_GET['veterinaire']) && !empty($_GET['veterinaire'])) {
        $role = (int) $_GET['veterinaire'];
        $req = $db->prepare('UPDATE users SET role_id = 2 WHERE id = ?');
        $req->execute(array($role));
    }
    //Devenir employer
    if (isset($_GET['employe']) && !empty($_GET['employe'])) {
        $role = (int) $_GET['employe'];
        $req = $db->prepare('UPDATE users SET role_id = 3 WHERE id = ?');
        $req->execute(array($role));
    }
    //supprimer
    if (isset($_GET['supprimer']) && !empty($_GET['supprimer'])) {
        $user = (int) $_GET['supprimer'];
        $req = $db->prepare('DELETE FROM users WHERE id = ?');
        $req->execute(array($user));
    }

    // Vérifie si le formulaire est soumis
    if (!empty($_POST['mail']) && !empty($_POST['pass'])) {

        $mail = htmlspecialchars($_POST['mail']);
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $pass = htmlspecialchars($_POST['pass']);
        $role = 3;

        // Vérifie si l'adresse email est déjà enregistrée
        $req = $db->prepare('SELECT COUNT(*) AS mailNb FROM users WHERE mail = ?');
        $req->execute(array($mail));

        $mailVerif = $req->fetch();
        if ($mailVerif['mailNb'] != 0) {
            header('location:administration.php?error=1&message=Votre adresse mail est déjà enregistrée.');
            exit();
        }

        // Vérifie si l'adresse email est valide
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            header('location:administration.php?error=1&message=Votre adresse mail est invalide.');
            exit();
        }

        // Génère un "secret" pour l'utilisateur
        $secret = sha1($mail) . time();
        // Hache le mot de passe avec bcrypt
        $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);

        // Insère l'utilisateur dans la base de données
        $req = $db->prepare('INSERT INTO users(mail, pseudo, pass, secrets, role_id) VALUES (?, ?, ?, ?, ?)');
        $req->execute(array($mail, $pseudo, $hashedPassword, $secret, $role));
        // Redirige l'utilisateur vers la page d'inscription avec un message de succès
        header('location:administration.php?success=1');
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['update_hours'])) {
            // Récupérer les données du formulaire
            $semaine = htmlspecialchars($_POST['semaine']);
            $weekend = htmlspecialchars($_POST['weekend']);

            // Chemin vers le fichier à mettre à jour
            $file_path = 'src/arcFooter.php';

            // Lire le contenu du fichier
            $file_contents = file_get_contents($file_path);

            // Remplacer les anciennes lignes des horaires avec les nouvelles
            $new_contents = preg_replace('/<span id="semaine">.*?<\/span>/', '<span id="semaine">' . $semaine . '</span>', $file_contents);
            $new_contents = preg_replace('/<span id="weekend">.*?<\/span>/', '<span id="weekend">' . $weekend . '</span>', $new_contents);
            // Écrire le nouveau contenu dans le fichier
            file_put_contents($file_path, $new_contents);
        }
    }
    $req = $db->query('SELECT * FROM users');
    $membre = $req->fetchAll();

} else {
    header('location:connexion.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="design/style.css">
    <link rel="stylesheet" href="design/custom.css">
    <link rel="icon" href="image/iconarcadia.ico">
    <title>Arcadia</title>
    <script>
        // Affiche une boîte de dialogue de confirmation
        function confirmDelete() {
            var confirmation = confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?");
            if (confirmation) {
                return true; // Autorise la suppression en suivant le lien
            } else {
                return false; // Annule la suppression
            }
        }
    </script>
</head>

<body class="bg-arcadiaLight">




    <?php
    include ('src/arcHeader.php');
    ?>
    <div class="m-5">
        <div class="m-5 text-center">
            <div class="card text-center mx-auto w-75 border-2 border-arcadiaSecondary">
                <div class="card-header fs-5 p-3 bg-arcadia border- border-arcadiaSecondary">
                    Connexion
                </div>
                <div class="card-body bg-grey p-5">
                    <h2 class="text-success">Vous êtes connecté en tant que </h2>
                    <p class="text-arcadiaTertiary fs-3 m-3"><?= $current_user_role['role_name']; ?></p>

                    <p class="fs-4">Vous pouvez modifier les données du site.</p>
                    <button type="submit"
                        class="btn btn-arcadia text-arcadiaTertiary border-arcadiaTertiary border-1"><a class="nav-link"
                            href="src/logout.php"><b>Deconnexion</b></a></button>
                </div>
                <div class="card-footer fs-5 bg-arcadia p-3 border-1 border-arcadiaSecondary">
                    Administateur
                </div>
            </div>
        </div>
    </div>
    <div class="container rounded border border-2 bg-grey border-arcadiaSecondary text-center mx-auto my-5">
        <h3 class="bg-arcadia mx-auto my-3 border border-1 border-arcadiaSecondary w-25 rounded p-3">Modifier les
            horaires du zoo</h3>
        <form method="post" action="administration.php">
            <label for="semaine">Horaires de la semaine (Lundi - Vendredi) :</label>
            <input type="text" id="semaine" name="semaine"
                class="form-control border-1 border-arcadiaSecondary text-center d-flex mx-auto w-25"
                placeholder="format : ?h à ?h" required><br>

            <label for="weekend">Horaires du weekend :</label>
            <input type="text" id="weekend" name="weekend"
                class="form-control border-1 border-arcadiaSecondary text-center d-flex mx-auto w-25"
                placeholder="format : ?h à ?h" required><br>

            <input type="submit"  class="btn btn-arcadia text-arcadiaTertiary border-arcadiaTertiary border-1" name="update_hours" value="Mettre à jour">
        </form>
    </div>
    <div class="container rounded border border-2 bg-grey border-arcadiaSecondary text-center">
        <h3 class="bg-arcadia mx-auto my-3 border border-1 border-arcadiaSecondary w-25 rounded p-3">Utilisateur</h3>
        <ul class="list-group">
            <?php foreach ($membre as $m) { ?>
                <li class="list-group-item bg-grey">
                    <?= $m['pseudo'] ?> : <?= $m['mail'] ?> : <?= $m['role_id']; ?> :
                    <?php if ($m['role_id'] == 1) { ?>
                        <span class="text-success"><b>Administateur </b></span> <b><a
                                class="nav-link d-inline text-arcadiaTertiary"
                                href="administration.php?role=<?= $m['id'] ?>"></b>
                    <?php } else if ($m['role_id'] == 2) { ?>
                            <span class="text-success"><b>Vétérinaire |</b></span> <b><a
                                    class="nav-link d-inline text-arcadiaTertiary"
                                    href="administration.php?role=<?= $m['id'] ?>"></b><b><a
                                    class="nav-link d-inline text-arcadiaTertiary"
                                    href="administration.php?employe=<?= $m['id'] ?>">Employé ? - </a></b>
                            <b><a class="nav-link d-inline text-danger" href="administration.php?supprimer=<?= $m['id'] ?>"
                                    onclick="return confirmDelete()">Supprimer ?</a></b>
                            </a></b>
                    <?php } else if ($m['role_id'] == 3) { ?>
                                <span class="text-success"><b>Employé |</b></span> <b><a class="nav-link d-inline text-arcadiaTertiary"
                                        href="administration.php?role=<?= $m['id'] ?>"></b>
                                <b><a class="nav-link d-inline text-arcadiaTertiary"
                                        href="administration.php?veterinaire=<?= $m['id'] ?>">Vétérinaire ? - </a></b>
                                <b><a class="nav-link d-inline text-danger" href="administration.php?supprimer=<?= $m['id'] ?>"
                                        onclick="return confirmDelete()">Supprimer ?</a></b>
                                </a></b>
                    <?php }
            } ?>
            </li>
        </ul>
    </div>
    <!-- FORMULAIRE D'INSCRIPTION -->

    <div class="m-5">
        <div class="mb-3 text-center">
            <form action="administration.php" method="post">
                <label for="mail" class="form-label fs-4">Adresse email</label>
                <input type="email" name="mail"
                    class="form-control w-25 text-center mx-auto border border-1 border-arcadiaSecondary" id="mail"
                    placeholder="Mail">

        </div>
        <div class="mb-3 text-center">
            <label for="pseudo" class="form-label fs-4">Pseudo</label>
            <input type="text" name="pseudo"
                class="form-control w-25 text-center mx-auto border border-1 border-arcadiaSecondary"
                placeholder="Pseudo">
        </div>
        <div class="mb-3 text-center">
            <label for="pass" class="form-label fs-4">Mot de passe</label>
            <input type="password" name="pass" id="pass"
                class="form-control w-25 text-center mx-auto border border-1 border-arcadiaSecondary"
                aria-describedby="passwordHelpInline" placeholder="**********">
        </div>
        <div class="mb-3 text-center">
            <button type="submit" class="mt-2 btn btn-outline-arcadiaTertiary" name="submit">Inscription</button>
            </form>
        </div>

        <?php
        // Affichage des messages d'erreur ou de succès
        if (isset($_GET['error'])) {
            if (isset($_GET['message'])) {
                echo '<div>' . htmlspecialchars($_GET['message']) . '</div>';
            }
        } else if (isset($_GET['success'])) {
            echo '<div class="container"><div class="rounded bg-success alert-success p-5 text-arcadia text-center">Inscription réussie.</div></div>';
        }
        ?>

    </div>


    <?php
    include ('src/arcFooter.php')
        ?>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>