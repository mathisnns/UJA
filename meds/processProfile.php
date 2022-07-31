<?php


$token = $_COOKIE["token"];     //Get the cookie value.

////echo "got the cookie : ";

//echo  $token;
//echo "\n";

if ($token == null) {
    //If the cookie value is null, then there is no cookie, redirect to the login page ;
    echo "<script>window.location.href='login.html';</script>";
    exit;       //exit the code to avoid security problems.
}

//echo "token is OK : ";
//echo $token;
//echo "\n";

$file = file_get_contents('/var/www/html/UJA/data/meds.json');     //Get the list of the moovies.


$file2 = file_get_contents('/var/www/html/UJA/data/users.json');     //Get the list of the moovies.


$json2 = json_decode($file2, true);       //Decode it into a json.

$json = json_decode($file, true);       //Decode it into a json.

$json[$token]['Name'] = $_GET["Name"];

$json[$token]['Prenom'] = $json2[$token]["Name"];

$json[$token]['Fonction'] = $_GET["Fonc"];

$json[$token]['Age'] = $_GET["Age"];

$json[$token]['Description'] = $_GET["Desc"];




if (file_exists('/var/www/html/UJA/data/meds.json')) {
    ////echo "Le fichier existe.";
    $handle = fopen('/var/www/html/UJA/data/meds.json', 'r+');
    ftruncate($handle, filesize($filename));
    ////echo "Le fichier a ete supprimé.";
}

file_put_contents('/var/www/html/UJA/data/meds.json', json_encode($json), FILE_APPEND);

echo "<script>window.location.href='/UJA/HOME.php';</script>";
http_response_code(200);


