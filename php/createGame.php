
<?php
  include "db.php";
  checkAuth("./userLogin.php");
  consolelog(json_encode($_REQUEST));
  if (null === getData("name")
  || null === getData("info")
  || null === getData("time")
  || null === getData("game_id")) {
    echo 'ujdyj';
  } else {
    $time = floor(time() / 60) * 60 + getData("time");
    createSession(getData("name"), getData("info"), getGameSlug(getData('game_id',true)), $time);
    //header("Location: ../index.php");
  }
?>