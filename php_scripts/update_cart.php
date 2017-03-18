<?php
//================= DATABASE CONNECT =====================
require_once '../include/config.php';

//================= IF CUSTOMER NOT LOGGED IN =====================
if(!isset($_SESSION['customerID'])) {
    $_SESSION["errorType"] = "warning";
    $_SESSION["errorMsg"]  = "Please login first or register.";
    header("Location:../index.php");
    die;
}

if(isset($_SESSION['customerID'])) {

$pid       = ($_GET['id']);
$cid       = ($_SESSION['customerID']);
$quantity  = htmlentities($_POST['quantity']);
    
/*==================================== VALIDATE QUANTITY INPUT ========================================*/    
if (strlen($quantity) != 1) {
    $_SESSION["errorType"] = "warning";
    $_SESSION["errorMsg"]  = "Please enter a quanity between 1 and 9.";
    header("location:../products.php");
    
} else {    
/*================================== CHECK FOR EXISTING PRODUCTS ========================================*/ 

    $sql  = "SELECT * FROM cart WHERE customerID = :cid AND productID = :pid";
    try {
        $stmt = $DB->prepare($sql);
        $stmt->bindValue(":cid", $cid);    
        $stmt->bindValue(":pid", $pid);
        $stmt->execute();
            $result = $stmt->rowCount();
            if ($result > 0) {
                $_SESSION["errorType"] = "warning";
                $_SESSION["errorMsg"]  = "This item has already been added to your cart";
                header("location:../products.php");
/*================================== ADD PRODUCT TO CART ========================================*/             
            } else if ($result === 0) {            
                 $sql = "INSERT INTO cart (customerID, productID, quantity) VALUES (:cid, :pid, :quantity)";
            try {
                $stmt = $DB->prepare($sql);
                // bind the values
                $stmt->bindValue(":cid", $cid);
                $stmt->bindValue(":pid", $pid);
                $stmt->bindValue(":quantity", $quantity);
                // execute Query
                $stmt->execute();

                $result = $stmt->rowCount();
                if ($result > 0) { 
                    $_SESSION["errorType"] = "success";
                    $_SESSION["errorMsg"]  = "Item successfully added to cart.";
                    header("location:../products.php");

                } else {
                    $_SESSION["errorType"] = "warning";
                    $_SESSION["errorMsg"]  = "Failed to add product to cart.";
                    header("location:../products.php");
                }
            }
            catch (Exception $ex) {
                $_SESSION["errorMsg"] = "warning";
                $_SESSION["errorMsg"]  = $ex->getMessage();
                header("location:../products.php");
            }   
            }
        }
        catch (Exception $ex) {
            $_SESSION["errorType"] = "warning";
            $_SESSION["errorMsg"]  = $ex->getMessage();
            header("location:../products.php");
        }
    }
}


?>

