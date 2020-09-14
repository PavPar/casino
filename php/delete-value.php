<?php
include 'db.php';

$previous = "javascript:history.go(-1)";
if(isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}

if(deleteValueFromTable(getData('table', true), getData('key', true), getData('id', true))){
    header("Location: ../pages/admin/admin.html");
}
