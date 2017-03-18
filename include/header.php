<?php
require_once 'include/config.php';
?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="TAFE assessment">
    <meta name="project" content="Smart Tools">
    <meta name="keywords" content="HTML, PHP, SQL, Foundation 6, JavaScript, JQuery Alphanum">
    <meta name="author" content="Matthew Johnson">
    
    <title>Smart Tools</title>
    <link rel="stylesheet" type="text/css" href="css/foundation.css">
    <link rel="stylesheet" type="text/css" href="css/app.css">
</head>

<body>
    <div class="off-canvas-wrapper">
        <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>

            <div class="off-canvas position-left" id="mobile-menu" data-off-canvas>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="products.php">Products</a></li>
                    <?php if(!isset($_SESSION['customerID'])): ?>
                        <li><a href="index.php">Register</a></li>
                        <li><a href="index.php">Login</a></li>
                        <?php else: ?>
                            <li><a href="php_scripts/logout.php">Logout</a></li>
                            <?php endif ?>
                </ul>
            </div>

            <!-- MOBILE NAVIGATION -->

            <div class="off-canvas-content" data-of-canvas-content>
                <div class="title-bar show-for-small-only">
                    <div class="title-bar-left">
                        <button class="menu-icon" type="button" data-open="mobile-menu"></button>
                        <span class="title-bar-title">MENU</span>
                    </div>
                </div>

                <!-- DESKTOP NAVIGATION -->
                <nav class="top-bar nav-desktop">
                    <div class="wrap">

                        <div class="top-bar-left">
                            <h3 class="site-logo">Smart Tools</h3>
                        </div>

                        <div class="top-bar-right">
                            <ul class="menu menu-desktop">
                                <li><a href="index.php">Home</a></li>
                                <li><a href="products.php">Products</a></li>
                                <?php if(!isset($_COOKIE['loginTime'])): ?>
                                    <li><a href="index.php">Register</a></li>
                                    <li><a href="index.php">Login</a></li>
                                    <?php else: ?>
                                        <li><a href="php_scripts/logout.php">Logout</a></li>
                                        <?php endif ?>
                            </ul>
                        </div>
                    </div>
                </nav>