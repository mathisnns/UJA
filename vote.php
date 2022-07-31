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
    exit;
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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/headers.css">
    <link rel="stylesheet" href="css/style.css">

    <!--CSS files -->
    <script>
        var film = 0;

        function sure(vari) {
            document.getElementById("films").style.display = "none";
            document.getElementById("text").style.display = "none";
            document.getElementsByTagName('header')[0].style.display = "none";
            document.getElementsByTagName('footer')[0].style.display = "none";
            document.getElementById("sure").style.display = "block";
            window.scrollTo(0, 0);
            film = vari;


        }

        function ok() {
            document.getElementById("circle").style.display = "block";
            document.getElementById("sure").style.display = "none";
            window.scrollTo(0, 0);
            console.log("on veut voir le film " + film);

            var url = "/UJA/php/processVote.php?titre=" + film;

            var getJSON = function(url, callback) {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', url, true);
                xhr.responseType = 'text';
                xhr.withCredentials = true;
                xhr.onload = function() {
                    var status = xhr.status;
                    if (status == 200) {

                        window.location.href = 'success.php';


                    } else {

                        window.location.href = 'alreadyVoted.php';

                    }
                };
                xhr.send();
            };

            getJSON(url, function(err, data) {
                if (err != null) {
                    console.error(err);
                    error();
                } else {

                    window.location.href = 'success.php';

                }
            });


        }

        function back() {
            document.getElementById("films").style.display = "block";
            document.getElementById("text").style.display = "block";
            document.getElementsByTagName('header')[0].style.display = "block";
            document.getElementsByTagName('footer')[0].style.display = "block";
            document.getElementById("sure").style.display = "none";
            window.scrollTo(0, 0);
        }
    </script>
</head>

<body>

    <header>
        <div class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">

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
                        <li class="nav-item"><a href="groupe.php        " class="nav-link">Groupe</a></li>
                    </ul>
                </header>
            </div>
        </div>
    </header>

    <section id="sure" style="display: none; margin-top: 0 !important; padding-top: 0px !important;">
        <div class="modal modal-sheet position-static d-block bg-secondary py-5" tabindex="-1" role="dialog" style="height: 100vh;" id="modalSheet">
            <div class="modal-dialog" role="document">
                <div class="modal-content rounded-4 shadow">
                    <div class="modal-header border-bottom-0">
                        <h5 class="modal-title">Voter pour ce titre ?</h5>
                        <button type="button" class="btn-close" onclick="back()" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-0">
                        <p>Es tu sur de voter pour ce film ? </p>
                    </div>
                    <div class="modal-footer flex-column border-top-0">
                        <button type="button" class="btn btn-lg btn-primary w-100 mx-0 mb-2" onclick="ok()">Voter</button>
                        <button type="button" class="btn btn-lg btn-light w-100 mx-0" onclick="back()">retour</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 text-center container" id="text" style="margin-top: 0 !important; padding-top: 0px !important;">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h2 class="fw-light">Vote pour le film de ce soir !</h2>
                <p class="lead text-muted">Clique sur le bouton "voter" sous ton film favori pour voter pour lui
                    et peut etre avoir une chance de le regarder ce soir !</p>
            </div>
        </div>
        <hr style="width: 80%; margin: auto;">
    </section>

    <section id="films">

        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">







                    <?php


                    $file = file_get_contents('/var/www/html/UJA/data/films.json');     //Get the list of the moovies.

                    $filmsJson = json_decode($file, true);       //Decode it into a json.

                    $i = 1;

                    while ($filmsJson[$i] != null) {

                        //echo $filmsJson[$i]["Titre"];

                        echo "<div class=\"col\">";
                        echo "<div class=\"card shadow-sm\">";
                        echo "<img src=";
                        echo $filmsJson[$i]["Photo"];
                        echo " class=\"bd-placeholder-img card-img-top\" width=\"100%\" height=\"225\"    style=\"overflow: hidden;\" >";

                        echo "<div class=\"card-body\"><h4>";
                        echo $filmsJson[$i]["Titre"];
                        echo "</h4>";

                        echo "<p class=\"card-text\"> Synopsis : ";
                        echo $filmsJson[$i]["Description"];
                        echo "</p>";

                        echo " <p>proposé par : ";
                        echo $filmsJson[$i]["From"];
                        echo "</p>";

                        echo "<div class=\"d-flex justify-content-between align-items-center\">
                        <button type=\"button\" class=\"btn btn-sm btn-outline-secondary\" onclick=\"sure(";
                        echo $i;
                        echo  ")\">Voter !</button>
                        <small class=\"text-muted\">Durée : ";

                        echo $filmsJson[$i]["Duration"];

                        echo "mins</small></div></div></div></div>";

                        $i = $i + 1;
                    }

                    ?>
                </div>
            </div>
        </div>
        </div>

        <hr style="width: 80%; margin: auto;">
    </section>


    <div class="container" style="display: none;" id="circle">
        <div class="d-flex justify-content-center ">
            <div class="circle"></div>
        </div>
    </div>

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