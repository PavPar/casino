
<?php
  include "db.php";
  checkAuth("./userLogin.php");
  consolelog(json_encode($_REQUEST));
  if (null === getData("name")
  || null === getData("info")
  || null === getData("time")
  || null === getData("game")) {
    header("Location: ../pages/createGame.php");
  } else {
    $time = floor(time() / 60) * 60 + getData("time");
    createSession(getData("name"), getData("desc"), getData("game"), $time);
    header("Location: ../index.php"); 
  }
?>