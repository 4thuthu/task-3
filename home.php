<?php
  $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "regist";
    $conn = mysqli_connect( $db_server,$db_user,$db_pass,$db_name);

    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcom</title>
</head>
<body>
</body>
</html>
<?php
  echo "welcom!";
?>
   




