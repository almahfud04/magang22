<?php

session_start();
$_SESSION = [];
session_unset();
session_destroy();

header("Location: /magang/admin/login.php");
exit;

?>