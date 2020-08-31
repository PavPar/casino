<?php
include "db.php";

echo (joinSession($_SESSION["user"]["id"], getData("session", true), 404));
