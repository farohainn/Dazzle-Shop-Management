<?php
  include_once 'staffs_crud.php';
  include('register.php');
  if(!isset($_SESSION["name"])) 
  header("Location: login.html");
  $msg ="";
  $css_class="";
?>
 
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Dazzle Ordering System : Staffs</title>
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
        <h2>Create New Staff</h2>
      </div>
      <?php if(isset($_SESSION["lvl"])){ if($_SESSION["lvl"]=="normal") $msg= "Sorry, you do not have a right to Create, Edit and Delete the data."; $css_class="alert-danger"; } ?>
      <?php if(!empty($msg)): ?>
        <div class="alert <?php echo $css_class; ?>">
      <?php  echo $msg ?>
        </div>
      <?php endif; ?>
    <form action="staffs.php" method="post" class="form-horizontal">
      <div class="form-group">
          <label for="staffid" class="col-sm-3 control-label">Staff ID</label>
          <div class="col-sm-9">
          <input name="sid" type="text" class="form-control" id="staffid" placeholder="Staff ID" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_num']; ?>" required>
        </div>
        </div>
      <div class="form-group">
          <label for="firstname" class="col-sm-3 control-label">First Name</label>
          <div class="col-sm-9">
          <input name="fname" type="text" class="form-control" id="firstname" placeholder="First Name" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_fname']; ?>" required>
        </div>
        </div>
      <div class="form-group">
          <label for="lastname" class="col-sm-3 control-label">Last Name</label>
          <div class="col-sm-9">
          <input name="lname" type="text" class="form-control" id="lastname" placeholder="Last Name" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_lname']; ?>" required>
        </div>
        </div>
      <div class="form-group">
          <label for="staffgender" class="col-sm-3 control-label">Gender</label>
          <div class="col-sm-9">
          <div class="radio">
              <label>
              <input name="gender" type="radio" id="staffgender" value="Male" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_gender']=="Male") echo "checked"; ?> required> Male
            </label>
          </div>
          <div class="radio">
              <label>
                <input name="gender" type="radio" id="staffgender" value="Female" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_gender']=="Female") echo "checked"; ?>> Female
            </label>
            </div>
          </div>
      </div>
      <div class="form-group">
          <label for="phonenumber" class="col-sm-3 control-label">Phone Number</label>
          <div class="col-sm-9">
          <input name="phone" type="text" class="form-control" id="phonenumber" placeholder="Phone Number" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_phone']; ?>" required>
        </div>
      </div>
      <div class="form-group">
          <label for="emailaddress" class="col-sm-3 control-label">Email Address</label>
          <div class="col-sm-9">
          <input name="email" type="text" class="form-control" id="emailaddress" placeholder="Email Address" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_email']; ?>" required>
        </div>
      </div>
      <div class="form-group">
          <label for="pass" class="col-sm-3 control-label">Password</label>
          <div class="col-sm-9">
          <input name="pass" type="text" class="form-control" id="pass" placeholder="Staff Password" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_pass']; ?>" required>
        </div>
      </div>
        <div class="form-group">
          <label for="lvl" class="col-sm-3 control-label">Staff Level</label>
          <div class="col-sm-9">
          <div class="radio">
              <label>
              <input name="lvl" type="radio" id="lvl" value="normal" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_lvl']=="normal") echo "checked"; ?> required> Normal
            </label>
          </div>
          <div class="radio">
              <label>
                <input name="lvl" type="radio" id="lvl" value="admin" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_lvl']=="admin") echo "checked"; ?>> Admin
            </label>
            </div>
          </div>
        </div>
      <div class="form-group">
          <label for="social" class="col-sm-3 control-label">Social Media</label>
          <div class="col-sm-9">
          <input name="social" type="url" class="form-control" id="social" placeholder="Insert Link Social Media" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_social']; ?>" required>
        </div>
      </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
          <?php if (isset($_GET['edit'])) { ?>
          <input type="hidden" name="oldsid" value="<?php echo $editrow['fld_staff_num']; ?>">
          <button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
          <?php } else { ?>
          <button class="btn btn-default" type="submit" <?php if(isset($_SESSION["lvl"])){ if($_SESSION["lvl"]=="normal") echo "disabled"; } ?> name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
          <?php } ?>
          <button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
        </div>
      </div>
    </form>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <div class="page-header">
        <h2>Staff List</h2>
      </div>
      <table class="table table-striped table-bordered">
        <tr>
          <th>Staff ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Gender</th>
          <th>Phone Number</th>
          <th>Username</th>
          <th>Password</th>
          <th>User Level</th>
          <th>Social Media</th>
          <th>Menu</th>
        </tr>
      <?php
      // Read
      $per_page = 5;
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page = 1;
      $start_from = ($page-1) * $per_page;
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a170567_final LIMIT $start_from, $per_page");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
      ?>
      <tr>
        <td><?php echo $readrow['fld_staff_num']; ?></td>
        <td><?php echo $readrow['fld_staff_fname']; ?></td>
        <td><?php echo $readrow['fld_staff_lname']; ?></td>
        <td><?php echo $readrow['fld_staff_gender']; ?></td>
        <td><?php echo $readrow['fld_staff_phone']; ?></td>
        <td><?php echo $readrow['fld_staff_email']; ?></td>
        <td><?php echo $readrow['fld_staff_pass']; ?></td>
        <td><?php echo $readrow['fld_staff_lvl']; ?></td>
        <td><?php echo $readrow['fld_staff_social']; ?></td>
        <td>
          <a <?php if(isset($_SESSION["lvl"])){ if($_SESSION["lvl"]=="normal") echo "disabled"; } ?> href="staffs.php?edit=<?php echo $readrow['fld_staff_num']; ?>"class="btn btn-success btn-xs" role="button"> Edit </a>
          <a <?php if(isset($_SESSION["lvl"])){ if($_SESSION["lvl"]=="normal") echo "disabled"; } ?> href="staffs.php?delete=<?php echo $readrow['fld_staff_num']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
        </td>
      </tr>
      <?php
      }
      ?>
      </table>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <nav>
          <ul class="pagination">
          <?php
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a170567_final");
            $stmt->execute();
            $result = $stmt->fetchAll();
            $total_records = count($result);
          }
          catch(PDOException $e){
                echo "Error: " . $e->getMessage();
          }
          $total_pages = ceil($total_records / $per_page);
          ?>
          <?php if ($page==1) { ?>
            <li class="disabled"><span aria-hidden="true">«</span></li>
          <?php } else { ?>
            <li><a href="staffs.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"staffs.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"staffs.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="staffs.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>
  </div>
</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
 
</body>
</html>