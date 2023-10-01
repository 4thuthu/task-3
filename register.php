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
    <title>DangKi</title>
</head>
<body>
<?php
    
    $name = "";
    $pass = 1;
    $confirm_pass = 2;
    $nameErr = $pass1Err = $pass2Err = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
      if(empty($_POST["name"])){
        $nameErr = "Require Field";
      }else{
        $name = $_POST["name"];
      }
      
      if(empty($_POST["pass1"])){
        $pass1Err = "Require Field";
      }else{
          $pass = $_POST["pass1"];
      }

      if(empty($_POST["pass2"])){
        $pass2Err = "Require Field";
      }else{
        $confirm_pass = $_POST["pass2"];
        if($pass != $confirm_pass){
          $pass2Err = "confirm failed"; 
        }
      }
      
    }
  ?>

  <h2 style="text-align: center;">Register</h2> 
  <div style="width: 300px;
   margin-right: auto; margin-left: auto;
    background-color:bisque">
    
    <form method="post" 
    action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Username: <input type="text" name="name">
    <span class="error">* <?php echo $nameErr; ?> </span><br>
    Password: <input type="text" name="pass1">
    <span class="error">* <?php echo $pass1Err; ?> </span><br>  
    Confirm Pass: <input type="text" name="pass2">
    <span class="error">* <?php echo $pass2Err; ?> </span><br>
    <input type="submit" name="submit" value="Submit">
   
    </form> 
  </div>

</body>
</html>
<?php 
   if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!empty($_POST["name"]) && $pass == $confirm_pass){
      $sql = "SELECT * FROM users WHERE R_name = '$name'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_array($result);
      if(isset($row)){
        $existed_name = $row["R_name"];
        echo "Username '$existed_name' is already existed! Change username please!";
        exit;
      }

    $username = $_POST["name"];
    $password = $_POST["pass1"];
    $sql = "INSERT INTO users (R_name, R_pass)
    VALUES ('$username', '$password')";

    if (mysqli_query($conn, $sql)) {
      echo "Registed".'<br>'.
            "<a href='/insecure/login.php'>Login</a>".'<br>';
     
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }
  
    //echo $username, "<br>", $password;
   }

  mysqli_close($conn); 
?>
