<?php
//================= DATABASE CONNECT =====================
include '../include/config.php';


// ======== IF CUSTOMER IS NOT LOGGED IN REDIRECT TO INDEX ==========
if(!$_SESSION['customerID']) {
    header("Location:../index.php");
    //close database connection
    die;                               
}

if(isset($_SESSION['customerID'])) {

 $quantity      = $_POST['cart_quantity'];
 $cartID        = $_POST['cartID'];    
    
//======================= VALIDATE QUANTITY INPUT ===========================   
if (strlen($quantity) != 1) {
    $_SESSION["errorType"] = "warning";
    $_SESSION["errorMsg"]  = "Please enter a quantity between 1 and 9.";
    header("location:../products.php");
    
} else {        

//================= CHECK IF QUANTITY HAS BEEN CHANGED =====================
    $sql = "SELECT * FROM cart WHERE quantity = :quantity AND cartID = :cartID";
        try {
            $stmt = $DB->prepare($sql);
            $stmt->bindValue(":quantity", $quantity);
            $stmt->bindValue(":cartID", $cartID);
            // execute Query
            $stmt->execute();
                $result = $stmt->rowCount();
                if ($result > 0) {
                    $_SESSION["errorType"] = "warning";
                    $_SESSION["errorMsg"]  = "No changes to quantity.";
                     header("location:../products.php");

//================= UPDATE QUANTITY IN CART =====================                
                } else if ($result === 0) {
                    $sql = "UPDATE cart SET quantity = :quantity WHERE cartID = :cartID";
                try {
                    $stmt = $DB->prepare($sql);
                    $stmt->bindValue(":quantity", $quantity);
                    $stmt->bindValue(":cartID", $cartID);
                    // execute Query
                    $stmt->execute();

                    $result = $stmt->rowCount();
                    if ($result > 0) {
                        $_SESSION["errorType"] = "success";
                        $_SESSION["errorMsg"]  = "Quantity updated successfully.";
                        header("location:../products.php");
                    } else {
                        $_SESSION["errorType"] = "warning";
                        $_SESSION["errorMsg"]  = "No changes to quantity.";
                        header("location:../products.php");
                    }
                }
                catch (Exception $ex) {
                    $_SESSION["errorType"] = "alert";
                    $_SESSION["errorMsg"]  = $ex->getMessage();
                    header("location:../products.php");
                }
            }
        }
        catch (Exception $ex) {
            $_SESSION["errorType"] = "alert";
            $_SESSION["errorMsg"]  = $ex->getMessage();
            header("location:../products.php");
        }
    }
}

?>