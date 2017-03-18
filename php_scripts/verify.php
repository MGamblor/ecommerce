<?php
//================= DATABASE CONNECT =====================
require_once '../include/config.php';

//====================== IF CUSTOMER LOGIN FORM SUBMITTED ============================
$email       = ($_POST['email_login']);
$password    = ($_POST['password_login']);

$sql = "SELECT * FROM customers WHERE email = :email"; /*AND password = :password*/;

try {
    $stmt = $DB->prepare($sql);
    $stmt->bindValue(":email", $email);
    $stmt->execute();

    //check number of effected rows
    $result = $stmt->rowCount();

    if ($result === 0) {
        $_SESSION["errorType"] = "alert";
        $_SESSION['errorMsg'] = "Invalid Login. Register or try again.";
        header('location:../index.php');
    }

    while ($row = $stmt->fetch()){
        
        //check password
        $hashed_password = $row['password'];
        if(password_verify($password, $hashed_password)) {

        //set cookies    
        $expiry = time()+60*60*24*7; // 1 week   
        $encryptedCookieData = base64_encode("UaQteh5i4y3dntkSDFsdLMNOP{$row['customerID']}");    
        setcookie("rememberUserCookie", $encryptedCookieData, $expiry, "/", null, null, true);    
        setcookie('loginTime', time()-313, $expiry, "/");    

        //set sessions
        $_SESSION['customerID'] = $row['customerID'];  
        $_SESSION['firstName'] = $row['firstName'];          
        $_SESSION['lastName'] = $row['lastName'];

        //message alert    
        $_SESSION["errorType"] = "success";
        $_SESSION['errorMsg'] =  $_SESSION['firstName'] . " " . $_SESSION['lastName'] . " successfully logged in";
        header('location:../products.php');
    } else {
        $_SESSION["errorType"] = "alert";
        $_SESSION['errorMsg'] = "Invalid Login. Register or try again.";
        header('location:../index.php');
        }
    }
} catch (Exception $ex) {
    $_SESSION["errorType"] = "alert";
    $_SESSION["errorMsg"] = $ex->getMessage();
    header('location:../index.php');
}

?>