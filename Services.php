<?php
require_once ('src/connect.php');

// Récupération des services
$req = $db->query("SELECT * FROM services");
$services = $req->fetchAll();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['action'] == "modifierService") {
        if (!empty($_POST['titre']) && !empty($_POST['images']) && !empty($_POST['descriptions'])){
            $id = htmlspecialchars($_POST['id']);
            $titre = htmlspecialchars($_POST['titre']);
            $images = htmlspecialchars($_POST['images']);
            $descriptions = $_POST['descriptions'];

            // Mettre à jour le service dans la base de données
            $req = $db->prepare('UPDATE services SET titre = ?, images = ?, descriptions = ? WHERE id = ?');
            $success = $req->execute(array($titre, $images, $descriptions, $id));

            if ($success) {
                // Rediriger vers la page principale avec un message de succès
                header('location:services.php?success=1&message=Service modifié avec succès');
                exit();
            } else {
                echo "Erreur lors de la mise à jour du service.";
            }
        } else {
            echo "Veuillez remplir tous les champs.";
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

<body class="bg-arcadiaLight">
    <!-- ENTETE -->
    <?php
    include ('src/arcHeader.php');
    ?>
    <div class="container">
        <h2 class="text-arcadiaTertiary bg-grey m-5 text-center p-5 border-2 border border-arcadiaTertiary rounded mx-auto w-75 shadow-lg text-arcadiaSecondary">
            LES DIFFERENTS SERVICES DU ZOO
        </h2>
        <?php
        if (isset($_SESSION['connect']) && $current_user_role['role_name'] == 'admin') { ?>
            <div class="container w-75 mx-auto my-5 rounded border border-2 bg-grey border-arcadiaSecondary text-center">
                <h3 class="bg-arcadia mx-auto my-3 border border-1 border-arcadiaSecondary w-50 rounded p-3">Modifier Les
                    Services
                </h3>
                <form action="services.php" method="post">
                    <div class="mb-3 text-center">
                        <label for="nourriture" class="form-label text-arcadiaSecondary fs-4">Titre actuel</label>
                        <select class="form-select border-1 border-arcadiaSecondary mx-auto w-50"
                            aria-label="Default select example" name="id">
                            <?php
                            foreach ($services as $service) {
                                echo '<option value=" ' . $service['id'] . '">' . $service['titre'] . '</option>';
                            } ?>
                        </select>
                    </div>
                    <div class="mb-3 text-center">
                        <label for="gramme" class="form-label text-arcadiaSecondary fs-4">Nouveaux Titre</label>
                        <input type="link" class="form-control border-1 border-arcadiaSecondary mx-auto w-50" name="titre">
                    </div>
                    <div class="mb-3 text-center">
                        <label for="gramme" class="form-label text-arcadiaSecondary fs-4">Image</label>
                        <input type="link" class="form-control border-1 border-arcadiaSecondary mx-auto w-50" name="images">
                    </div>
                    <div class="mb-3 text-center">
                        <label for="images" class="form-label text-arcadiaSecondary fs-4">Description</label>
                        <textarea type="text" class="form-control border-1 border-arcadiaSecondary mx-auto w-50"
                            name="descriptions"></textarea>
                    </div>

                    <input type="hidden" name="action" value="modifierService">
                    <button type="submit" class="mx-auto btn m-2 btn-outline-arcadiaTertiary">Modifier</button>
                </form>
            </div>

        <?php } ?>
        <div class="mx-auto">
            <?php foreach ($services as $service) {
                echo '<div class="card my-5 border border-2 border-arcadiaSecondary shadow-lg">
                        <img src="'. htmlspecialchars($service['images']) . '" class="card-img" alt="Restaurant">
                        <div class="card-img-overlay">
                            <b><a href="#id' . $service['id'] . '" class="nav-link my-auto shadow-lg text-center fs-3 text-arcadia">' . htmlspecialchars($service['titre']) . '</b></a>
                        </div>
                      </div>
                      <div class="text-center">
                        <p id="id' . $service['id'] . '" class=" my-auto text-center fs-4 text-arcadiaTertiary">' . htmlspecialchars($service['descriptions']) . '</p>
                      </div>';
            } ?>
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