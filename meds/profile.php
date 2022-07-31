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
        function error() {
            document.getElementById("Form").style.display = "block";
            document.getElementById("circle").style.display = "none";
            document.getElementById("error").style.display = "block";
        }

        function question(number) {
            console.log("in the question");
            console.log(number);
            if (document.getElementById("question-" + number).style.display == "none") {
                document.getElementById("question-" + number).style.display = "flex";
            } else {
                document.getElementById("question-" + number).style.display = "none";
            }
        }


        function signIn() {
            document.getElementById("Form").style.display = "none";
            document.getElementById("header").style.display = "none";
            document.getElementById("button").style.display = "none";
            document.getElementById("footer").style.display = "none";
            document.getElementById("circle").style.display = "block";
            document.getElementById("Titre").style.display = "none";

            var name = document.getElementById("Name").value;
            var fonction = document.getElementById("Fonction").value;
            var age = document.getElementById("Age").value;
            var desc = document.getElementById("Desc").value;

            var url = "/UJA/meds/processProfile.php?Name=" + name + "&Fonc=" + fonction + "&Age=" + age + "&Desc=" + desc;

            console.log(url);

            

            var getJSON = function(url, callback) {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', url, true);
                xhr.responseType = 'text';
                xhr.onload = function() {
                    var status = xhr.status;
                    if (status == 200) {
                        window.location = "/UJA/meds/profilePicture.php";
                    } else {
                        error();
                    }
                };
                xhr.send();
            };

            getJSON(url, function(err, data) {
                if (err != null) {
                    console.error(err);
                    error();
                } else {

                }
            });
        }
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
                <p class="lead text-muted">Creation d'un profile medical :</p>
            </div>
        </div>
    </section>

    <section id="Form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-1"></div>
                <div class="col-9 col-sm-4">
                    <div class="form-floating">
                        <input type="name" id="Name" class="form-control" placeholder="name@example.com" style="padding-left: 10px; padding-right: 0px; margin-left: 0px; margin-right: 0px;">
                        <label for="floatingInput">Nom</label>
                    </div>
                </div>
                <div class="col-1 align-middle d-flex align-items-center" style="margin-left: 0px; padding-left:0; margin-right: 0px; padding-right:0;">
                    <input type="image" src="/UJA/src/question-circle-fill.svg" width="32" height="32" onclick="question(0)">
                </div>
                <div id="question-0" class="row justify-content-center" style="display:none">
                    <div class="col-8 col-md-3">
                        <p class="text-center">
                            Votre nom ! Il sera associé au prenom que jus avez rentré dans la page precedente..
                        </p>
                        <div class="">
                            <a href="javascript:question(0);" class="text-align-center">Reduire</a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row justify-content-center">
                <div class="col-md-1"></div>
                <div class="col-9 col-sm-4">
                    <div class="form-floating">
                        <input list="fonctions" id="Fonction" class="form-control" placeholder="name@example.com" style="padding-left: 10px; padding-right: 0px; margin-left: 0px; margin-right: 0px;">
                        <label for="floatingInput">Fonction</label>

                        <datalist id="fonctions">
                            <option value="Medecin">
                            <option value="Aide-soignant/e">
                            <option value="Infirmier/e">
                            <option value="Interne">
                            <option value="Psychologue">
                            <option value="Diététicienne">
                            <option value="Endocrinologue">
                            <option value="Cadre superieur de santé">
                            <option value="Psychomotricienne">
                            <option value="Assistante sociale">
                            <option value="Agent de service">
                            <option value="Admin du site web">
                        </datalist>
                    </div>
                </div>
                <div class="col-1 align-middle d-flex align-items-center" style="margin-left: 0px; padding-left:0; margin-right: 0px; padding-right:0;">
                    <input type="image" src="/UJA/src/question-circle-fill.svg" width="32" height="32" onclick="question(1)">
                </div>
                <div id="question-1" class="row justify-content-center" style="display:none">
                    <div class="col-8 col-md-3">
                        <p class="text-center">
                            La fonction que vous occupez (medecin, infirmier...).
                        </p>
                        <div class="">
                            <a href="javascript:question(1);" class="text-align-center">Reduire</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-1"></div>
                <div class="col-9 col-sm-4">
                    <div class="form-floating">
                        <input type="number" id="Age" class="form-control" placeholder="name@example.com" style="padding-left: 10px; padding-right: 0px; margin-left: 0px; margin-right: 0px;">
                        <label for="floatingInput">Age</label>
                    </div>
                </div>
                <div class="col-1 align-middle d-flex align-items-center" style="margin-left: 0px; padding-left:0; margin-right: 0px; padding-right:0;">
                    <input type="image" src="/UJA/src/question-circle-fill.svg" width="32" height="32" onclick="question(2)">
                </div>
                <div id="question-2" class="row justify-content-center" style="display:none">
                    <div class="col-8 col-md-3">
                        <p class="text-center">
                            Votre âge
                        </p>
                        <div class="">
                            <a href="javascript:question(2);" class="text-align-center">Reduire</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-1"></div>
                <div class="col-9 col-sm-4">
                    <div class="form-floating">
                        <input type="text" id="Desc" class="form-control" placeholder="name@example.com" style="padding-left: 10px; padding-right: 0px; margin-left: 0px; margin-right: 0px;">
                        <label for="floatingInput">Description (facultatif)</label>
                    </div>
                </div>
                <div class="col-1 align-middle d-flex align-items-center" style="margin-left: 0px; padding-left:0; margin-right: 0px; padding-right:0;">
                    <input type="image" src="/UJA/src/question-circle-fill.svg" width="32" height="32" onclick="question(3)">
                </div>
                <div id="question-3" class="row justify-content-center" style="display:none">
                    <div class="col-8 col-md-3">
                        <p class="text-center">
                            Une courte description de vous qui sera affichée sur la page 'lequipe.php'.
                        </p>
                        <div class="">
                            <a href="javascript:question(3);" class="text-align-center">Reduire</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">


                <div id="button" class="container" style="padding: 20px;">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 justify-content-center">
                        <div>
                            <input type="submit" class="w-100 btn btn-lg btn-primary" value="Creer le profile" name="submit" onclick="signIn()">
                            <!--<button class="w-100 btn btn-lg btn-primary" onclick="signIn()">Creer</button>-->
                        </div>

                    </div>
                </div>
            </div>
    </section>




    <footer id="footer" class="py-3 my-4">
        <div class="container"></div>
        <p class="text-center text-muted">&copy; 2022 <a href="" style="text-decoration: none;">Mathis Nns</a> </p>
        </div>
    </footer>
</body>

</html>