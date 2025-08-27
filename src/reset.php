<?php

session_start();

session_unset();

session_destroy();


require_once 'Character.php';
require_once 'Guerrier.php';
require_once 'Orc.php';

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

                    <div><a href="index.php"><img src="assets/img/battleimg.jpg" alt="image battle" style="width: 10rem;" class="rounded"></a></div>
                    <div class="w-100 d-flex justify-content-center">
                        <h1 class="text-light">Warrior vs Orc</h1>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="min-vh-100 container border">



    </main>

    <footer class="mt-auto d-flex justify-content-center bg-dark">
        <h2 class="text-light">Footer</h2>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>