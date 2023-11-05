<?php
include "../../config/config.php";
unset($_SESSION['isAdminUserLogged']);
session_destroy();
header('location: '.$redirectURL_admin); exit;
?>