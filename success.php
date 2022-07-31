
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="icon" type="image/x-icon" href="/UJA/favicon.ico">

    <title>Unitée Jeunes Adultes</title>
    
  <!--CSS files -->
  <link rel="stylesheet" href="/UJA/css/bootstrap.min.css">
  <link rel="stylesheet" href="/UJA/css/headers.css">
  <link rel="stylesheet" href="/UJA/css/carousel.css">
  <link rel="stylesheet" href="/UJA/css/style.css">

  <script>
    function home() {
       window.location.href='/UJA/home.php';
    }
</script>
</head>

<body>

  <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">

    <div class="text-center" style="margin-right: 50%; margin-left: 50%; padding-bottom: 20px;">
      <img src="/UJA/src/image.jpeg" alt="1em" sizes="" srcset="">
    </div>

    <div class="text-center">
      <h1 class="fw-light">Unité Jeunes Adultes</h1>
    </div>

    <div class="container">
      <header class="d-flex justify-content-center py-3">
        <ul class="nav nav-pills">
          <li class="nav-item"><a href="home.php" class="nav-link ">Home</a></li>
          <li class="nav-item"><a href="films.php" class="nav-link active" aria-current="page">Films</a></li>
          <li class="nav-item"><a href="lequipe.php" class="nav-link " >L'equipe</a></li>
          <li class="nav-item"><a href="groupe.php" class="nav-link">Groupe</a></li>
        </ul>
      </header>
    </div>
  </header>

  <section class="py-5 text-center container" id="text" style="margin-top: 0 !important; padding-top: 0px !important;">
    <div class="row py-lg-5" style="margin-bottom: 0;">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h2 class="fw-light">Felicitation !</h2>
        <p class="lead text-muted">vous venez d'ajouter un film a la liste. A partir de maintenant, les autres patients pourront voter pour ton film ! 
        </p>
      </div>
    </div>
    <hr style="width: 80%; margin: auto;">
  </section>

  <section class="py-5 text-center container" id="text" style="margin-top: 0 !important; padding-top: 0px !important; padding-bottom: 0px !important;">
    <div class="col-lg-6 col-md-8 mx-auto" style="margin-bottom: 50px;">
        <button class="w-100 btn btn-lg btn-primary" onclick="home()">home</button>
    </div>

    <div class="col-lg-6 col-md-8 mx-auto">
        <hr style="margin: auto;">
    </div>
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