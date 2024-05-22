<?php
require_once ('connect.php');
?>

<header class="bg-arcadia border-bottom border-3 border-arcadiaSecondary">
    <nav class="navbar navbar-expand-md p-3 d-block">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a href="index.php" id="Arcadia" class="navbar-brand d-md-none"><img src="image/ARCADIA.png"
                        style="height: 65px;" /></a>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav mx-auto fs-3">
                    <a class="nav-link p-3 my-auto text-arcadiaSecondary" aria-current="page"
                        href="services.php">SERVICES</a>
                    <div class="nav-item dropdown my-auto">
                        <a class="nav-link p-3 text-arcadiaSecondary dropdown-toggle" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false" href="#">HABITATS</a>
                        <ul class="dropdown-menu bg-arcadia px-2 text-arcadiaSecondary">
                            <?php
                            foreach ($headerHabitats as $habitat) {
                                echo '<li class="border-1 border-bottom border-opacity-25 border-arcadiaSecondary" id="' . $habitat['habitat_name'] . '"><a
                                    class="dropdown-item" href="habitat.php?name=' . $habitat['habitat_name'] . '" >' . ucwords($habitat['habitat_name']) . '
                                </a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                        <a href="index.php" id="Arcadia" class="nav-link d-none d-md-block"><img src="image/ARCADIA.png"
                                style="height: 200px;" /></a>
                    <a class="nav-link p-3 my-auto text-arcadiaSecondary" href="#contact">CONTACT</a>
                    <?php
                    if (isset($_SESSION['connect']) && isset($current_user_role) && $current_user_role['role_name'] == 'admin') {
                        echo '<a class="nav-link p-3 my-auto text-arcadiaSecondary" href="administration.php">ADMINISTRATION</a>';
                    } else if (isset($_SESSION['connect']) && $current_user_role['role_name'] != 'admin') {
                        echo '<a class="nav-link p-3 my-auto text-arcadiaSecondary" href="src/logout.php">DECONNEXION</a>';
                    } else {
                        echo '<a class="nav-link p-3 my-auto text-arcadiaSecondary" href="connexion.php">CONNEXION</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </nav>
</header>