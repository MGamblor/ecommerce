<?php
//================= DATABASE CONNECT =====================
require_once '../include/config.php';

/*================================== REGISTER CUSTOMER========================================*/ 
$first_name  = strip_tags(trim($_POST['first_name']));
$last_name   = strip_tags(trim($_POST['last_name']));
$address     = strip_tags(trim($_POST['address']));
$city        = strip_tags(trim($_POST['city']));
$postcode    = strip_tags(trim($_POST['postcode']));
$phone       = strip_tags(trim($_POST['phone']));
$email       = strip_tags(trim($_POST['email']));
$password    = trim($_POST['password']);
$hashed_password  = password_hash($password, PASSWORD_DEFAULT);

/*================================== CHECK FOR EXISTING PRODUCTS ========================================*/ 

$sql  = "SELECT email FROM customers WHERE email = :email";
    try {
    $stmt = $DB->prepare($sql);
    // bind the values
    $stmt->bindValue(":email", $email);
    // execute Query
    $stmt->execute();

    $result = $stmt->rowCount();
    if ($result > 0) {
        header("location:../index.php");
        $_SESSION["errorType"] = "alert";
        $_SESSION["errorMsg"]  = "Email address already exists";
/*================================== INSERT NEW CUSTOMER ========================================*/ 
    } else if ($result === 0) {
        $sql = "INSERT INTO customers (firstName, lastName, address, city, postcode, phone, email, password) 
        VALUES " . "( :first_name, :last_name, :address, :city, :postcode, :phone, :email, :password)";
        try {
            $stmt = $DB->prepare($sql);
            // bind the values
            $stmt->bindValue(":first_name", $first_name);
            $stmt->bindValue(":last_name", $last_name);
            $stmt->bindValue(":address", $address);
            $stmt->bindValue(":city", $city);
            $stmt->bindValue(":postcode", $postcode);
            $stmt->bindValue(":phone", $phone);
            $stmt->bindValue(":email", $email);
            $stmt->bindValue(":password", $hashed_password);
            // execute Query
            $stmt->execute();
/*================================== RETURN RESULT MESSAGE ==========================================*/
            $result = $stmt->rowCount();
            if ($result > 0) {
                header("location:../index.php");
                $_SESSION["errorType"] = "success";
                $_SESSION["errorMsg"]  = "Registration successful, please log in.";
            } else {
                header("location:../index.php");
                $_SESSION["errorType"] = "alert";
                $_SESSION["errorMsg"]  = "Failed to add contact.";
            }
        }
        catch (Exception $ex) {
            header("location:../index.php");
            $_SESSION["errorType"] = "alert";
            $_SESSION["errorMsg"]  = $ex->getMessage();
        }
    }
}
catch (Exception $ex) {
    header("location:../index.php");   
    $_SESSION["errorType"] = "alert";
    $_SESSION["errorMsg"]  = $ex->getMessage();
}


?>