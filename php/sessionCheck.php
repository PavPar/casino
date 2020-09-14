<?php
include("db.php");
$time = floor(time() / 60) * 60;
$currentSessions = getSessionsByTime($time-5, $time + 55);
consolelog(json_encode($currentSessions));
foreach($currentSessions as $session) {
  sessionStart($session);
}


