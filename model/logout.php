<?php
include "../config/config.php";
unset($_SESSION['isUserLogged']);
session_destroy();
header('location: '.$redirectURL_user); exit;

?>