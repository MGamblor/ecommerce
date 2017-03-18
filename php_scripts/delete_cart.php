<?php
//================= DATABASE CONNECT ======================
require_once '../include/config.php';

// ======== IF CUSTOMER IS NOT LOGGED IN REDIRECT TO INDEX ==========
if(!$_SESSION['customerID']) {
    header("Location:../index.php");
    //close database connection
    die;                               
}

//======= IF CUSTOMER LOGGED IN DELETE CART ITEM ==========

if(isset($_SESSION['customerID'])) {
    
    $pid = ($_GET['pid']);
    $cid = ($_SESSION['customerID']);

    $sql  = "DELETE FROM cart WHERE customerID = :cid AND productID = :pid";
     
    $stmt = $DB->prepare($sql);
    $stmt->bindValue(":cid", $cid); 
    $stmt->bindValue(":pid", $pid);
    $stmt->execute();
    
    $_SESSION["errorType"] = "warning";
    $_SESSION["errorMsg"]  = "Item removed from cart.";
    
    header("location:../products.php");
}

?>