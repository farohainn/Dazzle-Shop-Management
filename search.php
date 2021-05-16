<?php
  include('register.php');
  if(!isset($_SESSION["name"])) 
  header("Location: login.html");
  // $msg ="";
  // $css_class="";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Dazzle Ordering System : Search Products</title>

  

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

 <?php include_once 'nav_bar.php'; ?>

 <div class="container-fluid">
  <div class="row">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
      <div class="page-header">
        <h2>Dazzle Product</h2>
        
      </div>

    <form action="search.php" method="post" class="form-horizontal">
      <div class="search-container">
        <div class="col-sm-9">
        <input type="text" placeholder="Search product (name, price and year) eg: Strawberry 50 2020" id="searching" name="search" class="form-control" >
        </div>
      </div>
        <button type="submit" class="btn btn-default" name="searchprod"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search</button>
        <div class="col-sm-9">
         <!-- <input name="pid" type="text" class="form-control" id="productid" placeholder="Product ID" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_id']; ?>" required> -->
        </div>
      </div>
    </form>
  </div>
</div>
<?php
$firstkey="";
$secondkey="";
$thirdkey="";

if(isset($_POST['searchprod'])){
  if($_POST['search']!=""){
    $searching=$_POST['search'];
    $pieces=explode(" ",$searching);
    if(count($pieces)==3){
    
  
    
    $firstkey=$pieces[0];
    $secondkey=$pieces[1];
    $thirdkey=$pieces[2];
    // echo $firstkey;
    // echo "<br />";
    // echo $secondkey;
    // echo $thirdkey;
?>
    <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <div class="page-header">
        <h2>Products Searched</h2>

        
      </div>
      <table class="table table-striped table-bordered">
    
      <tr>
        <th>Product ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Manufacturing Year</th>
        <th></th>
      </tr>
<?php

      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_products_a170567_pt2 WHERE fld_product_name like '%$firstkey%' AND fld_product_price like '%$secondkey%' AND  fld_product_year like '%$thirdkey%'");
          // SELECT * FROM Customers WHERE CustomerID like '%around the horn%' or CustomerName like '%around the horn%' AND CustomerID like '%4%' or  CustomerName like '%4%';
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
      ?> 
           <tr>
        <td><?php echo $readrow['fld_product_num']; ?></td>
        <td><?php echo $readrow['fld_product_name']; ?></td>
        <td><?php echo $readrow['fld_product_price']; ?></td>
        <td><?php echo $readrow['fld_product_year']; ?></td>
        <td>
          <a id="pop" data-href="products_details.php?pid=<?php echo $readrow['fld_product_num']; ?>" class="btn btn-warning btn-xs" role="button">Details</a>
          
        </td>
      </tr>
      <?php
      }
      $conn = null;
      ?>
 
    </table>
  </div>
</div>  
<?php
}else
// $msg="Please search based on Name, Price and Manufacturing Year. Only 3 words.";
// $css_class="alert-danger";
echo "<script type='text/javascript'>alert('Please search based on Name, Price and Manufacturing Year. Only 3 words. ');</script>";

  }else
  // $msg="Please enter a keyword to search.";
  // $css_class="alert-danger";
  echo "<script type='text/javascript'>alert('Please enter a keyword to search.');</script>";

}else{
  ?>
  <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
  <div class="page-header">
        <h2>No Products Searched</h2>

        
      </div>
      </div>
      <?php
}
    

?>

    <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Product Details</h4>
              </div>
              <div class="modal-body">

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>
</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
        $('[id*="pop"]').on('click',function(){
          var dataURL = $(this).attr('data-href');
            $('.modal-body').load(dataURL,function(){
                $('#myModal').modal({show:true});
            });
        }); 
    });
    </script>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>
