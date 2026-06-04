<style>
  .navbar-custom {
  background: linear-gradient(90deg, #2c3e50, #34495e);
  border: none;
  border-radius: 0;
}

.navbar-custom .navbar-brand,
.navbar-custom .navbar-nav > li > a {
  color: #ecf0f1;
  font-weight: bold;
}

.navbar-custom .navbar-nav > li > a:hover,
.navbar-custom .navbar-nav > li > a:focus {
  color: #1abc9c;
  background-color: transparent;
}

.navbar-custom .dropdown-menu {
  background-color: #34495e;
}

.navbar-custom .dropdown-menu > li > a {
  color: #ecf0f1;
}

.navbar-custom .dropdown-menu > li > a:hover {
  background-color: #1abc9c;
  color: #fff;
}

.welcome-msg {
  padding-right: 10px;
}
</style>


<nav class="navbar navbar-light" style="background-color: #e3f2fd;">
 <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand text-light" href="index.php">🛡️ Hero's Vault</a>
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-content">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <div class="collapse navbar-collapse" id="navbar-content">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Home</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            Menu <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="products.php">Products</a></li>
            <li><a href="customers.php">Customers</a></li>
            <li><a href="staffs.php">Staffs</a></li>
            <li><a href="orders.php">Orders</a></li>
          </ul>
        </li>

        <?php if (isset($_SESSION['staffid']) && isset($_SESSION['staffname'])): ?>
          <li class="navbar-text welcome-msg">Welcome, <strong><?php echo htmlspecialchars($_SESSION['staffname']); ?></strong></li>
          <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<!--session_start();
session_destroy();
header("Location: login.php");
exit;-->
