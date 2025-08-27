<?php

require_once 'Character.php';
require_once 'Guerrier.php';
require_once 'Orc.php';


session_start();


var_dump($_POST);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    var_dump($_SESSION);
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create-warrior';
                if (!isset($_SESSION['warrior'])) {
                    $warrior = new Guerrier(2000, 500, "L'Epée Sombre", 250, "Le Bouclier Brillant", 600);
                    $_SESSION['warrior'] = $warrior; // On stocke la valeur de $warrior dans $_SESSION['warrior'] car sinon ça n'affiche pas plusieurs cards
                }
                break;

            case 'create-orc':
                if (!isset($_SESSION['orc'])) {
                    $orc = new Orc(1500, 200, 100, 400);
                    $_SESSION['orc'] = $orc;
                }
                break;

            case 'decide':
                echo "Je determine qui commence";
                // A CONTINUER !!!
                rand(1, 6);
                break;

            case 'battle':
                echo "Je lance le combat";
                break;

            case 'Reset':

                break;

            default:
                break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index.php</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-dark">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div><img src="assets/img/battleimg.jpg" alt="image battle" style="width: 10rem;" class="rounded"></div>
                    <div class="w-100 d-flex justify-content-center">
                        <h1 class="text-light">Warrior vs Orc</h1>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="min-vh-100 container border">

        <form action="" method="POST">
            <input type="hidden" name="action" value="create-warrior">
            <button type="submit" class="btn btn-dark text-light">Créer un Guerrier</button>
        </form>

        <form action="" method="POST">
            <input type="hidden" name="action" value="create-orc">
            <button type="submit" class="btn btn-dark text-light">Créer un Orc</button>
        </form>

        <form action="" method="POST">
            <input type="hidden" name="action" value="decide">
            <button type="submit" class="btn btn-secondary text-light">Qui commence ?</button>
        </form>

        <form action="" method="POST">
            <input type="hidden" name="action" value="battle">
            <button type="submit" class="btn btn-danger text-light">Fight !</button>
        </form>



        <button class="btn btn-danger"><a href="reset.php" class="text-decoration-none text-light">Déconnexion</a></button>


        <div class="d-flex justify-content-around">

            <?php
            if (isset($_SESSION['warrior'])) { ?>
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <img src="assets/img/guerrieranime.gif" class="card-img-top" alt="le guerrier">
                        <h5 class="card-title">Gégé</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">Le Guerrier</h6>
                        <p class="card-text"><b>Classe :</b> Guerrier</p>
                        <p class="card-text"><b>Points de vie :</b> <?= $_SESSION['warrior']->getHealth() ?></p>
                        <p class="card-text"><b>Mana :</b> <?= $_SESSION['warrior']->getMana() ?></p>
                        <p class="card-text"><b>Arme :</b> <?= $_SESSION['warrior']->getWeapon() ?></p>
                        <p class="card-text"><b>Bouclier :</b> <?= $_SESSION['warrior']->getShield() ?></p>
                    </div>
                </div>

            <?php } ?>

            <?php
            if (isset($_SESSION['orc'])) { ?>
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <img src="assets/img/orcanime.gif" class="card-img-top" alt="l'orc">
                        <h5 class="card-title">Kiki</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">L'Orc</h6>
                        <p class="card-text"><b>Classe :</b> Orc</p>
                        <p class="card-text"><b>Points de vie :</b> <?= $_SESSION['orc']->getHealth() ?></p>
                        <p class="card-text"><b>Mana :</b> <?= $_SESSION['orc']->getMana() ?></p>
                        <p class="card-text"><b>Dégats Min :</b> <?= $_SESSION['orc']->getdamageMin() ?></p>
                        <p class="card-text"><b>Dégats Max :</b> <?= $_SESSION['orc']->getdamageMax() ?></p>
                        <p class="card-text"><b>Dégats Max :</b> <?= $_SESSION['orc']->attack() ?></p>
                    </div>
                </div>
        </div>
    <?php } ?>



    </main>

    <footer class="mt-auto d-flex justify-content-center bg-dark">
        <h2 class="text-light">Footer</h2>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>