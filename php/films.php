<?php

$token = $_COOKIE["token"];     //Get the cookie value.

if($token == null ){
    //If the cookie value is null, then there is no cookie, redirect to the login page ;
    echo "<script>window.location.href='login.html';</script>";
    exit;       //exit the code to avoid security problems.
}

if ($file = fopen('tokens', "r")) {
    //Open the token fils to read the registered tokens :
    $ok = false;
    while(!feof($file) && !$ok) {
        //while xe didn't reach the end of the file and the ok var is set to false ( we didn't found a corresponding token)

        $line = fgets($file);       //Get a line from the token file
        
        if($token == $line){
            //If the current line is the same as the token, then the user is registered and can enter the site !
            $ok = true;  
        }
    }
    fclose($file);      //closing the file.

    if(!$ok){
        //if the ok variable is set to false, then we didn't found a corresponding token, redirect to the login page.
     echo "<script>window.location.href='login.html';</script>";
    exit;       //exit the code to avoid security problems.
    }

    else{
        //continu to send the html page 
    }
}
?>













