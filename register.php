<?php
   include("database.php");
   session_start();

 if(isset($_POST['login'])) {
  $pass="";
  $name="";
  $lvl="";

  $email=$_POST['uname'];
  $passcode=$_POST['psw'];

  
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $conn->prepare("SELECT fld_staff_fname, fld_staff_pass, fld_staff_lvl FROM tbl_staffs_a170567_final WHERE fld_staff_email= '$email' ");
    $stmt->execute();
    
    $result = $stmt->fetchAll();
    

  }
  catch(PDOException $e)
  {
    echo "Error: " . $e->getMessage();
    
  }
 
  $conn = null;
  
  foreach($result as $row) {
    $pass=$row["fld_staff_pass"];
    $name=$row["fld_staff_fname"];
    $lvl=$row["fld_staff_lvl"];
    
  } 


  if ($passcode==$pass) {
    $_SESSION["name"]=$name;
    $_SESSION["lvl"]=$lvl;
    
    header("Location: index.php");

  } else{
    
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login failed</title>
</head>
<body>
  <h2>Login failed. Invalid username or password.</h2>
    <p>
      Click <a href="login.html">here</a> to try again.
    </p>
</body>
</html>
<?php
}
  
}
?>