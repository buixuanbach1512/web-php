 <!-- Footer Section Begin -->
 <footer class="footer spad">
        <div class="container">
            <div class="row">
            <?php 
                $sqlInfo = "Select * from shop_info";
                $resultInfo = mysqli_query($conn,$sqlInfo);
                $rowInfo = mysqli_fetch_assoc($resultInfo);
            ?>
                <div class="col-lg-5 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./"><h3><?php echo $rowInfo["in_name"]; ?></h3></a>
                        </div>
                        <ul>
                            <li>Địa chỉ: <?php echo $rowInfo["in_address"]; ?></li>
                            <li>Điện thoại: <?php echo $rowInfo["in_phone"]; ?></li>
                            <li>Email: <?php echo $rowInfo["in_email"]; ?></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Liên kết hữu ích</h6>
                        <ul>
                            <li><a href="contact.php">Liên hệ</a></li>
                            <li><a href="./shoping-cart.php">Giỏ hàng</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__payment"><img src="assets/frontend/img/payment-item.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="assets/frontend/js/jquery-3.3.1.min.js"></script>
    <script src="assets/frontend/js/bootstrap.min.js"></script>
    <script src="assets/frontend/js/jquery.nice-select.min.js"></script>
    <script src="assets/frontend/js/jquery-ui.min.js"></script>
    <script src="assets/frontend/js/jquery.slicknav.js"></script>
    <script src="assets/frontend/js/mixitup.min.js"></script>
    <script src="assets/frontend/js/owl.carousel.min.js"></script>
    <script src="assets/frontend/js/main.js"></script>



</body>

</html>