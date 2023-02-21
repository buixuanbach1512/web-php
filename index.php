<?php include("partials/header-home.php"); ?>
<div class="main">
    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    <?php
                        $sql = "Select * from category where cat_status = 1";
                        $result = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="<?php echo $row["cat_image"]; ?>">
                            <h5><a href="shop-grid.php?id=<?php echo $row["cat_id"]; ?>"><?php echo $row["cat_name"]; ?></a></h5>
                        </div>
                    </div>
                    <?php
                            } 
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div style="padding:50px"></div>
                    <div class="section-title related__product__title">
                        <h2>Sản Phẩm Hot</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                    $sql = "SELECT * FROM product ORDER BY pro_view DESC limit 8";
                    $result = mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_assoc($result)){
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="<?php echo $row["pro_image"]; ?>">
                            <ul class="product__item__pic__hover">
                                <!-- <li><a href="#"><i class="fa fa-retweet"></i></a></li> -->
                                <li><a href="shop-details.php?id=<?php echo $row['pro_id']; ?>"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a class="product_name" href="shop-details.php?id=<?php echo $row['pro_id']; ?>"><?php echo $row["pro_name"]; ?></a></h6>
                            <h5><?php echo number_format($row["pro_price"],0,",","."); ?><sup>đ</sup></h5>
                        </div>
                    </div>
                </div>
                <?php 
                        }
                    }
                ?>
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <?php 
                    $sqlBanner = "Select * from banners where ban_status = 1";
                    $resultBanner = mysqli_query($conn,$sqlBanner);
                    if(mysqli_num_rows($resultBanner) > 0){
                        while($rowBanner = mysqli_fetch_assoc($resultBanner)){
                ?>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="<?php echo $rowBanner["ban_image"]; ?>" alt="">
                    </div>
                </div>
                <?php 
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</div>
    <?php include("partials/footer.php"); ?>

   