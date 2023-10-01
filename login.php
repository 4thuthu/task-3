<?php
//session_start();
$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "regist";
$conn =  mysqli_connect( $db_server,$db_user,$db_pass,$db_name);

setcookie('user');
?>

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
    $name = $pass = "";
    $nameErr = $passErr = "";
    // require field
    if($_SERVER["REQUEST_METHOD"] == "POST"){
      if(empty($_POST["username"])){
        $nameErr = "Require Field";
      }else{
        $name = $_POST["username"];
      }
      
      if(empty($_POST["pass"])){
        $passErr = "Require Field";
      }else{
        $pass = $_POST["pass"];
      }
    }
?>

<h2 style="text-align: center;">Login Form</h2> 
  <div style="width: 300px;
   margin-right: auto; margin-left: auto;
    background-color:bisque">
    
    <form method="post" 
    action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Username: <input type="text" name="username">
    <span class="error">* <?php echo $nameErr; ?> </span><br>
    Password: <input type="text" name="pass">
    <span class="error">* <?php echo $passErr; ?> </span><br>
    <input type="submit" name="submit" value="Login">
    <p>You don't have an account?</p>
      <a href="/insecure/register.php" style="padding: 5px 10px; border: 1px solid black; background: white; color: black; text-decoration: none;" >Register</a>
    </form> 
  </div>

<?php
 // check account
 if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(!empty($name) && !empty($pass)){ 
    $sql = "SELECT R_name, R_pass FROM users 
            WHERE R_name = '$name' and R_pass ='$pass'";
    $exist = mysqli_query($conn, $sql);
    if(mysqli_num_rows($exist) == 0){
      echo "Wrong username or password";
    }else{     
        header('Location: http://localhost/insecure/home.php');
        exit;
              }        
  }
} 
?> 
</body>
</html>