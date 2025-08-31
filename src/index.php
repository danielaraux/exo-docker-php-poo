<?php
require_once 'Character.php';
require_once 'Guerrier.php';
require_once 'Orc.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create-warrior':
                if (!isset($_SESSION['warrior'])) {
                    $warrior = new Guerrier(2000, 500, "Epée Modeste", 250, "Bouclier Rustique", 100);
                    $_SESSION['warrior'] = $warrior;
                }
                break;

            case 'create-orc':
                if (!isset($_SESSION['orc'])) {
                    $orc = new Orc(1500, 200, 100, 400);
                    $_SESSION['orc'] = $orc;
                }
                break;

            case 'decide':
                $tryWarrior = rand(1, 6);
                $tryOrc = rand(1, 6);

                if ($tryWarrior > $tryOrc) {
                    $_SESSION['whoStarts'] = "Le Guerrier commence !";
                    $_SESSION['first'] = "warrior";
                } elseif ($tryOrc > $tryWarrior) {
                    $_SESSION['whoStarts'] = "L'Orc commence !";
                    $_SESSION['first'] = "orc";
                } else {
                    $_SESSION['whoStarts'] = "Égalité, relancez le dé";
                }
                break;

            case 'battle':
                if (isset($_SESSION['warrior']) && isset($_SESSION['orc']) && isset($_SESSION['first'])) {
                    $warrior = $_SESSION['warrior'];
                    $orc = $_SESSION['orc'];

                    $battleLog = [];

                    // Condition while
                    while ($warrior->getHealth() > 0 && $orc->getHealth() > 0) {
                        if ($_SESSION['first'] === "warrior") {
                            // Guerrier attaque
                            $damage = $warrior->getweaponDamage();
                            $orc->getDamageOrc($damage);
                            $battleLog[] = "<p class='text-primary'>⚔️ Le Guerrier attaque avec une frappe de $damage 💥</p>";
                            $battleLog[] = "<p>L’Orc n’a plus que " . $orc->getHealth() . " ❤️</p>";

                            if ($orc->getHealth() <= 0) break;

                            // Orc attaque
                            $orcDamage = $orc->attack();
                            $absorbed = $warrior->getDamage($orcDamage);
                            $battleLog[] = "<p class='text-danger'>💥 L’Orc attaque avec $orcDamage dégâts !</p>";
                            $battleLog[] = "<p>Le bouclier du Guerrier absorbe $absorbed 🛡️</p>";
                            $battleLog[] = "<p>Le Guerrier n’a plus que " . $warrior->getHealth() . " ❤️</p>";
                        } elseif ($_SESSION['first'] === "orc") {
                            // Orc attaque
                            $orcDamage = $orc->attack();
                            $absorbed = $warrior->getDamage($orcDamage);
                            $battleLog[] = "<p class='text-danger'>💥 L’Orc attaque avec $orcDamage dégâts !</p>";
                            $battleLog[] = "<p>Le bouclier du Guerrier absorbe $absorbed 🛡️</p>";
                            $battleLog[] = "<p>Le Guerrier n’a plus que " . $warrior->getHealth() . " ❤️</p>";

                            if ($warrior->getHealth() <= 0) break;

                            // Guerrier attaque
                            $damage = $warrior->getweaponDamage();
                            $orc->getDamageOrc($damage);
                            $battleLog[] = "<p class='text-primary'>⚔️ Le Guerrier attaque avec une frappe de $damage 💥</p>";
                            $battleLog[] = "<p>L’Orc n’a plus que " . $orc->getHealth() . " ❤️</p>";
                        }
                    }

                    // Annoncer le gagnant
                    if ($warrior->getHealth() <= 0) {
                        $battleLog[] = "<h3 class='text-danger text-center'>☠️ Le Guerrier est tombé... L'Orc gagne 🏆</h3>";
                    } elseif ($orc->getHealth() <= 0) {
                        $battleLog[] = "<h3 class='text-success text-center'>🎉 L'Orc est vaincu ! Le Guerrier triomphe 🏆</h3>";
                    }

                    $_SESSION['battleLog'] = $battleLog;
                }
                break;

            case 'reset':
                session_destroy();
                header("Location: index.php");
                exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Battle Drome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
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

    <main class="container py-4 min-vh-100">

        <div class="d-flex justify-content-center mb-4">
            <form method="POST" class="m-2">
                <input type="hidden" name="action" value="create-warrior">
                <button class="btn btn-primary">Créer un Guerrier</button>
            </form>

            <form method="POST" class="m-2">
                <input type="hidden" name="action" value="create-orc">
                <button class="btn btn-success">Créer un Orc</button>
            </form>

            <form method="POST" class="m-2">
                <input type="hidden" name="action" value="decide">
                <button class="btn btn-secondary">Qui commence ?</button>
            </form>

            <form method="POST" class="m-2">
                <input type="hidden" name="action" value="battle">
                <button class="btn btn-danger">Fight !</button>
            </form>

            <form method="POST" class="m-2">
                <input type="hidden" name="action" value="reset">
                <button class="btn btn-dark">Reset</button>
            </form>
        </div>

        <?php if (isset($_SESSION['whoStarts'])): ?>

            <p class="text-center fw-bold"><?= $_SESSION['whoStarts'] ?></p>

        <?php endif; ?>

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


            <!-- Etapes du combat -->
            <?php if (isset($_SESSION['battleLog'])): ?>
                <div class="card shadow p-3">
                    <?php foreach ($_SESSION['battleLog'] as $line): ?>
                        <?= $line ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

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

    <footer class="bg-dark text-light text-center py-3">
        <h5>BATTLE DROME</h5>
    </footer>
</body>

</html>