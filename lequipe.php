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
    echo "<script>window.location.href='index.html';</script>";
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
    <link rel="stylesheet" href="css/carousel.css">
    <link rel="stylesheet" href="css/style.css">
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
                    <li class="nav-item"><a href="films.php" class="nav-link">Films</a></li>
                    <li class="nav-item"><a href="lequipe.php" class="nav-link active" aria-current="page">L'equipe</a></li>
                    <li class="nav-item"><a href="groupe.php" class="nav-link">Groupe</a></li>
                </ul>
            </header>
        </div>
    </header>

    <section class="py-5 text-center container" id="text" style="margin-top: 0 !important; padding-top: 0px !important;">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h2 class="fw-light">L'équipe de l'Unité Jeune Adulte !</h2>
                <p class="lead text-muted">Decouvre les superbes personnes qui font vivre cette unité et qui s'occupe de nous !
                </p>
            </div>
        </div>
        <hr style="width: 80%; margin: auto;">
    </section>


    <section>

        <div class="container marketing">
            <div class="row">

                <?php
                if ($file2 = fopen('/var/www/html/UJA/data/medsTokens', "r")) {

                    $file = file_get_contents('/var/www/html/UJA/data/meds.json');     //Get the list of the moovies.

                    $json = json_decode($file, true);       //Decode it into a json.

                    while (!feof($file2)) {

                        $token = fgets($file2);

                        echo "<div class=\"col- 12 col-lg-4\">";
                        echo "<img src=\"";
                        echo "/UJA/uploads/";
                        echo $json[intval($token)]["Photo"];
                        echo "\" class=\"bd-placeholder-img rounded-circle\" width=\"140\" height=\"140\" aria-label=\"Placeholder: 140x140\" preserveAspectRatio=\"xMidYMid slice\" focusable=\"false\" style=\"border: 5px solid #555;\">";
                        echo "<h2 class=\"fw-normal\">";
                        echo $json[intval($token)]["Name"];
                        echo "</h2>";
                        echo "<h4 class=\"fw-normal\">";
                        echo $json[intval($token)]["Fonction"];
                        echo "</h4>";
                        echo  "<p>";
                        echo $json[intval($token)]["Description"];
                        echo "</p>";
                        echo "<p>";
                        echo $json[intval($token)]["Age"];
                        echo " ans";
                        echo "</p>";

                        echo  "</div>";
                    }
                    fclose($file2);
                }
                ?>


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