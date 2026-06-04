<?php
session_start();

if (!isset($_SESSION['staffid'])) {
  // User is not logged in
  header("Location: login.php");
  exit;
}

function checkAccess($required_roles = []) {
  if (!isset($_SESSION['user_level']) || !in_array($_SESSION['user_level'], $required_roles)) {
    echo "<script>alert('Access Denied: Insufficient rights'); window.history.back();</script>";
    exit;
  }
}
?>