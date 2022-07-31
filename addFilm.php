
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
    }
    else{
        //echo "sending the  right page to the client";
        $file = file_get_contents('/var/www/html/UJA/html/addFilm.html');
        //echo "got here";
        //echo var_dump($file);
        echo $file;
    }
}
else{
    echo "probleme d'ouverture du fichier ";
    http_response_code(500);
}
?>