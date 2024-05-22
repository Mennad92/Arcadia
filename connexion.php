<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
require_once ('src/connect.php');

if (!empty($_POST['mail']) && !empty($_POST['pass'])) {

  $mail = htmlspecialchars($_POST['mail']);
  $pass = $_POST['pass'];

  if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    header('location:connexion.php?error=1&message=Votre adresse mail est invalide.');
    exit();
  }

  // Récupérer le mot de passe haché depuis la base de données
  $req = $db->prepare('SELECT * FROM users WHERE mail = ?');
  $req->execute(array($mail));
  $user = $req->fetch();
  if ($user) {
    // Vérifier le mot de passe en utilisant password_verify pour bcrypt
    if (password_verify($pass, $user['pass'])) {
      $_SESSION['connect'] = 1;
      $_SESSION['mail'] = $user['mail'];
      $_SESSION['id'] = $user['id'];
      $_SESSION['role_id'] = $user['role_id'];

      header('location:index.php');
      exit();
    } else {
      header('location:connexion.php?error=1&message=Impossible de vous authentifer.');
      exit();
    }
  }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="design/style.css">
  <link rel="stylesheet" href="design/custom.css">
  <link rel="icon" href="image/iconarcadia.ico">
  <title>Arcadia</title>
</head>

<body class="bg-arcadiaLight text-arcadiaSecondary">
  <!-- ENTETE -->

  <?php
  include ('src/arcHeader.php');
  ?>

  <!-- CONNEXION -->

  <div class="m-5">
    <div class="m-5 text-center">
      <?php if (isset($membreA) && $membreA == 1){
        header('location:administration.php');
      } else{ ?>
        <h2 class="mb-5 text-arcadiaTertiary">S'identifier</h2>

        <?php
        if (isset($_GET['error'])) {
          if (isset($_GET['message'])) {
            echo '<div class="alert error">' . htmlspecialchars($_GET['message']) . '</div>';
          }
        }
        ?>
        <form action="connexion.php" method="post">
          <label for="email" class="form-label fs-4">Utilisateur</label>
          <input type="email" name="mail"
            class="form-control text-center mx-auto border border-1 border-arcadiaSecondary" id="password"
            placeholder="Pseudo">
          <label for="exampleFormControlInput1" class="form-label fs-4">Mot de passe</label>
          <input type="password" name="pass" id="inputPassword6"
            class="form-control text-center mx-auto border border-1 border-arcadiaSecondary"
            aria-describedby="passwordHelpInline" placeholder="**********">
          <div class="form-check mt-3 d-flex justify-content-center">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="check">
            <label class="form-check-label mx-1" for="exampleCheck1"> Rester connecter</label>
          </div>
          <button type="submit" class="mt-4 btn btn-outline-arcadiaTertiary">Connexion</button>
        </form><?php } ?>
    </div>
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