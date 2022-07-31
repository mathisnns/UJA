<?php
$key = file_get_contents('/var/www/html/UJA/data/keyMedics');


if ($_GET["Key"] == null) {
    echo "empty key";
    http_response_code(403);
} else if ($_GET["Key"] == $key) {

    

    $token = time();
    $token =  $token + rand(5, 15000000);
    $token =  $token + rand(5, 15000000);
    $token =  $token + rand(5, 15000000);


   
    file_put_contents('/var/www/html/UJA/data/medsTokens', $token, FILE_APPEND);
    file_put_contents('/var/www/html/UJA/data/medsTokens', "\n", FILE_APPEND);

  
    $error = file_put_contents('/var/www/html/UJA/data/tokens', $token, FILE_APPEND);
    file_put_contents('/var/www/html/UJA/data/tokens', "\n", FILE_APPEND);

    echo $token;

    $file = file_get_contents('/var/www/html/UJA/data/meds.json');     //Get the list of the moovies.

    $json = json_decode($file, true);       //Decode it into a json.

    $name = $_GET["name"];

    $json[$token]["Name"] = $name;
    $json[$token]["Voted"] = false;

    if (file_exists('/var/www/html/UJA/data/meds.json')) {
        //echo "Le fichier existe.";    

        $handle = fopen('/var/www/html/UJA/data/meds.json', 'r+');
        ftruncate($handle, filesize($filename));

        //echo "Le fichier a ete supprimé.";
    }

    file_put_contents('/var/www/html/UJA/data/meds.json', json_encode($json), FILE_APPEND);
} 
else {
    echo "wrong key";
    http_response_code(403);
}
