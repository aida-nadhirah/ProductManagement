<?php
 
include_once 'database.php';
include_once 'authenticate.php';
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['create'])) {
  checkAccess(['Supervisor', 'Admin']);
  try {
 
      $stmt = $conn->prepare("INSERT INTO tbl_products_a202713_pt2(FLD_PRODUCT_ID,
        FLD_PRODUCT_NAME, FLD_PRODUCT_PRICE, FLD_PRODUCT_CATEGORY, FLD_PRODUCT_BRAND,
        FLD_PRODUCT_CONDITION, FLD_PRODUCT_MANUFACTURER) VALUES(:pid, :name, :price, :cat,
        :brand, :cond, :manu)");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_INT);
      $stmt->bindParam(':cat', $cat, PDO::PARAM_STR);
      $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
      $stmt->bindParam(':cond', $cond, PDO::PARAM_STR);
      $stmt->bindParam(':manu', $manu, PDO::PARAM_STR);
       
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $cat =  $_POST['cat'];
    $brand = $_POST['brand'];
    $cond = $_POST['cond'];
    $manu = $_POST['manu'];
     
    $stmt->execute();
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Update
if (isset($_POST['update'])) {
  checkAccess(['Supervisor', 'Admin']);
  try {
 
       $stmt = $conn->prepare("UPDATE tbl_products_a202713_pt2 SET FLD_PRODUCT_ID = :pid,
        FLD_PRODUCT_NAME = :name, FLD_PRODUCT_PRICE= :price, FLD_PRODUCT_CATEGORY = :cat, FLD_PRODUCT_BRAND = :brand,
        FLD_PRODUCT_CONDITION = :cond, FLD_PRODUCT_MANUFACTURER = :manu WHERE FLD_PRODUCT_ID = :oldpid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_INT);
      $stmt->bindParam(':cat', $cat, PDO::PARAM_STR);
      $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
      $stmt->bindParam(':cond', $cond, PDO::PARAM_STR);
      $stmt->bindParam(':manu', $manu, PDO::PARAM_STR);
      $stmt->bindParam(':oldpid', $oldpid, PDO::PARAM_STR);
       
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $cat =  $_POST['cat'];
    $brand = $_POST['brand'];
    $cond = $_POST['cond'];
    $manu = $_POST['manu'];
    $oldpid = $_POST['oldpid'];
     
    $stmt->execute();
 
    header("Location: products.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Delete
if (isset($_GET['delete'])) {
  checkAccess(['Supervisor', 'Admin']);
  try {
 
      $stmt = $conn->prepare("DELETE FROM tbl_products_a202713_pt2 WHERE FLD_PRODUCT_ID = :pid");
     
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
   checkAccess(['Supervisor', 'Admin']);
    try {
        $stmt = $conn->prepare("SELECT * FROM tbl_products_a202713_pt2 WHERE FLD_PRODUCT_ID = :pid");
        $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
        $pid = $_GET['edit'];  // Get the product ID from the URL
        $stmt->execute();
        
        // Fetch the data
        $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
        
        
        // If no record is found, handle this case
        if (!$editrow) {
            echo "Product not found!";
            exit;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
 
  $conn = null;
?>