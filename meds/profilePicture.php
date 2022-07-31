<?php
$token = $_COOKIE["token"];

if ($token == null) {

    //echo "no token found";
    echo "<script>window.location.href='/UJA/index.html';</script>";
    exit;
}

if ($file = fopen('/var/www/html/UJA/data/medsTokens', "r")) {


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
        echo "<script>window.location.href='/UJA/index.html';</script>";
        exit;       //exit the code to avoid security problems.
    } else {

        $name = "";


        $file = file_get_contents('/var/www/html/UJA/data/meds.json');     //Get the list of the moovies.

        $usersJson = json_decode($file, true);       //Decode it into a json.

        $name = $usersJson[$token]["Name"];
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

    <title>Med's profile</title>

    <link rel="stylesheet" href="/UJA/css/bootstrap.min.css">

    <link rel="stylesheet" href="/UJA/css/style.css">

    <script>
    </script>
</head>


<body>

    <header id="header" class="d-flex flex-wrap justify-content-center py-3 mb-4">
        <div class="text-center" style="margin-right: 50%; margin-left: 50%; padding-bottom: 20px;">
            <img src="/UJA/src/image.jpeg" alt="1em" sizes="" srcset="">
        </div>
        <div class="text-center">
            <h1 class="fw-light">Unité Jeunes Adultes</h1>
        </div>
        <hr style="width: 80%; margin: auto;">
    </header>

    <section>
        <div class="container" style="display: none;" id="circle">
            <div class="d-flex justify-content-center ">
                <div class="circle"></div>
            </div>
    </section>



    <section id="Titre" class="py-5 text-center container" id="text" style="margin-top: 0 !important; padding-top: 0px !important; padding-bottom: 0px !important;">
        <div class="row py-lg-5" style="padding-top: 10px !important; padding-bottom: 20px !important;">
            <div class="col-lg-6 col-md-8 mx-auto">
                <p class="lead text-muted">Ajouter une photo de profile ?</p>
            </div>
        </div>
    </section>




    <section class="py-5 text-center container" id="text" style="margin-top: 0 !important; padding-top: 0px !important; padding-bottom: 0px !important;">

        <form action="/UJA/php/upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" id="fileToUpload">
            <div class="row py-lg-5">
                <p>
                    <input type="submit" value="Selectionner" name="submit" class="btn btn-primary my-2" style="width: 30%;">
                    <a href="/UJA/home.php" class="btn btn-secondary my-2" style="width: 30%;">pas maintenant !</a>
                </p>
            </div>
        </form>
        <hr style="width: 80%; margin: auto;">
    </section>


    <footer id="footer" class="py-3 my-4">
        <div class="container"></div>
        <p class="text-center text-muted">&copy; 2022 <a href="" style="text-decoration: none;">Mathis Nns</a> </p>
        </div>
    </footer>
</body>

</html>