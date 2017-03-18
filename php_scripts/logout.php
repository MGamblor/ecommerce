<?php

require_once "../include/config.php";
//===== LOGOUT (END SESSION) =========

$expiry = time()-60*60*24*8; //8 days
setcookie("rememberUserCookie", $encryptedCookieData, $expiry, "/");
setcookie('loginTime', time()-313, $expiry, "/");     

session_destroy();
session_unset();

//===== LOGOUT MESSAGE =========
session_start();

if(!isset($_SESSION['customerID'])) {
    $_SESSION["errorType"] = "success";
    $_SESSION['errorMsg'] = "You have successfully logged out.";
    header("Location:../index.php");
}

?>

