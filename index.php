<?php
require_once ('src/connect.php');


//avis valide ?
if (isset($_GET['confirme']) && !empty($_GET['confirme'])) {
  $confirme = (int) $_GET['confirme'];
  $req = $db->prepare('UPDATE avis SET confirme = 1 WHERE id = ?');
  $req->execute(array($confirme));
}
//supprimer
if (isset($_GET['supprimer']) && !empty($_GET['supprimer'])) {
  $user = (int) $_GET['supprimer'];
  $req = $db->prepare('DELETE FROM avis WHERE id = ?');
  $req->execute(array($user));
}
$avisee = $db->query('SELECT * FROM avis');
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
  <!-- ENTETE -->
  <?php
  include ('src/arcHeader.php');
  ?>

  <!-- ICI : CAROUSEL -->

  <div id="carouselExampleIndicators" class="carousel slide border-bottom border-arcadiaSecondary border-2">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
        aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
        aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
        aria-label="Slide 2"></button>
    </div>

    <div class="carousel-inner">
      <?php
      foreach ($headerHabitats as $key => $habitat) {
        if ($key === array_key_first($headerHabitats)) {
          $status = "active";
        } else {
          $status = "";
        }

        echo '<div class="carousel-item ' . $status . '">
                  <img src="' . $habitat['accueilImage'] . '" class="d-block0 w-100 mx-auto" alt="...">
                  <div class="carousel-caption">
          
                     <h3 class="text-shadow "><a class="nav-link my-auto fs-1 text-sable" href="habitat.php?name=' . $habitat['habitat_name'] . '">VENEZ
                        VISITER LES DIFFERENTS HABITATS DES ANIMAUX
                    </h3>
                    <b class="text-danger fs-3">' . $habitat['title'] . '</b></a>
                  </div>
                </div>';
      }
      ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
      data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
      data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <!-- ICI LES CARTES  -->
  <div id="service" class="container p-3">
    <div class="card mb-3 bg-sable border border-1 border-arcadiaSecondary">
      <div class="row g-0">
        <div class="col-md-4">
          <img src="image/train.jpg" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title text-arcadiaTertiary">LE TRAIN DES ANIMAUX</h5>
            <p class="card-text">Faites le tour des Habitats naturel des animaux en train et ne ratez rien. Que ce
              soit
              la savane, jusqu'à la jungle en passant par les grands marais.</p>
            <p></p>
            <a href="services.php#id1" class="btn btn-arcadiaTertiary">Faire un tour</a>
          </div>
        </div>
      </div>
    </div>
    <div class="card mb-3 bg-sable border border-1 border-arcadiaSecondary">
      <div class="row g-0">
        <div class="col-md-4">
          <img src="image/guide.jpg" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title text-arcadiaTertiary">LES GUIDES</h5>
            <p class="card-text">Envie d'en apprendre plus sur vos animaux favoris ? Faites vous guidez par notre équipe
              d'experts qui pourront vous renseigner sur les animaux des différents habitats, leurs habitudes
              alimentaires et leurs modes de vie.</p>
            <a href="services.php#id2" class="btn btn-arcadiaTertiary">Let's go</a>
          </div>
        </div>
      </div>
    </div>
    <div class="card mb-3 bg-sable border border-1 border-arcadiaSecondary">
      <div class="row g-0">
        <div class="col-md-4">
          <img src="image/restaurant.jpg" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title text-arcadiaTertiary">RESTAURANTS</h5>
            <p class="card-text">Le tour du zoo, ça creuse. Venez vous restaurer dans nos restaurants situés un peu
              partout dans le parc et à proximité de la nature et des animaux. </p>
            <a href="services.php#id3" class="btn btn-arcadiaTertiary">J'ai Faim !</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- AVIS CLIENTS  -->
  <div class="mb-3 text-center">
    <form action="index.php" method="post">
      <label for="pseudo" class="form-label">Pseudo</label>
      <input type="text" class="form-control w-75 text-center mx-auto border border-1 border-arcadiaSecondary"
        id="pseudo" name="pseudo" placeholder="Pseudo">
      <label for="comment" class="form-label">Avis</label>
      <input class="form-control w-75 text-center mx-auto border-1 border-arcadiaSecondary" id="comment" name="comment"
        placeholder="Laissez nous votre avis." rows="3"></input>
      <button type="submit" class="mt-2 btn btn-outline-arcadiaTertiary">Envoyer</button>
    </form>
  </div>
  <!--CAROUSEL AVIS -->
  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $pseudo = $_POST['pseudo'];
    $avis = $_POST['comment'];

    // Assurez-vous que les champs ne sont pas vides
    if (!empty($pseudo) && !empty($avis)) {
      // Connexion à la base de données
  
      // Préparation de la requête SQL pour insérer l'avis dans la base de données
      $req = $db->prepare('INSERT INTO avis(pseudo, comment) VALUES (?, ?)');
      $req->execute(array($pseudo, $avis));
    } else {
      // En cas de champs vides
      echo "Veuillez remplir tous les champs.";
      echo $pseudo;
    }
  }
  if (isset($_SESSION['connect']) && $current_user_role['role_name'] == 'employe') {
    // Vérification si l'utilisateur est connecté en tant qu'employé
  

    ?>
    <div class="container my-5 w-75 rounded border border-2 bg-grey border-arcadiaSecondary text-center">
      <h3 class="bg-arcadia mx-auto my-3 border border-1 border-arcadiaSecondary w-25 rounded p-3">AVIS</h3>
      <ul class="list-group">
        <?php while ($a = $avisee->fetch()) { ?>
          <li class="list-group-item bg-grey">
            <b><?= $a['pseudo'] ?> :</b>
            <div class="text-arcadiaSecondary"><?= $a['comment']; ?> <br></div>
            <?php if ($a['confirme'] == 0) { ?>
              <span class="text-warning"><b>En attente |</b></span> <b><a class="nav-link d-inline text-arcadiaTertiary"
                  href="index.php?role=<?= $a['id'] ?>"></b>
              <b><a class="nav-link d-inline text-arcadiaTertiary" href="index.php?confirme=<?= $a['id'] ?>">Confirmer ? -
                </a></b>
              <b><a class="nav-link  d-inline text-danger" href="index.php?supprimer=<?= $a['id'] ?>"
                  onclick="return confirmDelete()">Supprimer ?</a></b>
              </a></b>
            <?php } else { ?>
              <span class="text-success"><b>Confirmer -</b></span>Voulez vous le <b> <a class="nav-link  d-inline text-danger"
                  href="index.php?supprimer=<?= $a['id'] ?>" onclick="return confirmDelete()">Supprimer ?</a></b>
            <?php }
        }
  } ?>
      </li>
    </ul>
  </div>





  <!-- CAROUSEL AVIS -->
  <div class="container">
    <h3 class="text-center mx-auto text-arcadiaTertiary ">AVIS DU ZOO</h3>
    <p class="text-center mx-auto text-arcadiaTertiary mb-5">Nos visiteurs ont apprécié et ont tenu à nous en informé.
    </p>
    <div id="carouselExample" class="carousel slide text-center" data-bs-ride="carousel">
      <div
        class="carousel-inner text-arcadiaSecondary bg-light rounded border border-1 border-arcadiaSecondary w-75 mx-auto ">
        <?php
        $req = $db->prepare('SELECT * FROM avis WHERE confirme = 1');
        $req->execute();
        $avis_confirmes = $req->fetchAll(PDO::FETCH_ASSOC);
        foreach ($avis_confirmes as $index => $avis) {
          $pseudo = $avis['pseudo'];
          $commentaire = $avis['comment'];
          echo '<div class="carousel-item' . ($index == 0 ? ' active' : '') . '">';
          echo '<b><p class="d-block mx-auto text-arcadiaSecondary text-uppercase w-50" alt="...">' . $pseudo . '</p></b>';
          echo '<p class="d-block mx-auto w-50 text-arcadiaSecondary" alt="...">' . $commentaire . '</p>';
          echo '</div>';
        }
        ?>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

  </div>
  <!-- -->



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