<?php
include("../php/db.php");

// if(isAdmin()){
//     $log = date('Y-m-d H:i:s') . ' - Произведен выход из управления';
//     file_put_contents(__DIR__ . '/admin_log.txt', $log . PHP_EOL, FILE_APPEND);
// }

session_destroy();
header("Location: ../index.php");
?>