                <!-- FOOTER SECTION -->
                <footer>
                    <div class="wrap row small-up-1 medium-up-3">
                        <div class="columns foot">
                            <h4>Contact Info</h4>
                            <hr>
                            <a href="#"><span>Phone</span> 1800 555 555</a>
                            <a href="#"><span>Email</span> info@smarttools.com</a>
                            <a href="#"><span>Address</span> 123 Center Street</a>
                        </div>
                        <div class="columns foot">
                            <h4>Site Map</h4>
                            <hr>
                            <a href="../index.php">Home</a>
                            <a href="../products.php">Products</a>
                            <?php if(!isset($_SESSION['customerID'])): ?>
                            <a href="../index.php">Register / Login</a>
                            <?php else: ?>
                            <a href="../php_scripts/logout.php">Logout</a>
                            <?php endif ?>
                        </div>
                        <div class="columns foot">
                            <h4>Social Media</h4>
                            <hr>
                            <a href="#">Facebook</a>
                            <a href="#">Twitter</a>
                            <a href="#">Instagram</a>
                        </div>
                    </div>
                </footer>
                <!-- off-canvas-content -->
        </div>
        <!-- off-canvas wrapper-inner -->
    </div>
    <!-- off-canvas-wrapper -->
</div>
<script src="js/vendor/jquery.js"></script>
<script src="js/jquery.alphanum.js"></script>
<script src="js/vendor/what-input.js"></script>
<script src="js/vendor/foundation.js"></script>
<script src="js/app.js"></script>

</body>

</html>

<?php
include "include/form_validate.php"; 
?>

    