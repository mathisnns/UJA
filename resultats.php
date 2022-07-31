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

        $name = "";


        $file = file_get_contents('/var/www/html/UJA/data/users.json');     //Get the list of the moovies.

        $usersJson = json_decode($file, true);       //Decode it into a json.

        $name = $usersJson[$token]["Name"];

        //echo "sending the  right page to the client";
        //$file = file_get_contents('/var/www/html/UJA/html/home.html');

        /*

        echo "got here";
        //echo var_dump($file);

        $filename = "/var/www/html/UJA/html/home.html";

        echo "got the filename";

        $filesize = filesize( $filename );

        echo "got the file size : ";
        echo $filesize;

        $file = fopen( $filename, "r" );

        echo "opened the file";

        $toRead = 1800;

        $filetext = fread( $file, $toRead );

        echo "got here after reading 1800 caracteres";

        $filetext =  $filetext + "mathis" ;

        echo "added he name";

        $filetext = fread( $file, $filesize );

        echo $filetext;

        */
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
                    <li class="nav-item"><a href="home.php" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="films.php" class="nav-link active" aria-current="page">Films</a></li>
                    <li class="nav-item"><a href="lequipe.php" class="nav-link">L'equipe</a></li>
                    <li class="nav-item"><a href="groupe.php" class="nav-link">Groupe</a></li>
                </ul>
            </header>
        </div>
    </header>

    <section class="py-5 text-center container" id="text" style="margin-top: 0 !important; padding-top: 0px !important; padding-bottom: 0px !important;">
        <div class="row py-lg-5" style="padding-top: 10px !important; padding-bottom: 20px !important;">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h3 class="fw-light">Resultats !</h3>
                <p class="lead text-muted">Voici le film ayant remporté le plus de voies aujourdhui : </p>
            </div>
        </div>

    </section>

    <div class="container justify-content-center">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 justify-content-center">
            <div class="col ">
                <div class="card shadow-sm">

                    <?php
                    $file = file_get_contents('/var/www/html/UJA/data/films.json');     //Get the list of the moovies.

                    $json = json_decode($file, true);       //Decode it into a json.

                    $i = 1;

                    $higest = 0;

                    while ($json[$i] != null) {

                        if($json[$i]["Votes"] > $highest){
                            $higest = $i;
                        }
                        $i = $i + 1;
                    }
                    ?>
                    <img src="<?php echo $json[$higest]["Photo"]; ?>" alt="" class="bd-placeholder-img card-img-top" height="225" style="overflow: hidden;">

                    <div class="card-body">
                        <h4><?php echo $json[$higest]["Titre"]; ?></h4>
                        <p class="card-text">
                        <?php echo $json[$higest]["Description"]; ?>
                        </p>

                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">Durée : <?php echo $json[$higest]["Duration"]; ?> mins</small>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <section class="py-5 text-center container" id="text" style="margin-top: 0 !important; padding-top: 0px !important; padding-bottom: 0px !important;">
        <div class="row py-lg-5" >
            <div class="col-lg-6 col-md-8 mx-auto">
                <p class="lead text-muted">Bravo a <?php echo $json[$higest]["From"]; ?> pour sa superbe proposition qui a accumulé <?php echo $json[$higest]["Votes"]; ?> votes ! </p>
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