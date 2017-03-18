<?php
//ini_set('session.cookie_secure','on');
error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
ob_start();
session_start();
define('DB_DRIVER', 'mysql');
define('DB_SERVER', 'localhost');
define('DB_SERVER_USERNAME', 'root');
define('DB_SERVER_PASSWORD', '');
define('DB_DATABASE', 'smart_tools');
define('PROJECT_NAME', 'Smart Tools');
$dboptions = array(
    PDO::ATTR_PERSISTENT => FALSE,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
);
try {
    $DB = new PDO(DB_DRIVER . ':host=' . DB_SERVER . ';dbname=' . DB_DATABASE, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, $dboptions);
}
catch (Exception $ex) {
    echo $ex->getMessage();
    die;
}
//get error/success messages
if ($_SESSION["errorType"] != "" && $_SESSION["errorMsg"] != "") {
    $ERROR_TYPE            = $_SESSION["errorType"];
    $ERROR_MSG             = $_SESSION["errorMsg"];
    $_SESSION["errorType"] = "";
    $_SESSION["errorMsg"]  = "";
}

//remeber user and reset user sessions
if (isset($_COOKIE['rememberUserCookie'])) {
    
    //Decode cookies and extract user ID
    $decryptCookieData = base64_decode($_COOKIE['rememberUserCookie']);
    $customer_id       = explode("UaQteh5i4y3dntkSDFsdLMNOP", $decryptCookieData);
    $customerID        = $customer_id[1];
    
    //check if id retrieved from the cookie exist in the database
    $sql = "SELECT * FROM customers WHERE customerID = :customerID";
    
        $stmt = $DB->prepare($sql);
        $stmt->bindValue(":customerID", $customerID);
        $stmt->execute();
        
        //start session
        if($row = $stmt->fetch()) {
            $_SESSION['customerID'] = $row['customerID'];
            $_SESSION['firstName'] = $row['firstName'];   
            $_SESSION['lastName'] = $row['lastName'];
        } 
    else {
        //log user out
        header('location:../php_scripts/logout.php');
    }
}

?>