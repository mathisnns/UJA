<?php

echo "in the process php";
echo "\n";

$file = file_get_contents('/var/www/html/UJA/data/films.json');     //Get the list of the moovies.

echo "got the file ";
echo "\n";

$json = json_decode($file, true);       //Decode it into a json.

$i = 1;

if ($json[$i] == null) {
    //if the fisrt value is null, then there are no fils and the file is empty. no need to enter in the while loop.
} else {
    while ($json[$i] != null) {
        echo $json[$i];
        //while the object i is not null, we continu to count the number of films. 
        $i++;
    }
    // there are $i films in the list !
}

echo "got the number of the film : ";
echo $i;
echo "\n";

$json[$i]['Titre'] = $_GET["titre"];

$json[$i]['Description'] = $_GET["desc"];

$json[$i]['Duration'] = $_GET["time"];

$json[$i]['Duration'] = $_GET["time"];

$json[$i]['Photo'] = $_GET["photo"];

$json[$i]['Votes'] = 0;

echo "set the film specs";
echo "\n";


$token = $_COOKIE["token"];     //Get the cookie value.

echo "got the cookie : ";

echo  $token;
echo "\n";

if ($token == null) {
    //If the cookie value is null, then there is no cookie, redirect to the login page ;
    echo "<script>window.location.href='login.html';</script>";
    exit;       //exit the code to avoid security problems.
}

echo "token not null !";
echo "\n";

$file = file_get_contents('/var/www/html/UJA/data/users.json');     //Get the list of the moovies.

echo "opened the file films";
echo "\n";

$usersJson = json_decode($file, true);       //Decode it into a json.

$json[$i]['From'] = $usersJson[$token]["Name"];

var_dump($json);

if (file_exists('/var/www/html/UJA/data/films.json')) {
    //echo "Le fichier existe.";
    $handle = fopen('/var/www/html/UJA/data/films.json', 'r+');
    ftruncate($handle, filesize($filename));
    //echo "Le fichier a ete supprimé.";
}


file_put_contents('/var/www/html/UJA/data/films.json', json_encode($json), FILE_APPEND);

http_response_code(200);


