<?php
require_once ('src/connect.php');
// Traitement du formulaire d'ajout ou de modification d'animaux

$req = $db->query("SELECT * FROM race");
$races = $req->fetchAll();

if (isset($_GET['name'])) {
    $habitat_name = $_GET['name'];
} else {
    $habitat_name = "marais";
}

$req = $db->prepare("SELECT * FROM habitat WHERE habitat_name = ?");
$req->execute(array($habitat_name));
$habitats = $req->fetch();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['action'] == "registerAnimal") {
        if (!empty($_POST['id'])) {
            $id = $_POST['id'];
            $prenom = htmlspecialchars($_POST['prenom']);
            $race = htmlspecialchars($_POST['id_race']);
            $habitat = htmlspecialchars($_POST['id_habitat']);
            $images = htmlspecialchars($_POST['images']);
            $descriptions = htmlspecialchars($_POST['descriptions']);

            // Mettre à jour les données dans la base de données
            $req = $db->prepare("UPDATE animaux SET prenom = ?, id_race = ?, id_habitat = ?, images = ?, descriptions = ? WHERE id = ?");
            $req->execute(array($prenom, $race, $habitat, $images, $descriptions, $id));


            // Rediriger vers la page principale avec un message de succès
            header('location:habitat.php?name=' . $habitats['habitat_name'] . '&success=1&message=Animal modifié avec succès');
            exit();

        } else {
            // Ajout d'un nouvel animal
            $prenom = htmlspecialchars($_POST['prenom']);
            $race = htmlspecialchars($_POST['id_race']);
            $habitat = htmlspecialchars($_POST['id_habitat']);
            $images = htmlspecialchars($_POST['images']);
            $descriptions = htmlspecialchars($_POST['descriptions']);
            // Vérifier si les champs requis sont remplis
            if (!empty($_POST['prenom']) && !empty($_POST['id_race']) && !empty($_POST['images']) && !empty($_POST['descriptions'])) {

                // Insérer l'animal dans la base de données
                $req = $db->prepare('INSERT INTO animaux(prenom, id_race, id_habitat, images, descriptions) VALUES (?, ?, ?, ?, ?)');
                $req->execute(array($prenom, $race, $habitat, $images, $descriptions));
                // Rediriger vers la page principale avec un message de succès
                header('location:habitat.php?name=' . $habitats['habitat_name'] . '&success=1&message=Animal bien enregistré');
                exit();

            }
        }
    }
    if ($_POST['action'] == "updateAnimalNourriture") {
        if (!empty($_POST['nourriture']) && !empty($_POST['gramme'])) {

            $id = $_POST['id'];
            $timeDate = htmlspecialchars($_POST['timeDate']);
            $nourriture = htmlspecialchars($_POST['nourriture']);
            $gramme = htmlspecialchars($_POST['gramme']);
            // Insérer l'animal dans la base de données
            $req = $db->prepare('UPDATE animaux SET nourriture = ?, gramme = ?, timeDate = ? WHERE id = ?');
            $req->execute(array($nourriture, $gramme, $timeDate, $id));
        }
    }
    if ($_POST['action'] == "updateAnimalState") {
        if (!empty($_POST['avisVeterinaire'])) {

            $id = $_POST['id'];
            $avisVeterinaire = htmlspecialchars($_POST['avisVeterinaire']);
            // Insérer l'animal dans la base de données
            $req = $db->prepare('UPDATE animaux SET avisVeterinaire = ? WHERE id = ?');
            $req->execute(array($avisVeterinaire, $id));
        }
    }
    if ($_POST['action'] == "deleteAnimal") {
        $id = $_POST['id'];
        $req = $db->prepare('DELETE FROM animaux WHERE id = ?');
        $req->execute(array($id));

        // Rediriger vers la page principale avec un message de succès
        header('location:habitat.php?name=' . $habitats['habitat_name'] . '&success=1&message=Animal supprimé avec succès');
        exit();
    }
    if ($_POST['action'] == "addRace") {
        if (!empty($_POST['new_race'])) {
            $new_race = htmlspecialchars($_POST['new_race']);
            // Insérer la nouvelle race dans la base de données
            $req = $db->prepare('INSERT INTO race (race) VALUES (?)');
            $req->execute(array($new_race));
            // Rediriger vers la page principale avec un message de succès
            header('location:habitat.php?name=' . $habitats['habitat_name'] . '&success=1&message=Race ajoutée avec succès');
            exit();
        } else {
            // Rediriger avec un message d'erreur si le champ est vide
            header('location:habitat.php?name=' . $habitats['habitat_name'] . '&error=1&message=Le champ race est vide');
            exit();
        }
    }
}
// Vérifier si l'ID de l'animal est défini dans la requête POST


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
            var confirmation = confirm("Êtes-vous sûr de vouloir supprimer cet animal ?");
            if (confirmation) {
                return true; // Autorise la suppression en suivant le lien
            } else {
                return false; // Annule la suppression
            }
        }
    </script>
    <script>
        function incrementDetailsCount(animalId) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "increment_counter.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log("Compteur de détails incrémenté");
                }
            };
            xhr.send("id=" + animalId);
        }
    </script>

</head>

<body class=" <?php echo $habitats['bg'] ?> text-arcadiaTertiary">
    <!-- ENTETE -->
    <?php
    include ('src/arcHeader.php');
    ?>

    <div class="mx-auto w-75">
        <div class="card m-3 border border-2 border-arcadiaSecondary shadow-lg">
            <img src="<?php echo $habitats['image'] ?>" class="card-img" alt=" <?php $habitats['habitat_name'] ?>">
            <div class="card-img-overlay">
                <div class="nav-link shadow text-center fs-1 text-arcadiaTertiary"><b><?php $habitats['title'] ?></b>
                </div>
            </div>
        </div>
    </div>

    <!--DESCRIPTION-->

    <div class="container">
        <h2 class="text-arcadiaTertiary text-center">Description de l'habitat :<?php echo $habitats['habitat_name'] ?>
        </h2>

        <?php echo $habitats['description'];
        ?>
    </div>

    <!-- AJOUTER UN ANIMAL ! -->

    <?php
    if (isset($_SESSION['connect']) && $current_user_role['role_name'] == 'admin') { ?>

        <!--FORMULAIRE AJOUT ANIMAL-->

        <div class="container mx-auto my-5 w-75 rounded border border-2 bg-grey border-arcadiaSecondary text-center">
            <h3 class="bg-arcadia mx-auto my-3 border border-1 border-arcadiaSecondary w-50 rounded p-3">Ajouter un Animal
            </h3>
            <form action="habitat.php?name=<?php echo $habitats['habitat_name'] ?>" method="post">
                <div class="row mx-auto w-50 align-items-center">
                    <div class="col-md-3">
                        <label for="id" class="form-label m-2 fs-5">ID (rentrer l'ID si c'est pour modifier) :</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="id" class="form-control border-1 border-arcadiaSecondary" name="id">
                    </div>
                    <div class="col-md-3">
                        <label for="nom" class="form-label m-2 fs-5">Prénom :</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="prenom" class="form-control border-1 border-arcadiaSecondary" name="prenom">
                    </div>

                    <div class="col-md-3">
                        <label for="race" class="form-label m-2 fs-5">Race :</label>
                    </div>

                    <div class="col-md-9">
                        <select id="id_race" class="form-select border-1 border-arcadiaSecondary"
                            aria-label="Default select example" name="id_race">
                            <?php
                            foreach ($races as $race) {
                                echo '<option value=" ' . $race['id_race'] . '">' . $race['race'] . '</option>';
                            } ?>
                        </select>
                    </div>
                    <!--ajouter une race-->
                    <div class="col-md-12 text-center">
                        <button type="button" class="mb-4 btn btn-outline-arcadiaTertiary" data-bs-toggle="modal"
                            data-bs-target="#raceAd">
                            Ajouter une race
                        </button>
                    </div>


                    <input type="hidden" id="id_habitat" value="<?php echo $habitats['id_habitat'] ?>" name="id_habitat">
                    <div class="col-md-3">
                        <label for="images" class="form-label m-2 fs-5">URL image :</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="images" class="form-control border-1 border-arcadiaSecondary" name="images">
                    </div>

                    <div class="col-md-3">
                        <label for="descriptions" class="form-label m-3 fs-5">Description : </label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="descriptions" class="form-control border-1 border-arcadiaSecondary"
                            name="descriptions"></input>
                    </div>

                    <input type="hidden" name="action" value="registerAnimal">
                    <div class="col-md-12 text-center">
                        <input type="submit" value="Ajouter" class="mb-4 btn btn-outline-arcadiaTertiary">
                    </div>
                </div>
                <?php if (isset($_GET['error'])) {
                    if (isset($_GET['message'])) {
                        echo '<div class="mx-auto my-3 p-3 w-25 bg-danger text-arcadia rounded">' . htmlspecialchars($_GET['message']) . '</div>';
                    }
                } else if (isset($_GET['success'])) {
                    echo '<div class="mx-auto my-3 p-3 w-25 bg-success text-arcadia rounded">' . htmlspecialchars($_GET['message']) . '</div>';
                }
    }
    ?>
        </form>
    </div>

    <!--FORM DETAIL VETO-->
    <?php if (isset($_SESSION['connect']) && $current_user_role['role_name'] == 'employe') { ?>
        <div class="container w-75 mx-auto my-5 rounded border border-2 bg-grey border-arcadiaSecondary text-center">
            <h3 class="bg-arcadia mx-auto my-3 border border-1 border-arcadiaSecondary w-50 rounded p-3">Details employer
            </h3>
            <form action="habitat.php?name=<?php echo $habitats['habitat_name'] ?>" method="post">
                <div class="mb-3 text-center">
                    <label for="etat" class="form-label">ID</label>
                    <input type="text" class="form-control border-1 border-arcadiaSecondary mx-auto w-25" id="idv"
                        name="id">
                </div>
                <div class="mb-3 text-center">
                    <label for="nourriture" class="form-label">NOURRITURE</label>
                    <input type="text" class="form-control border-1 border-arcadiaSecondary mx-auto w-25" id="nourriture"
                        name="nourriture">
                </div>
                <div class="mb-3 text-center">
                    <label for="gramme" class="form-label">GRAMMAGE</label>
                    <input type="number" class="form-control border-1 border-arcadiaSecondary mx-auto w-25" id="gramme"
                        name="gramme">
                </div>
                <input type="datetime-local" id="timeDate" name="timeDate" value="2024-01-01" />

                <input type="hidden" name="action" value="updateAnimalNourriture">
                <button type="submit" class="mx-auto btn m-2 btn-outline-arcadiaTertiary">Modifier</button>

                <?php
                if (isset($_GET['success'])) {
                    echo '<div class="mx-auto my-3 p-3 w-25 bg-success text-arcadia rounded"> Etat de l\'animal bien modifié </div>';
                }
    }
    ?>
        </form>
    </div>

    <?php if (isset($_SESSION['connect']) && $current_user_role['role_name'] == 'veterinaire') { ?>
        <div class="container w-75 mx-auto my-5 rounded border border-2 bg-grey border-arcadiaSecondary text-center">
            <h3 class="bg-arcadia mx-auto my-3 border border-1 border-arcadiaSecondary w-50 rounded p-3">Details Vétérinaire
            </h3>
            <form action="habitat.php?name=<?php echo $habitats['habitat_name'] ?>" method="post">
                <div class="mb-3 text-center">
                    <label for="etat" class="form-label">ID DE L'ANIMAL</label>
                    <input type="text" class="form-control border-1 border-arcadiaSecondary mx-auto w-25" id="id" name="id">
                </div>
                <div class="mb-3 text-center">
                    <label for="avisVeterinaire" class="form-label">COMPTE RENDU DU VETERINAIRE</label>
                    <input type="text" class="form-control border-1 border-arcadiaSecondary mx-auto w-25"
                        id="avisVeterinaire" name="avisVeterinaire">
                </div>
                <input type="hidden" name="action" value="updateAnimalState">
                <button type="submit" class="mx-auto btn m-2 btn-outline-arcadiaTertiary">Envoyer</button>

                <?php
                if (isset($_GET['success'])) {
                    echo '<div class="mx-auto my-3 p-3 w-25 bg-success text-arcadia rounded"> Etat de l\'animal bien modifié </div>';
                }
    }
    ?>
        </form>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="raceAd" tabindex="-1" aria-labelledby="adRace" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-arcadiaLight">

                <form action="habitat.php?name=<?php echo $habitats['habitat_name'] ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addRaceModalLabel">Ajouter une nouvelle race</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="newRace" class="form-label my-2">Nom de la nouvelle race :</label>
                            <input type="text" class="form-control border-1 border-arcadiaSecondary" id="newRace"
                                name="new_race" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-outline-arcadiaTertiary">Ajouter</button>
                    </div>
                    <input type="hidden" name="action" value="addRace">
                </form>
            </div>
        </div>
    </div>


    <div class="container">
        <h3 class="text-center fs-1">Les Animaux de l'habitat : <?php $habitats['habitat_name'] ?></h3>
        <br>
        <div class="row">
            <?php
            // Récupération des animaux depuis la base de données avec jointure
            $req = $db->prepare("SELECT animaux.*, race.race FROM animaux INNER JOIN race ON animaux.id_race = race.id_race WHERE id_habitat = ?");
            $req->execute(array($habitats['id_habitat']));
            $animaux = $req->fetchAll(PDO::FETCH_ASSOC);
            // Affichage des animaux
            foreach ($animaux as $animal) {
                echo '<div class="col">';
                echo '<div class="card m-2 bg-arcadia shadow-lg border-1 border-arcadiaSecondary mx-auto" style="width:300px;">';
                echo '<img src="' . $animal['images'] . '" class="card-img-top border border-1 border-arcadiaSecondary " alt="..." style="width:300px; height:260px">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title fs-4">' . $animal['race'] . '</h5>'; // Modification effectuée pour afficher la race
                echo '</div>';
                echo '<ul class="list-group list-group-flush bg-arcadiaLight">';
                echo '<li class="list-group-item bg-arcadiaLight"><b>Prénom :</b> ' . $animal['prenom'] . '</li>';
                echo '<li class="list-group-item bg-arcadiaLight"><b>Description :</b> ' . $animal['descriptions'] . '</li>';

                if (isset($_SESSION['connect']) == 1) {
                    echo '<li class="list-group-item bg-arcadiaLight"><b>ID :</b> ' . $animal['id'] . '</li>';
                }
                echo '<div class="dropdown bg-arcadiaLight">
                <button class="btn d-flex w-100 mx-auto btn-outline-arcadiaTertiary" type="button" data-bs-toggle="dropdown" aria-expanded="false" onclick="incrementDetailsCount(' . $animal['id'] . ')">
    Détail de l\'animal
</button>
                <ul class="dropdown-menu w-100  bg-arcadiaLight">
              <li class="list-group-item bg-arcadiaLight"><b>Nourriture :</b> ' . $animal['nourriture'] . '</li>
               <li class="list-group-item bg-arcadiaLight"><b>Gramme :</b> ' . $animal['gramme'] . '</li>
               <li class="list-group-item bg-arcadiaLight"><b>Avis du vétérinaire :</b> ' . $animal['avisVeterinaire'] . '</li>
               <li class="list-group-item bg-arcadiaLight"><b>Date :</b> ' . $animal['timeDate'] . '</li>
                </ul>
              </div>';
                if ($current_user_role['role_name'] == 'admin') {
                    echo '<form action="habitat.php?name=' . $habitats['habitat_name'] . '" method="post" onsubmit="return confirmDelete()">';
                    echo '<input type="hidden" name="id" value="' . $animal['id'] . '">';
                    echo '<input type="hidden" name="action" value="deleteAnimal">';
                    echo '<button type="submit" class="btn btn-danger my-2 mx-auto w-50 d-flex justify-content-center align-items-center">Supprimer</button>';
                    echo '</form>';
                }

                echo '</ul>';
                echo '</div>';

                echo '</div>';
            } ?>
        </div>
        <?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id'])) {
        $id = intval($_POST['id']);
        
        // Incrémenter le compteur de détails
        $req = $db->prepare("UPDATE animaux SET details_count = details_count + 1 WHERE id = ?");
        $req->execute(array($id));
        
        echo "Success";
    } else {
        echo "Invalid ID";
    }
} else {
    echo "Invalid request";
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