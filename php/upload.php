
<?php
$token = $_COOKIE["token"];
$target_dir = "/var/www/html/UJA/uploads/";

$targetFile = "";


$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

$uploadOk = 1;

$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    //echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    //echo "File is not an image.";
    $uploadOk = 0;
  }
}


/*
// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
*/


$target_file = strval($target_dir) .strval($token) . "." . strval($imageFileType);
$target = strval($token) . "." . strval($imageFileType);

//echo $target_file;


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    //echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";

    echo "<script>window.location.href='/UJA/home.php';</script>";


    $file = file_get_contents('/var/www/html/UJA/data/meds.json');     //Get the list of the moovies.
    $json = json_decode($file, true);       //Decode it into a json.
    $json[intval($token)]["Photo"] = $target;
    if (file_exists('/var/www/html/UJA/data/meds.json')) {
      $handle = fopen('/var/www/html/UJA/data/meds.json', 'r+');
      ftruncate($handle, filesize($filename));
  }
  file_put_contents('/var/www/html/UJA/data/meds.json', json_encode($json), FILE_APPEND);
    

  } else {
    echo "Sorry, there was an error uploading your file.";
    exit;
  }
}
?>
