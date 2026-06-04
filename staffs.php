 <?php
  include_once 'staffs_crud.php';
  include_once 'authenticate.php';
  checkAccess(['Supervisor', 'Admin']);

  if (!isset($_SESSION['staffid'])) {
    header("Location: login.php");
    exit;
  }
?>

<!DOCTYPE html>
<html>
<head>
  <!-- Place this in <head> -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Hero's Vault Shop : Staffs</title>
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
    
    <form action="staffs.php" method="post" class="form-horizontal">
    <div class="form-group">
        <label for="staffid" class="col-sm-3 control-label">ID</label>
        <div class="col-sm-9">
          <input name="sid" type="text" class="form-control" id="staffid" placeholder="Staff ID" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_STAFF_ID']; ?>" required>
      </div>
    </div>
      
    <div class="form-group">
      <label for="staffname" class="col-sm-3 control-label">Name</label>
      <div class="col-sm-9">  
        <input name="name" type="text" class=" form-control" id="staffname" placeholder="Staff Name" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_STAFF_NAME']; ?>" required>
      </div>
    </div>

    <div class="form-group">
      <label for="position" class="col-sm-3 control-label">Position</label>
      <div class="col-sm-9">
        <input name="position" type="text" class=" form-control" id="position" placeholder="Position Code" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_POSITION_CODE']; ?>" required>
      </div>
    </div>

    <div class="form-group">
      <label for="pnum" class="col-sm-3 control-label">Phone</label>
      <div class="col-sm-9">
        <input name="phone" type="text" class="form-control" id= "pnum" placeholder="Phone Number" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_STAFF_PHONE']; ?>" required>
      </div>
    </div>

    <div class="form-group">
      <label for="semail" class="col-sm-3 control-label">Email</label>
      <div class="col-sm-9">
        <input name="email" type="text" class="form-control" id="semail" placeholder="Email" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_STAFF_EMAIL']; ?>" required> 
      </div>
    </div>

    <div class="form-group">
        <label for="pass" class="col-sm-3 control-label">Password</label>
        <div class="col-sm-9">

        <input name="pass" type="pass" class="form-control" id = "pass" placeholder ="Password" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_PASSWORD']; ?>" required> 
      </div>
    </div>

    <div class="form-group">
      <label for="level" class="col-sm-3 control-label">Level</label>
      <div class="col-sm-9">
       <select name="level" class="form-control" id="pbrand" required>
      <option value="">Please select</option>
      <option value="Normal" <?php if(isset($_GET['edit'])) if($editrow['FLD_STAFF_LEVEL']=="NORMAL STAFF") echo "selected"; ?>>Normal Staff</option>
      <option value="Supervisor" <?php if(isset($_GET['edit'])) if($editrow['FLD_STAFF_LEVEL']=="Supervisor") echo "selected"; ?>>Supervisor</option>
      <option value="Admin" <?php if(isset($_GET['edit'])) if($editrow['FLD_STAFF_LEVEL']=="Admin") echo "selected"; ?>>Admin</option>
  </select> 
      </div>
    </div>

    <div class="form-group">
       <div class="col-sm-offset-3 col-sm-9">
        <?php if (isset($_GET['edit'])) { ?>
        <input type="hidden" name="oldsid" value="<?php echo $editrow['FLD_STAFF_ID']; ?>">
        <button type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Update</button>
        <?php } else { ?>
        <button type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Create</button>
        <?php } ?>
        <button type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span>Clear</button>
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
          <th>Name</th>
          <th>Position</th>
          <th>Phone</th>
          <th>Email</th>
          <th></th>
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
           $stmt = $conn->prepare("select * from tbl_staffs_a202713_pt2 LIMIT $start_from, $per_page");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
      ?>
      <tr>
        <td><?php echo $readrow['FLD_STAFF_ID']; ?></td>
        <td><?php echo $readrow['FLD_STAFF_NAME']; ?></td>
        <td><?php echo $readrow['FLD_POSITION_CODE']; ?></td>
        <td><?php echo $readrow['FLD_STAFF_PHONE']; ?></td>
        <td><?php echo $readrow['FLD_STAFF_EMAIL']; ?></td>
        <td>
          <a href="staffs.php?edit=<?php echo $readrow['FLD_STAFF_ID']; ?>" class="btn btn-success btn-xs" role="button"> Edit </a>
          <a href="staffs.php?delete=<?php echo $readrow['FLD_STAFF_ID']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
        </td>
      </tr>
      <?php
      }
      $conn = null;
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
            $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a202713_pt2");
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
    <script>
  $(document).ready(function () {
    $("input").focus(function () {
      $(this).css("background-color", "#fff9c4");
    });
    $("input").blur(function () {
      $(this).css("background-color", "white");
    });
  });
</script>

     
    <script src="js/bootstrap.min.js"></script>
</body>
</html>