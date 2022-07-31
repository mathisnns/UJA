<?php

$token = $_COOKIE["token"];     //Get the cookie value.

if ($token == null) {
    //If the cookie value is null, then there is no cookie, redirect to the login page ;
    echo "<script>window.location.href='login.html';</script>";
    exit;       //exit the code to avoid security problems.
}




$file = file_get_contents('/var/www/html/UJA/data/users.json');     //Get the list of the moovies.



$json = json_decode($file, true);       //Decode it into a json.

if ($json[$token]["Voted"] == true) {
    //If the user has alreday voted for a film, forbid the access to the vote option and send an other web page.

    http_response_code(403);
    exit;       //exit the code to avoid security problems.
}
else {

}




$file = file_get_contents('/var/www/html/UJA/data/films.json');     //Get the list of the moovies.

$json = json_decode($file, true);       //Decode it into a json

echo " got the films.json file \n";
echo "\n";

$film = $_GET["titre"];

$json[$film]['Votes'] = $json[$film]['Votes'] + 1;

echo " the film number : ";
echo $_GET["film"];
echo " gained a vote. \ln";
echo "\n";
echo $json[$film]['Votes'] - 1;
echo " to ";
echo $json[$film]['Votes'];
echo "\n";

if (file_exists('/var/www/html/UJA/data/films.json')) {
    $handle = fopen('/var/www/html/UJA/data/films.json', 'r+');
    ftruncate($handle, filesize($filename));
}

file_put_contents('/var/www/html/UJA/data/films.json', json_encode($json), FILE_APPEND);

$file = file_get_contents('/var/www/html/UJA/data/users.json');     //Get the list of the moovies.

$json = json_decode($file, true);       //Decode it into a json.

$json[$token]["Voted"] = true;

if (file_exists('/var/www/html/UJA/data/users.json')) {
    $handle = fopen('/var/www/html/UJA/data/users.json', 'r+');
    ftruncate($handle, filesize($filename));
}

file_put_contents('/var/www/html/UJA/data/users.json', json_encode($json), FILE_APPEND);
