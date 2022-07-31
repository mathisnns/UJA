<?php
$token = $_COOKIE["token"];

if ($token == null) {

    //echo "no token found";
    echo "<script>window.location.href='index.html';</script>";
    exit;
}

if ($file = fopen('/var/www/html/UJA/data/tokens', "r")) {
    $ok = false;
    while (!feof($file) && !$ok) {
        $line = fgets($file);

        if ($token == $line) {
            // echo " correspondance found ! ";
            $ok = true;
        }
    }

    fclose($file);

    if (!$ok) {
        //echo "pas de correspondance dans le fichier de token";
        //if the ok variable is set to false, then we didn't found a corresponding token, redirect to the login page.
        echo "<script>window.location.href='index.html';</script>";
        exit;       //exit the code to avoid security problems.
    } else {
    }
} else {
    echo "probleme d'ouverture du fichier ";
    http_response_code(500);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/x-icon" href="/UJA/favicon.ico">

    <title>Unitée Jeunes Adultes</title>

    <!--CSS files -->
    <link rel="stylesheet" href="/UJA/css/bootstrap.min.css">
    <link rel="stylesheet" href="/UJA/css/headers.css">
    <link rel="stylesheet" href="/UJA/css/style.css">
</head>

<body>

    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">

        <div class="text-center" style="margin-right: 50%; margin-left: 50%; padding-bottom: 20px;">
            <img src="src/image.jpeg" alt="1em" sizes="" srcset="">
        </div>

        <div class="text-center">
            <h1 class="fw-light">Unité Jeunes Adultes</h1>
        </div>

        <div class="container">
            <header class="d-flex justify-content-center py-3">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a href="home.php" class="nav-link ">Home</a></li>
                    <li class="nav-item"><a href="films.php" class="nav-link active" aria-current="page">Films</a></li>
                    <li class="nav-item"><a href="lequipe.php" class="nav-link">L'equipe</a></li>
                    <li class="nav-item"><a href="groupe.php" class="nav-link">Groupe</a></li>
                </ul>
            </header>
        </div>
    </header>

    <section class="py-5 text-center container" id="text" style="margin-top: 0 !important; padding-top: 0px !important; padding-bottom: 0px !important;">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h2 class="fw-light">On se regarde un film ce soir ?</h2>
                <p class="lead text-muted">Clique sur le bouton "voter !" pour acceder à la page de vote et voter pour
                    ton film favori en espérant qu'il reporte suffisamment de voix pour être elu "film de la soirée" !
                </p>
                <p class="lead text-muted">Clique sur le bouton "Ajouter !" pour ajouter un film à la liste et qu'il
                    soit proposé au vote ! Les resultats sont disponibles à partir de 18h.</p>

                <p>
                    <?php
                    if (date('H') >= 18) {
                        echo "<a href=\"resultats.php\" class=\"btn btn-primary my-2\" style=\"width: 30%;\">Resulstats ! !</a>";
                    } else {
                        echo "<a href=\"vote.php\" class=\"btn btn-primary my-2\" style=\"width: 30%; margin-right: 5px;\">Voter !</a>";
                        echo "<a href=\"addFilm.php\" class=\"btn btn-secondary my-2\" style=\"width: 30%;margin-left: 5px;\">Ajouter !</a>";
                    }
                    ?>
                </p>
            </div>
        </div>
        <hr style="width: 80%; margin: auto;">
    </section>

    <footer class="py-3 my-4" id="footer">
        <div class="container"></div>
        <ul class="nav justify-content-center  pb-3 mb-3">
            <li class="nav-item"><a href="home.php" class="nav-link px-2 text-muted">Home</a></li>
            <li class="nav-item"><a href="films.php" class="nav-link px-2 text-muted">Films</a></li>
            <li class="nav-item"><a href="lequipe.php" class="nav-link px-2 text-muted">L'equipe</a></li>
            <li class="nav-item"><a href="groupe.php" class="nav-link px-2 text-muted">Groupe</a></li>
            <li class="nav-item"><a href="about.php" class="nav-link px-2 text-muted">About</a></li>
        </ul>
        <p class="text-center text-muted">&copy; 2022 <a href="https://github.com/mathisnns" style="text-decoration: none;">MathisNns</a></p>
        </div>
    </footer>




</body>

</html>