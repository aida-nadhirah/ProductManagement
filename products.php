<?php
  include_once 'products_crud.php';
  
  if (!isset($_SESSION['staffid'])) {
    header("Location: login.php");
    exit;
    }
?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Hero's Vault Shop : Products</title>
   <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
 <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap.min.css">
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
        <h2>Create New Product</h2>
      </div>
      <div class = "form-horizontal">
  
   <form action="products.php" method="post">

    <div class="form-group">
      <label for="productid" class="col-sm-3 control-label">ID</label>
      <div class="col-sm-9">
        <input name="pid" type="text" class = "form-control" id ="productid" placeholder = "Product ID" value="<?php if(isset($editrow['FLD_PRODUCT_ID'])) echo $editrow['FLD_PRODUCT_ID']; ?>" required>
      </div>
   </div> 

   <div class="form-group">
      <label for="productname" class="col-sm-3 control-label">Name</label>
      <div class="col-sm-9">
        <input name="name" type="text" class="form-control" id= "productname" placeholder ="Product Name" value="<?php if(isset($editrow['FLD_PRODUCT_NAME'])) echo $editrow['FLD_PRODUCT_NAME']; ?>" required>
      </div>
  </div>
   
   <div class="form-group">
          <label for="pprice" class="col-sm-3 control-label">Price</label>
          <div class="col-sm-9">
   <input name="price" type="text" class="form-control" id="pprice" placeholder="Product Price" value="<?php if(isset($editrow['FLD_PRODUCT_PRICE'])) echo $editrow['FLD_PRODUCT_PRICE']; ?>" min="0.0" step="0.01" required>
 </div>
</div>
   
   <div class="form-group">
          <label for="pcat" class="col-sm-3 control-label">Category</label>
          <div class="col-sm-9">
   <input name="cat" type="text" class="form-control" id="pcat" placeholder="Product Category" value="<?php if(isset($editrow['FLD_PRODUCT_CATEGORY'])) echo $editrow['FLD_PRODUCT_CATEGORY']; ?>" required> 
 </div>
</div>
   
   <div class="form-group">
          <label for="pbrand" class="col-sm-3 control-label">Brand</label>
          <div class="col-sm-9">
   <select name="brand" class="form-control" id="pbrand" required>
  <option value="">Please select</option>
  <option value="DC Comics" <?php if(isset($_GET['edit'])) if($editrow['FLD_PRODUCT_BRAND']=="DC Comics") echo "selected"; ?>>DC Comics</option>
  <option value="Looney Tunes" <?php if(isset($_GET['edit'])) if($editrow['FLD_PRODUCT_BRAND']=="Looney Tunes") echo "selected"; ?>>Looney Tunes</option>
  </select>
</div>
</div>


   <div class="form-group">
          <label for="productcond" class="col-sm-3 control-label">Condition</label>
          <div class="col-sm-9">
          <div class="radio">
            <label>
              <input name="cond" type="radio" id="productcond" value="New" <?php if(isset($_GET['edit'])) if($editrow['FLD_PRODUCT_CONDITION']=="NEW") echo "checked"; ?> required> New
            </label>
          </div>
          <div class="radio">
            <label>
              <input name="cond" type="radio" id="productcond" value="New" <?php if(isset($_GET['edit'])) if($editrow['FLD_PRODUCT_CONDITION']=="USED") echo "checked"; ?>> Used
            </label>
          </div>
        </div>
      </div>
   
   <div class="form-group">
          <label for="pmanufact" class="col-sm-3 control-label">Manufacturer</label>
          <div class="col-sm-9">
   <input name="manu" type="text" class="form-control" id="pmanufact" placeholder="Product Manufacturer" value="<?php if(isset($editrow['FLD_PRODUCT_MANUFACTURER'])) echo $editrow['FLD_PRODUCT_MANUFACTURER']; ?>" required>
 </div>
</div>

 <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
   <?php if (isset($_GET['edit'])) { ?>
      <input type="hidden" name="oldpid" value="<?php echo $editrow['FLD_PRODUCT_ID']; ?>">
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
</div>

     <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <div class="page-header">
        <h2>Products List</h2>
      </div>

      <table id="productTable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Product ID</th>
      <th>Name</th>
      <th>Price</th>
      <th>Category</th>
      <th>Brand</th>
      <th>Condition</th>
      <th>Manufacturer</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT * FROM tbl_products_a202713_pt2");
      $stmt->execute();
      $result = $stmt->fetchAll();
      foreach ($result as $readrow) {
    ?>
    <tr>
      <td><?php echo $readrow['FLD_PRODUCT_ID']; ?></td>
      <td><?php echo $readrow['FLD_PRODUCT_NAME']; ?></td>
      <td><?php echo $readrow['FLD_PRODUCT_PRICE']; ?></td>
      <td><?php echo $readrow['FLD_PRODUCT_CATEGORY']; ?></td>
      <td><?php echo $readrow['FLD_PRODUCT_BRAND']; ?></td>
      <td><?php echo $readrow['FLD_PRODUCT_CONDITION']; ?></td>
      <td><?php echo $readrow['FLD_PRODUCT_MANUFACTURER']; ?></td>
      <td>
        <a href="products_details.php?pid=<?php echo $readrow['FLD_PRODUCT_ID']; ?>" class="btn btn-warning btn-xs" role="button">Details</a>
        <a href="products.php?edit=<?php echo $readrow['FLD_PRODUCT_ID']; ?>" class="btn btn-success btn-xs" role="button"> Edit </a>
        <a href="products.php?delete=<?php echo $readrow['FLD_PRODUCT_ID']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
      </td>
    </tr>
    <?php
      }
      $conn = null;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
    ?>
  </tbody>
</table>
<div id="exportBtnContainer" class="text-right" style="margin-top: 10px;"></div>


  </div>
</div>

<a href="logout.php" id="logout-link">Logout</a>

  <script>
$(document).ready(function () {
  $('#productTable').DataTable({
    lengthMenu: [[5, 10, 20, 30, -1], [5, 10, 20, 30, "All"]],
    columnDefs: [
      { targets: 2, searchable: false }, // Exclude "Price" column from search (index 2)
    ],
    order: [[1, 'asc']], // Default sort by "Name" column (index 1)
    dom: 't',
    buttons: [
      {
        extend: 'excelHtml5',
        text: 'Export to Excel',
        className: 'btn btn-success btn-sm'
      }
    ]
  });
  table.buttons().container().appendTo('#exportBtnContainer');
});
</script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>

<!-- DataTables JS + Buttons -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

<!-- Initialize DataTable -->
<script>
  $(document).ready(function () {
    $('#productTable').DataTable({
      lengthMenu: [[5, 10, 20, 30, -1], [5, 10, 20, 30, "All"]],
      columnDefs: [
        { targets: 2, searchable: false } 
      ],
      order: [[1, 'asc']], 
      dom: 'Blfrtip',
      buttons: [
        {
          extend: 'excelHtml5',
          text: 'Export to Excel',
          className: 'btn btn-success btn-sm'
        }
      ]
    });
  });
</script>


</body>
</html>

<?php
 
$product = array
  (
  array('pid' => "P001", 'name' => "Movie", 'price' => "2807", 'Category' => "Figures"),
  array('pid' => "P002", 'name' => "Superman Black Suit", 'price' => "778" , 'Category' => "Figures"),
  array('pid' => "P003", 'name' => "Call to Action", 'price' => "2830" , 'Category' => "Figures"),
  array('pid' => "P004", 'name' => "Cyborg Superman", 'price' => "5496" , 'Category' => "Figures"),
  array('pid' => "P005", 'name' => "Clark Kent Deluxe", 'price' => "825" , 'Category' => "Figures"),
  array('pid' => "P006", 'name' => "Superman Deluxe Version", 'price' => "4740" , 'Category' => "Figures"),
  array('pid' => "P007", 'name' => "Protectors of The Universe", 'price' => "1722" , 'Category' => "Art Print"),
  array('pid' => "P008", 'name' => "LED Logo Light", 'price' => "518" , 'Category' => "Wall Light"),
  array('pid' => "P009", 'name' => "10Z Silver Coin", 'price' => "467" , 'Category' => "Coin"),

  
  array('pid' => "P0010", 'name' => "Superman Classic", 'price' => "450" , 'Category' => "Statue"),
  );
 
?>