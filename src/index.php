<?php

require_once 'Character.php';
require_once 'Guerrier.php';
require_once 'Orc.php';


session_start();

// Pour afficher l'action qu'on fait avec les boutons qui sont de type POST
// var_dump($_POST);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Pour afficher les variables de session
    // var_dump($_SESSION);

    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create-warrior';
                if (!isset($_SESSION['warrior'])) {
                    $warrior = new Guerrier(2000, 500, "Epée Modeste", 250, "Bouclier Rustique", 100);
                    $_SESSION['warrior'] = $warrior; // On stocke la valeur de $warrior dans $_SESSION['warrior'] car sinon ça n'affiche pas plusieurs cards
                }
                break;

            case 'create-orc':
                if (!isset($_SESSION['orc'])) {
                    $orc = new Orc(1500, 200, 100, 400);
                    $_SESSION['orc'] = $orc;
                    $_SESSION['orcAttack'] = $_SESSION['orc']->attack();
                }
                break;

            case 'decide':
                $tryWarrior = rand(1, 6);
                $tryOrc = rand(1, 6);
                if ($tryWarrior < $tryOrc) {
                    $_SESSION['whoStarts'] = "Le Guerrier commence !";
                    $_SESSION['fightWarrior'] = "";
                } elseif ($tryOrc < $tryWarrior) {
                    $_SESSION['whoStarts'] = "L'Orc commence !";
                } else {
                    $_SESSION['whoStarts'] = "Egalité, relancez le dé";
                }



                break;

            case 'battle':
                if (isset($_SESSION['fightWarrior'])) {
                    $_SESSION['fightWarriorGo'] = "";
                }

                break;

            case 'reset':
                header("Location: reset.php");
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
                    <div><img src="assets/img/battleimg.jpg" alt="image battle" style="width: 8rem;" class="rounded"></div>
                    <div class="w-100 d-flex justify-content-center">
                        <h1 class="text-light">BATTLE DROME : Guerrier vs Orc</h1>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="min-vh-100 container border">

        <div class="d-flex justify-content-center m-2">

            <form action="" method="POST">
                <input type="hidden" name="action" value="create-warrior">
                <button type="submit" class="btn btn-dark text-light m-2">Créer un Guerrier</button>
            </form>

            <form action="" method="POST">
                <input type="hidden" name="action" value="create-orc">
                <button type="submit" class="btn btn-dark text-light m-2">Créer un Orc</button>
            </form>

            <form action="" method="POST">
                <input type="hidden" name="action" value="decide">
                <button type="submit" class="btn btn-secondary text-light m-2">Qui commence ?</button>
            </form>

            <form action="" method="POST">
                <input type="hidden" name="action" value="battle">
                <button type="submit" class="btn btn-danger text-light m-2">Fight !</button>
            </form>

            <form action="" method="POST">
                <input type="hidden" name="action" value="reset">
                <button type="submit" class="btn btn-danger text-light m-2">Reset le combat</button>
            </form>

        </div>


        <?php if (isset($_SESSION['whoStarts'])) { ?>
            <p class="text-center m-4"><b><?= $_SESSION['whoStarts'] ?></b></p>
        <?php } ?>


        <div class="d-flex justify-content-around">

            <!-- Card du Guerrier -->
            <?php
            if (isset($_SESSION['warrior'])) { ?>
                <div class="card" style="width: 20rem;">
                    <div class="card-body">
                        <img src="assets/img/guerrieranime.gif" class="card-img-top" alt="le guerrier" style="width:20rem">
                        <h5 class="card-title text-center mb-3 mt-4"><b>Gégé le Guerrier</b></h5>

                        <p class="card-text"><b>Classe :</b> Guerrier</p>
                        <p class="card-text"><b>Points de vie :</b> <?= $_SESSION['warrior']->getHealth() ?></p>
                        <p class="card-text"><b>Mana :</b> <?= $_SESSION['warrior']->getMana() ?></p>
                        <p class="card-text"><b>Arme :</b> <?= $_SESSION['warrior']->getWeapon() ?></p>
                        <p class="card-text"><b>Bouclier :</b> <?= $_SESSION['warrior']->getShield() ?></p>
                    </div>
                </div>

            <?php } ?>


            <!-- Box du déroulé du combat -->








            <!-- Box de l'Orc -->
            <?php
            if (isset($_SESSION['orc'])) { ?>
                <div class="card" style="width: 20rem;">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <img src="assets/img/orcanime.gif" class="text-center" alt="l'orc" style="width:12rem">
                        </div>
                        <h5 class="card-title mb-3 mt-4 text-center"><b>Kiki l'Orc</b></h5>
                        <p class="card-text"><b>Classe :</b> Orc</p>
                        <p class="card-text"><b>Points de vie :</b> <?= $_SESSION['orc']->getHealth() ?></p>
                        <p class="card-text"><b>Mana :</b> <?= $_SESSION['orc']->getMana() ?></p>
                        <p class="card-text"><b>Dégats Min :</b> <?= $_SESSION['orc']->getdamageMin() ?></p>
                        <p class="card-text"><b>Dégats Max :</b> <?= $_SESSION['orc']->getdamageMax() ?></p>
                        <p class="card-text"><b>Dégats infligés :</b> <?= $_SESSION['orc']->attack() ?></p>
                    </div>
                </div>
        </div>
    <?php } ?>



    </main>


    <?php
    if (isset($_SESSION['fightWarriorGo'])) { ?>

        <?php while ($_SESSION['warrior']->getHealth() >= 0 && $_SESSION['orc']->getHealth() >= 0) { ?>
            <div class="mt-4 text-center">
                <div class="">
                    <p>Le Guerrier lance une attaque de <?= $_SESSION['warrior']->getweaponDamage() ?> de dégâts ! ⚔️</p>
                    <p>L'Orc n'a plus que <?= $_SESSION['orc']->getHealth($_SESSION['warrior']->getweaponDamage()) ?> ❤️</p>
                </div>
                <div class="mb-5">
                    <p>L'Orc lance une attaque de <?= $_SESSION['orc']->attack() ?> de dégâts ! 💥</p>
                    <p>Le bouclier du Guerrier absorbe <?= $_SESSION['warrior']->getDamage($_SESSION['orc']->attack()) ?> 🛡️</p>
                    <p>Le Guerrier n'a plus que <?= $_SESSION['warrior']->getHealth() ?> ❤️</p>
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <footer class="mt-auto d-flex justify-content-center bg-dark">
        <h2 class="text-light">BATTLE DROME</h2>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>