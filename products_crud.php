<?php


include_once 'database.php';

 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['create'])) {


  $pid = $_POST['pid'];
  $name = $_POST['name'];
  $price = $_POST['price'];
  $brand =  $_POST['brand'];   
  $size = $_POST['size'];
  $year = $_POST['year'];
  $quantity = $_POST['quantity'];
  // $image = $_POST['fileToUpload'];
  $fileToUpload= $_FILES['fileToUpload']['name'];
  $target_file = 'products/' . $fileToUpload;
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  // Check if image file is a actual image or fake image
  if($check !== false) {
    $uploadOk = 1;
  } else {

    echo "<script type='text/javascript'>alert('File is not an image. ');</script>";
    $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 10000000) {

    echo "<script type='text/javascript'>alert('Sorry, your file is too large. ');</script>";
    $uploadOk = 0;
  }
 
  // Allow certain file formats
  if($imageFileType != "gif" ) {

    echo "<script type='text/javascript'>alert('Sorry, only GIF files are allowed. ');</script>";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    // $msg="Sorry, your file was not uploaded.";
    // $css_class="alert-danger";
    // if everything is ok, try to upload file
  }else {
      // $msg="Product uploaded";
      // $css_class="alert-success";


    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "<script type='text/javascript'>alert('Successfully uploaded. ');</script>";
      // Put your SQL UPDATE here
      include "database.php";

      try {


        $stmt = $conn->prepare("INSERT INTO tbl_products_a170567_pt2(fld_product_num,
          fld_product_name, fld_product_price, fld_product_brand, fld_product_size,
          fld_product_year, fld_product_quantity, fld_product_image) VALUES(:pid, :name, :price, :brand,
          :size, :year, :quantity, :fileToUpload)");
        $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_INT);
        $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
        $stmt->bindParam(':size', $size, PDO::PARAM_STR);
        $stmt->bindParam(':year', $year, PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':fileToUpload', $fileToUpload, PDO::PARAM_STR);
       

        $stmt->execute();
        
        header("Location:products.php");
      }
      catch(PDOException $e)
      {
        echo "Error: " . $e->getMessage();

      }
    }else {
      // $msg="Sorry, there was an error uploading your file.";
      echo "<script type='text/javascript'>alert('Sorry, there was an error uploading your file. ');</script>";
    }
  } 
}

 
//Update
if (isset($_POST['update'])) {

  $pid = $_POST['pid'];
  $name = $_POST['name'];
  $price = $_POST['price'];
  $brand =  $_POST['brand'];
  $size = $_POST['size'];
  $year = $_POST['year'];
  $quantity = $_POST['quantity'];
  $oldpid = $_POST['oldpid'];

  $fileToUpload= $_FILES['fileToUpload']['name'];
  $target_file = 'products/' . $fileToUpload;
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  // Check if image file is a actual image or fake image
  if($check !== false) {
    $uploadOk = 1;
  } else {

    echo "<script type='text/javascript'>alert('File is not an image. ');</script>";
    $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 10000000) {

    echo "<script type='text/javascript'>alert('Sorry, your file is too large. ');</script>";
    $uploadOk = 0;
  }
 
  // Allow certain file formats
  if($imageFileType != "gif" ) {
    echo "<script type='text/javascript'>alert('Sorry, only GIF files are allowed. ');</script>";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    // $msg="Sorry, your file was not uploaded.";
    // $css_class="alert-danger";
    // if everything is ok, try to upload file
  }else {


    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

      // $msg="The file is overwritten";
      // $css_class="alert-success";
      echo "<script type='text/javascript'>alert('The file is overwritten. ');</script>";
 
      try {
 
        $stmt = $conn->prepare("UPDATE tbl_products_a170567_pt2 SET fld_product_num = :pid, fld_product_name = :name, fld_product_price = :price, fld_product_brand = :brand, fld_product_size = :size, fld_product_year = :year, fld_product_quantity = :quantity, fld_product_image = :fileToUpload WHERE fld_product_num = :oldpid");
        $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_INT);
        $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
        $stmt->bindParam(':size', $size, PDO::PARAM_STR);
        $stmt->bindParam(':year', $year, PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':fileToUpload', $fileToUpload, PDO::PARAM_STR);
        $stmt->bindParam(':oldpid', $oldpid, PDO::PARAM_STR);
       
     
        $stmt->execute();
 
        header("Location: products.php");
      }
 
      catch(PDOException $e)
      {
        echo "Error: " . $e->getMessage();

      }
    }else {
      // $msg="Sorry, there was an error uploading your file.";
      echo "<script type='text/javascript'>alert('Sorry, there was an error uploading your file. ');</script>";
    }
  } 
}
 
//Delete
if (isset($_GET['delete'])) {
 
  try {
 
      $stmt = $conn->prepare("DELETE FROM tbl_products_a170567_pt2 WHERE fld_product_num = :pid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
       
    $pid = $_GET['delete'];
     
    $stmt->execute();
 
    header("Location: products.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Edit
if (isset($_GET['edit'])) {
 
  try {
 
      $stmt = $conn->prepare("SELECT * FROM tbl_products_a170567_pt2 WHERE fld_product_num = :pid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
       
    $pid = $_GET['edit'];
     
    $stmt->execute();
 
    $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 

 
  $conn = null;
?>