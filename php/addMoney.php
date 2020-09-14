
<?php
  include "db.php";
  checkAuth("./userLogin.php");
  addToUserBankEntry($_SESSION["user"]["id"], 1000, 'payment');
  header("Location: ../pages/userPAge.php");
?>