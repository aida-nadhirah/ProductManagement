<?php
ini_set('session.cookie_lifetime', 0); // Session expires on browser close

session_start(); // required for $_SESSION to work
include_once 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $staffid = $_POST['staffid'];
  $password = $_POST['password'];
  $hashed = hash('sha1', $password);

  try {
    $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a202713_pt2 WHERE FLD_STAFF_ID = ? AND FLD_PASSWORD = ?");
    $stmt->execute([$staffid, $hashed]);
    $user = $stmt->fetch();

    if ($user) {
      $_SESSION['staffid'] = $user['FLD_STAFF_ID'];
      $_SESSION['staffname'] = $user['FLD_STAFF_NAME'];
      $_SESSION['user_level'] = $user['FLD_STAFF_LEVEL'];
      header("Location: index.php");
      exit;
    } else {
      $error = "Invalid staff ID or password.";
    }
  } catch (PDOException $e) {
    $error = "Database error: " . $e->getMessage();
  }

  $conn = null;
}
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Hero's Vault Shop</title>
  <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: url('bg3.jpg') no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
      margin: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: Arial, sans-serif;
    }

    .login-box {
      background: rgba(255, 255, 255, 0.95);
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.3);
      width: 100%;
      max-width: 400px;
    }

    .login-box h2 {
      margin-bottom: 20px;
      text-align: center;
      font-weight: bold;
    }

    .form-control {
      margin-bottom: 15px;
    }

    .btn-primary {
      width: 100%;
    }

    .logo {
      display: block;
      margin: 0 auto 15px;
      width: 100px;
    }
  </style>
 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
 	
 
   <div class="login-container">
    <div class="login-box">
      <img src="logo.png" class="logo" alt="Hero's Vault">
      <h2 class="text-center">Login Page</h2>

      <?php if (!empty($error)) : ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
      <?php endif; ?>

      <form action="login.php" method="post">
        <div class="form-group">
          <label for="staffid">Staff ID</label>
          <input name="staffid" type="text" class="form-control" id="staffid" placeholder="Staff ID" required>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input name="password" type="password" class="form-control" id="password" placeholder="Password" required>
        </div>

        <div class="form-group text-center">
          <button type="submit" name="login" class="btn btn-primary"> <span class="glyphicon glyphicon-log-in"></span>Login</button>
        </div>
      </form>
    </div>
  </div>
 
   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>