<?php
require_once 'include/header.php';
?>

<!-- MAIN CONTENT SECTION -->
<section class="main">
    <div class="row">
        <div class="large-10 large-offset-1 columns">
            <?php if ($ERROR_MSG <> "") { ?>
            <div class="<?php echo $ERROR_TYPE ?> callout" data-closable="slide-out-right">
                    <h5><?php echo $ERROR_MSG; ?></h5>
                    <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="wrap row">                   
       <?php 
        if(!isset($_SESSION['customerID'])) {
        ?>
        <!-- ====================================== REGISTRATION FORM ================================ -->    
        <div class="small-12 medium-6 column">
            <h1>Register</h1>
            <div class="row">
                <div class="large-10 columns">
                    <hr>
                    <div class="signup-panel">
                        <p class="welcome"> Please register below.</p>
                        <form id="registration_form" action="php_scripts/processCust.php" method="post">
                            <div class="row collapse">
                                <div class="small-12 columns">
                                    <input type="text" id="first_name" placeholder="first name" name="first_name" maxlength="30">
                                    <span id="first_name_err" class="error"></span>
                                </div>
                            </div>
                            <div class="row collapse">
                                <div class="small-12 columns">
                                    <input type="text" id="last_name" placeholder="last name" name="last_name" maxlength="30">
                                    <span id="last_name_err" class="error"></span>
                                </div>
                            </div>
                            <div class="row collapse">
                                <div class="small-12 columns">
                                    <input type="text" id="address" placeholder="address" name="address" maxlength="60">
                                    <span id="address_err" class="error"></span>
                                </div>
                            </div>
                            <div class="row collapse">
                                <div class="small-12 columns">
                                    <input type="text" id="city" placeholder="city" name="city" maxlength="30">
                                    <span id="city_err" class="error"></span>
                                </div>
                            </div>
                            <div class="row collapse">
                                <div class="small-12 columns">
                                    <input type="text" id="postcode" placeholder="postcode" name="postcode" maxlength="4">
                                    <span id="postcode_err" class="error"></span>
                                </div>
                            </div>
                            <div class="row collapse">
                                <div class="small-12 columns">
                                    <input type="text" id="phone" placeholder="mobile" name="phone" maxlength="10">
                                    <span id="phone_err" class="error"></span>
                                </div>
                            </div>
                            <div class="row collapse">
                                <div class="small-12 columns">
                                    <input type="text" id="email" placeholder="email" name="email" maxlength="120">
                                    <span id="email_id_err" class="error"></span>
                                </div>
                            </div>
                            <div class="row collapse">
                                <div class="small-12 columns ">
                                    <input type="password" id="password" placeholder="password" name="password" maxlength="20">
                                    <span id="password_id_err" class="error"></span>
                                </div>
                            </div>
                            <div class="row collapse">
                                <div class="small-12 columns ">
                                    <input type="password" id="confirm_password" placeholder="confirm password" name="confirm_password" maxlength="20">
                                </div>
                            </div>
                            <div class="row collapse">
                                <div class="small-12 columns ">
                                    <button class="button" onsubmit="validateForm();" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>

                        <p>Already have an account? <a href="#">Login here &#187;</a></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- ====================================== LOG IN FORM ================================ -->
        <div class="small-12 medium-6 columns">
            <h1>Login</h1>
            <div class="row">
                <div class="large-10 columns">
                    <hr>
                    <div class="signup-panel">
                        <p class="welcome"> Please enter login details below.</p>
                        <form id="login_form" action="php_scripts/verify.php" method="post">
                            <div class="row collapse">
                                <div class="small-12 columns">
                                    <input type="text" id="email_login" placeholder="email" name="email_login" required>
                                    <span id="email_login_err" class="error"></span>
                                </div>
                            </div>
                            <div class="row collapse">
                                <div class="small-12 columns ">
                                    <input type="password" id="password_login" placeholder="password" name="password_login" required>
                                    <span id="password_login_err" class="error"></span>
                                </div>
                            </div>
                            <div class="row collapse">
                                <div class="small-12 columns ">
                                    <button class="button" type="submit">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        } else {
        ?>
        <div class="small-12 small-centered columns">
            <h1 class="signed-in">Smart Tools</h1>
            <h4 class="signed-in">Currently logged in as <?php echo $_SESSION['firstName'] . " " . $_SESSION['lastName'] ?> </h4>
            <p class="signed-in">Please <a href="php_scripts/logout.php">sign out</a> to register or login as a different user</p>
        </div>
        <?php 
        }
        ?>
    </div>
</section>
    
<?php
require_once 'include/footer.php';
?>
    
