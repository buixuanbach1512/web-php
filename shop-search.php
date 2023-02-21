<?php include("partials/header.php"); ?>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="./assets/frontend/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <?php
                            if(isset($_GET['keyword'])){
                                $keyword = $_GET['keyword'];
                        ?>
                        <h2><?php echo $keyword ; ?></h2>
                        <div class="breadcrumb__option">
                            <a href="./">Home</a>
                            <span><?php echo $keyword ; ?></span>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    
                    <div class="filter__item">
                        <div class="row">
                            <!-- <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sort By</span>
                                    <select>
                                        <option value="0">Default</option>
                                        <option value="0">Default</option>
                                    </select>
                                </div>
                            </div> -->
                            <div class="col-lg-12 col-md-12">
                                <div class="filter__found">
                                    <?php 
                                        $total = mysqli_query($conn,"Select * from product where pro_name like '%".$keyword."%'");
                                        $total = $total->num_rows;
                                    ?>
                                    <h6><span><?php echo $total; ?></span> Sản Phẩm</h6>
                                </div>
                            </div>
                            <!-- <div class="col-lg-4 col-md-3">
                                <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                    <span class="icon_ul"></span>
                                </div>
                            </div> -->
                        </div>
                    </div>          
                    <div class="row"> 
                        <?php
                            if(isset($_GET['keyword'])){
                                $keyword = $_GET['keyword'];
                                $item_page = 12;
                                $current_page = !empty($_GET["page"])?$_GET["page"]:1;
                                $offset = ($current_page - 1 ) * $item_page;
                                $sql = "SELECT * FROM product WHERE pro_name like '%".$keyword."%' ORDER BY pro_id ASC LIMIT ".$item_page."  OFFSET ".$offset;
                                $result = mysqli_query($conn,$sql);
                                $totalRecords = mysqli_query($conn,"Select * from product where pro_name like '%".$keyword."%' ");
                                $totalRecords = $totalRecords->num_rows;
                                $totalPage = ceil($totalRecords / $item_page);
                                if(mysqli_num_rows($result)>0){
                                    while($row = mysqli_fetch_assoc($result)){
                        ?> 
                        <div class="col-lg-3 col-md-4 col-sm-4">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="<?php echo $row["pro_image"]; ?>">
                                    <ul class="product__item__pic__hover">
                                        <!-- <li><a href="#"><i class="fa fa-heart"></i></a></li>-->
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li> 
                                        <li><a href="shop-details.php?id=<?php echo $row['pro_id']; ?>"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="shop-details.php?id=<?php echo $row['pro_id']; ?>"><?php echo $row["pro_name"]; ?></a></h6>
                                    <h5><?php echo number_format($row["pro_price"],0,",","."); ?><sup>đ</sup></h5>
                                </div>    
                            </div> 
                        </div>
                        <?php
                                    }
                                }
                        ?> 
                    </div>
                    <div class="product__pagination">
                        <?php for($i=1;$i<=$totalPage;$i++) { ?>
                        <a href="shop-grid.php?id=<?php echo $id; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        <?php
                            }
                        }
                        ?>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

<?php include("partials/footer.php"); ?>