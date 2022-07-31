<?php

$token = file_get_contents('data/tokenPart');

if($_COOKIE["token"] == $token) {
    echo "<script>window.location.href='login.html';</script>";
    exit;
}


$file = file_get_contents('films.json');

//echo $file;

$json = json_decode($file, true);

echo $json["1"]['Titre'];

echo $_COOKIE["name"];

echo "\n";
echo "\n";

if($_COOKIE["name"] == null) {
    echo "pas de cookie";
}



//$data = json_decode(file_get_contents('films.json'), true);

?>


<?php
//$homepage = file_get_contents('http://www.google.fr/');
//echo $homepage;
?>


<h1> test</h1>