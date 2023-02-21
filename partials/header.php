<?php
    require "connection.php";
    session_start();
    date_default_timezone_set('Asia/Ho_Chi_Minh');

    $sqlIn = "Select * from shop_info";
    $resultIn = mysqli_query($conn,$sqlIn);
    $rowIn = mysqli_fetch_assoc($resultIn);
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> TB - Shop </title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="assets/frontend/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="assets/frontend/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="assets/frontend/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="assets/frontend/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="assets/frontend/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="assets/frontend/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="assets/frontend/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="assets/frontend/css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="./"><h3><?php echo $rowIn["in_name"]; ?></h3></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="./shoping-cart.php"><i class="fa fa-shopping-bag"></i></a></li>
                <li>
                    <?php
                        if(isset($_SESSION["loginHome"])){
                    ?>
                    <a style="color: black;" href="logout.php">Đăng Xuất</a>
                    <?php
                        } 
                    ?>
                </li>
            </ul>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__auth">
                <?php 
                    if(isset($_SESSION["loginHome"])){
                ?>
                    <a href="user.php?id=<?php echo $_SESSION["loginHome"][0]; ?>"><i class="fa fa-user"></i><?php echo $_SESSION["loginHome"][1];?></a>
                <?php
                    }else{
                ?>
                    <a href="login.php"><i class="fa fa-user"></i> Đăng nhập</a>
                <?php
                    }
                ?>    
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="./">Home</a></li>
                <li><a href="#">Danh mục</a>
                    <ul class="header__menu__dropdown">
                    <?php 
                        $sqlCat = "Select * from category where cat_status = 1";
                        $resultCat = mysqli_query($conn,$sqlCat);
                        if(mysqli_num_rows($resultCat) > 0){
                            while($rowCat = mysqli_fetch_assoc($resultCat)){
                    ?>
                        <li><a href="shop-grid.php?id=<?php echo $rowCat["cat_id"]; ?>"><?php echo $rowCat["cat_name"]; ?></a></li>
                    <?php }} ?>
                    </ul>
                </li>
                <li><a href="./contact.php">Liên hệ</a></li>
                <li><a href="./shoping-cart.php">Giỏ hàng</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="header__top__right">
                            <div class="header__top__right__auth">
                                <?php 
                                    if(isset($_SESSION["loginHome"])){
                                ?>
                                    <a href="user.php?id=<?php echo $_SESSION["loginHome"][0]; ?>"><i class="fa fa-user"></i><?php echo $_SESSION["loginHome"][1];?></a>
                                <?php
                                    }else{
                                ?>
                                    <a href="login.php"><i class="fa fa-user"></i> Đăng nhập</a>
                                <?php
                                    }
                                ?>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="./"><h3><?php echo $rowIn["in_name"]; ?></h3></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                    <ul>
                        <li class="active"><a href="./">Home</a></li>
                        <li><a href="#">Danh mục</a>
                            <ul class="header__menu__dropdown">
                            <?php 
                                $sqlCat = "Select * from category where cat_status = 1";
                                $resultCat = mysqli_query($conn,$sqlCat);
                                if(mysqli_num_rows($resultCat) > 0){
                                    while($rowCat = mysqli_fetch_assoc($resultCat)){
                            ?>
                                <li><a href="shop-grid.php?id=<?php echo $rowCat["cat_id"]; ?>"><?php echo $rowCat["cat_name"]; ?></a></li>
                            <?php }} ?>
                            </ul>
                        </li>
                        <li><a href="./contact.php">Liên hệ</a></li>
                        <li><a href="./shoping-cart.php">Giỏ hàng</a></li>
                    </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href="./shoping-cart.php"><i class="fa fa-shopping-bag"></i></a></li>
                            <li>
                                <?php
                                    if(isset($_SESSION["loginHome"])){
                                ?>
                                <a style="color: black;" href="logout.php">Đăng Xuất</a>
                                <?php
                                    } 
                                ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Danh mục</span>
                        </div>
                        <ul>
                            <?php
                                $sql = "Select * from category where cat_status = 1";
                                
                                $result = mysqli_query($conn,$sql);
                                if(mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_assoc($result)){
                            ?>
                                <li><a href="shop-grid.php?id=<?php echo $row['cat_id']; ?>"><?php  echo $row["cat_name"]; ?></a></li>
                            <?php
                                    } 
                                }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="shop-search.php" method="get">
                                <input type="text" placeholder="Tìm kiếm" name="keyword">
                                <button type="submit" class="site-btn" name="search" value="Tìm Kiếm">Tìm Kiếm</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+84 - <?php echo $rowIn["in_phone"]; ?></h5>
                                <span>Làm việc 24/7 </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->