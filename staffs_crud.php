<?php
 
include_once 'database.php';
include_once 'authenticate.php';
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['create'])) {
  checkAccess(['Admin']);
  try {
 
    $stmt = $conn->prepare("INSERT INTO tbl_staffs_a202713_pt2(FLD_STAFF_ID, FLD_STAFF_NAME, FLD_POSITION_CODE,
      FLD_STAFF_PHONE, FLD_STAFF_EMAIL, FLD_PASSWORD, FLD_STAFF_LEVEL) VALUES(:sid, :name, :position,
      :phone, :email, :pass, :level)");

    $sid = $_POST['sid'];
    $name = $_POST['name'];
    $position =  $_POST['position'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $hashed = hash('sha1', $pass);
    $level = $_POST['level'];

    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':position', $position, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':pass', $hashed, PDO::PARAM_STR);
    $stmt->bindParam(':level', $level, PDO::PARAM_STR);
         
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
 
    $stmt = $conn->prepare("UPDATE tbl_staffs_a202713_pt2 SET
      FLD_STAFF_ID = :sid, FLD_STAFF_NAME = :name, FLD_POSITION_CODE = :position,
      FLD_STAFF_PHONE = :phone, FLD_STAFF_EMAIL = :email, FLD_PASSWORD = :pass, FLD_STAFF_LEVEL = :level
      WHERE FLD_STAFF_ID = :oldsid");

    $sid = $_POST['sid'];
    $name = $_POST['name'];
    $position = $_POST['position'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $oldsid = $_POST['oldsid'];
    $pass = $_POST['pass'];
    $hashed = hash('sha1', $pass);
    $level = $_POST['level'];

   
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':position', $position, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
     $stmt->bindParam(':pass', $hashed, PDO::PARAM_STR);
    $stmt->bindParam(':level', $level, PDO::PARAM_STR);

    $stmt->bindParam(':oldsid', $oldsid, PDO::PARAM_STR);
       
    
         
    $stmt->execute();
 
    header("Location: staffs.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Delete
if (isset($_GET['delete'])) {
  checkAccess(['Admin']);
 
  try {
 
    $stmt = $conn->prepare("DELETE FROM tbl_staffs_a202713_pt2 where FLD_STAFF_ID= :sid");
   
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
       
    $sid = $_GET['delete'];
     
    $stmt->execute();
 
    header("Location: staffs.php");
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
 
    $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a202713_pt2 where FLD_STAFF_ID = :sid");
   
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
       
    $sid = $_GET['edit'];
     
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