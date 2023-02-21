<?php include("./partials/header.php"); ?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="./assets/frontend/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>TB Shop</h2>
                        <div class="breadcrumb__option">
                            <?php
                                if(isset($_GET['id'])){
                                    $id = $_GET['id'];
                                    $sql = "Select product.*, category.cat_name from product inner join category on product.cat_id = category.cat_id where pro_id = $id ";
                                    $result = mysqli_query($conn,$sql);
                                    if(mysqli_num_rows($result)>0){
                                        $row = mysqli_fetch_assoc($result);
                            ?>
                                <a href="./index.php">Home</a>
                                <a href="./shop-grid.php?id=<?php echo $row['cat_id']; ?>"><?php echo $row['cat_name']; ?></a>
                                <span><?php echo $row['pro_name']; ?></span>
                            <?php
                                    }
                                }
                            ?> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <?php
                    if(isset($_GET['id'])){
                        $id = $_GET['id'];
                        // Cập nhật lượt xem sản phẩm
                        $sqlView = "UPDATE product SET pro_view = pro_view+1 WHERE pro_id=".$id;
                        $resultView = mysqli_query($conn,$sqlView);

                        $sqlPro = "SELECT  product.*, COUNT(comments.com_id) AS slcom FROM product INNER JOIN comments ON product.pro_id = comments.pro_id WHERE product.pro_id = $id";
                        $resultPro = mysqli_query($conn,$sqlPro);
                        $rowPro = mysqli_fetch_assoc($resultPro);
                ?>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="<?php echo $rowPro["pro_image"]; ?>" alt="">
                        </div>
                        <!-- <div class="product__details__pic__slider owl-carousel">
                            <img data-imgbigurl="img/product/details/product-details-2.jpg"
                                src="img/product/details/thumb-1.jpg" alt="">
                            <img data-imgbigurl="img/product/details/product-details-3.jpg"
                                src="img/product/details/thumb-2.jpg" alt="">
                            <img data-imgbigurl="img/product/details/product-details-5.jpg"
                                src="img/product/details/thumb-3.jpg" alt="">
                            <img data-imgbigurl="img/product/details/product-details-4.jpg"
                                src="img/product/details/thumb-4.jpg" alt="">
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <div class="product__details__name"><?php echo $rowPro["pro_name"];?></div>
                        <div class="product__details__price"><?php echo number_format($rowPro["pro_price"],0,",","."); ?><sup>đ</sup></div>
                        <?php if($rowPro["pro_quantity"]>0){ ?>
                            <form action="shoping-cart.php?action=add" method="post">
                                <div class="product__details__quantity">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="1" name="quantity[<?php echo $row["pro_id"];?>]">
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" class="primary-btn btn-addToCart" value="Thêm vào giỏ hàng"  />
                            </form>
                        <?php } ?>
                        <ul>
                            <li><b>Size : </b> <span><?php echo $rowPro["pro_size"]; ?></span></li>
                            <li><b>Chất liệu : </b> <span><?php echo $rowPro["pro_material"]; ?></span></li>
                            <?php if($rowPro["pro_quantity"]==0){ ?>
                                <li><b>Số lượng : </b> <span> Hết hàng </span></li>
                            <?php }else{ ?>
                                <li><b>Số lượng : </b> <span><?php echo $rowPro["pro_quantity"]; ?></span></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Mô tả sản phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Nhận xét sản phẩm <span>(<?php echo $rowPro["slcom"];  ?>)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Mô tả sản phẩm</h6>
                                    <p><?php echo $rowPro["pro_desc"]; ?></p>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <?php 
                                        $item_page = 4;
                                        $current_page = !empty($_GET["page"])?$_GET["page"]:1;
                                        $offset = ($current_page - 1 ) * $item_page;
                                        $sqlReview = "Select comments.*, customer.cus_name from comments inner join customer on comments.cus_id = customer.cus_id where pro_id = $id ORDER BY com_id ASC LIMIT ".$item_page."  OFFSET ".$offset;
                                        $resultReview = mysqli_query($conn,$sqlReview);
                                        $totalRecords = mysqli_query($conn,"Select * from comments where pro_id = $id");
                                        $totalRecords = $totalRecords->num_rows;
                                        $totalPage = ceil($totalRecords / $item_page);
                                        if(mysqli_num_rows($resultReview)){
                                            while($rowReview = mysqli_fetch_assoc($resultReview)){
                                    ?>
                                    <ul class="comm_list" style="list-style:none;">
                                        <li class="comm_name">
                                            <h5><?php echo $rowReview['cus_name']; ?></h5>
                                        </li>
                                        <li class="comm_time"><p class="fs-6" style="font-size: 10px;"><?php echo $rowReview['date_created']; ?></p></li>
                                        <li class="comm_content">
                                            <p><?php echo $rowReview['com_content']; ?></p>
                                        </li>
                                    </ul>
                                    <hr style="width: 90%" />
                                    <?php
                                            }
                                    ?>
                                    <div class="product__pagination">
                                        <?php for($i=1;$i<=$totalPage;$i++) { ?>
                                        <a href="shop-details.php?id=<?php echo $id; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php 
                        if(isset($_POST['submit'])){
                            $comment = $_POST['comment'];   
                            $date_create = date("Y-m-d H:i:s");
                            if(isset($_SESSION['loginHome'])){
                                $cus_id = $_SESSION['loginHome'][0];
                                if($comment != ""){
                                    $sqlComment = "Insert into comments(cus_id,pro_id,com_content,date_created) values('$cus_id','$id','$comment','$date_create')"; 
                                    $resultComment = mysqli_query($conn,$sqlComment);
                                    echo "<script> window.location.href='shop-details.php?id=$id';</script>";
                                }
                            }else {
                                echo '<script>alert("Bạn cần đăng nhập để bình luận sản phẩm này !!!")</script>';
                            }
                        }
                ?>
                <div class="col-lg-12 form-comment">
                    <h3 class="title-comment">Bình luận sản phẩm</h3>
                    <form id="comment" action="shop-details.php?id=<?php echo $id; ?>" method="post">
                        <div class="form-group">
                            <textarea class="form-control col-lg-6" name="comment" require=""></textarea>
                        </div>
                        <button type="submit" name="submit" style="background-color: pink; color: #fff" class="btn btn-default">Bình luận</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Sản phẩm liên quan</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                    $cat_id = $row["cat_id"];
                    $sqlOther = "Select * from product where cat_id = $cat_id order by RAND() limit 4";
                    $resultOther = mysqli_query($conn,$sqlOther);
                    while($rowOther = mysqli_fetch_assoc($resultOther)){
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="<?php echo $rowOther["pro_image"]; ?>">
                            <ul class="product__item__pic__hover">
                                <li><a href="shop-details.php?id=<?php echo $rowOther['pro_id']; ?>"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6 class="product_name"><a href="shop-details.php?id=<?php echo $rowOther["pro_id"];  ?>"><?php echo $rowOther["pro_name"]; ?></a></h6>
                            <h5><?php echo number_format($rowOther["pro_price"],0,",","."); ?><sup>đ</sup></h5>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->
<?php include("./partials/footer.php"); ?>