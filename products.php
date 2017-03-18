<?php
require_once 'include/header.php';
?>

<!-- MAIN CONTENT SECTION -->
<?php
try {
$sql  = "SELECT * FROM products WHERE 1 ORDER BY product_name";
$stmt = $DB->prepare($sql);
$stmt->execute();
//$total_count = count($stmt->fetchAll());
$results = $stmt->fetchAll();
}
catch (Exception $ex) {
    echo $ex->getMessage();
}
?>

<section class="main">
    <div class="row">
        <div class="large-10 large-offset-1 columns">

        <?php

        if(isset($_COOKIE['loginTime'])) {  ?>
             <div class="text-center" id="timer">
                 <span>You have been logged in for: </span><br/><span id='loginClock'></span>
             </div>     
        <?php    
        }
        ?>

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
        <div class="small-12 medium-10 medium-centered column products">

            <h2>Products</h2> 
            <hr/>

            <?php if (count($results) > 0) { ?>

            <div class="row">
             <?php foreach ($results as $res) { ?>
              <div class="small-12 medium-6 large-3 columns text-center">

                    <form method="post" class="item_form" action="php_scripts/update_cart.php?id=<?php echo $res["productID"]; ?>">
                    <!-- PRODUCT IMAGE -->
                    <?php $pic = $res["imagePath"];?>
                    <a href="img/<?php echo $pic ?>" target="_blank"><img src="img/<?php echo $pic ?>" alt="" /></a>

                    <!-- PRODUCT NAME -->
                    <p><?php echo $res["product_name"]; ?></p>

                    <!-- PRICE -->
                    <p><?php echo "$" . number_format((float)$res["price"],2); ?></p>

                    <!-- QUANTITY -->
                    <div class="small-8 small-offset-2 columns">
                    <input type="text" class="text-align" name="quantity" value="1" maxlength="1" />
                    </div>

                    <!-- ADD TO CART --> 
                    <button class="button" type="submit">Add to cart</button>

                    </form>
              </div>
            <?php }
            } ?>
            </div>
        </div>
        <div class="small-12 medium-10 medium-centered column" style="margin-top: 100px">

        <!--<h3><?php //if(isset($_SESSION['firstName'])) echo $_SESSION['firstName'] . " " . $_SESSION['lastName'] . "'s"?> Shopping Cart</h3>-->
        <h3><?php if(isset($_SESSION['customerID'])) echo $_SESSION['firstName'] . " " . $_SESSION['lastName'] . "'s"?> Shopping Cart</h3>
        <hr/>


        <?php
        // ============== QUERY DATABASE FOR PRODUCTS IN CART ==============
        $cid = ($_SESSION['customerID']);
        $sql  = "SELECT * FROM products JOIN cart ON products.productID = cart.productID WHERE cart.customerID = :cid";
        $stmt = $DB->prepare($sql);
        $stmt->bindValue(":cid", $cid); 
        $stmt->execute();
        $results = $stmt->fetchAll();  
        ?>

        <table class="hover scroll">
          <thead>
            <tr>
              <th style="width: 400px">Product Name</th>
              <th style="width: 150px">Quantity</th>
              <th style="width: 150px">Price Details</th>
              <th style="width: 200px">Order Total</th>
              <th style="width: 300px">Action</th>
            </tr>
          </thead>

        <?php if (count($results) > 0) {         
                $total = 0;                     //counter variable for total price

                foreach ($results as $res) { 
                $quantPrice = ($res['quantity'] * $res["price"]);             // Total item price
                $total = $total + $quantPrice;                              // Total cart price
        ?>

          <tbody>
            <tr>
              <form method="post" action="php_scripts/update_quantity.php">
              <td> <?php echo $res["product_name"]; ?></td>
              <td><input type="text" name="cart_quantity" value="<?php echo $res["quantity"]; ?>" maxlength="1" style="margin: 0" />
                  <input type="hidden" id="cartID" name="cartID" value="<?php echo $res["cartID"]?>" />
              </td>
              <td><?php echo "$" . number_format((float)$res["price"],2); ?></td>
              <td><?php echo "$" . number_format((float)$quantPrice, 2); ?></td>
              <td>
                  <button class="button" type="submit" style="margin: 0">Update</button>
            </form>
            <a href="php_scripts/delete_cart.php?pid=<?php echo $res["productID"]; ?>">
                        <button class="button alert" onclick="return confirm('Are you sure you want to remove item from cart?')" style="margin: 0">
                            <span>Remove</span>
                        </button>
                    </a>&nbsp;

              </td>
            </tr>
            <?php 
                } 
            }
          ?>
          <tr>
              <td><strong>Total</strong></td>
              <td></td>
              <td></td>
              <td><strong><?php echo "$" . number_format((float)$total, 2); ?></strong></td>
              <td></td>
          </tr>
          </tbody>
        </table>
        </div>
    </div>
</section>
     
<?php if(isset($_SESSION['customerID'])) { ?>
<script>

// run function every second
var counter = setInterval(function(){ myTimer() }, 1000);

function myTimer() {
    //var loginTime = getCookie("loginTime");
    var cookie    = document.cookie;
    var cookieArr = cookie.split(";");
    var cookieObj = {};

    for (var i = 0; i < cookieArr.length; i++){

    // Trim
    var cookieKV = cookieArr[i]; 
    cookieKV = cookieKV.trim(); 

    // Split on "="
    var cookieKVArr = cookieKV.split("=");
    //cookieKVArr == ["key", "value"];

    // Store kv on obj
    cookieObj[cookieKVArr[0]] = cookieKVArr[1];    
    }

    // Get difference between login time and current time
    var loginTime = cookieObj['loginTime'];
    var currentTime = Math.round(new Date().getTime() / 1000);
    var difference = currentTime - loginTime;

    // Convert difference to D:Y:M:S
    var seconds = difference;
    var days = Math.floor(seconds / (60* 60* 24)); // DAYS
    seconds -= days * (60* 60* 24);
    var hours = Math.floor(seconds / (60 * 60)); //HOURS
    seconds -= hours * (60 * 60);
    var minutes = Math.floor(seconds / 60); // MINUTES
    seconds -= minutes * 60; // SECONDS

    // ADD "0" IF LESS THAN 10
    if (hours   < 10) {hours   = "0"+hours;} 
    if (minutes < 10) {minutes = "0"+minutes;} 
    if (seconds < 10) {seconds = "0"+seconds;} 

    // Display result
    document.getElementById("loginClock").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s";

}                               
</script>
                
<?php
}
require_once 'include/footer.php';
?>