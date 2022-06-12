<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php


if ($_SERVER['REQUEST_METHOD'] === "POST") {

$str = $_POST["clave"];


$pasen = md5($str);

echo "Clave en MD5 Encrypt:"." ".$pasen;

echo "<br>";

$password = hash("sha256", $pasen);

echo "Clave en MD5 y SHA256 Encrypt:"." ". $password;

/// desencripta
echo "<br>";
if (md5($str) == $pasen)
  {
    echo "<br>";
      echo "MD5";
  echo "<br>";
  echo $str;
  
  }

  if ((hash("sha256", $pasen)) == $password)
  {
    echo "<br>";
    echo "MD5 y Sha256";
  echo "<br>";
  echo $pasen;
  exit;
  }

  

}
?> 

<form action="" method="POST">
   
    <div class="form-group">
  <label for=""></label>
  <input type="text" class="form-control" name="clave" id="" aria-describedby="helpId" placeholder="">
 
</div>
</form>



</body>
</html>