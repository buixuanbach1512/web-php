
<?php
    $sqlIn = "Select * from shop_info";
    $resultIn = mysqli_query($conn,$sqlIn);
    $rowIn = mysqli_fetch_assoc($resultIn);
?>

<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
        <a href="./" class="site_title"><i class="fa fa-github"></i> <span><?php echo $rowIn["in_name"]; ?></span></a>
    </div>

    <div class="clearfix"></div>

    <br>

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section active">
        <ul class="nav side-menu">
            <li class=""><a><i class="fa fa-dashboard"></i> Thống kê <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="display: none;">
                <li class="current-page"><a href="index.php?page=statistic">Thống kê chung</a></li>
            </ul>
            </li>
            <li><a href="index.php?page=category"><i class="fa fa-bars"></i> Quản lý danh mục</a>
            </li>
            <li><a><i class="fa fa-archive"></i> Quản lý sản phẩm <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="index.php?page=addproduct">Thêm sản phẩm</a></li>
                <li><a href="index.php?page=list_product">Thống kê sản phẩm</a></li>
            </ul>
            </li>
            <li><a href="index.php?page=list_customer"><i class="fa fa-table"></i> Thông tin khách hàng</a>
            </li>
            <li><a href="index.php?page=list_admin"><i class="fa fa-user"></i> Quản lý nhân viên</a>
            </li>
            <li><a href="index.php?page=list_order"><i class="fa fa-calendar-o"></i> Quản lý đơn hàng</a>
            </li>
            <li><a><i class="fa fa-download"></i>Quản lý nhập kho <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="index.php?page=add_pro_ware">Thêm mới nhập kho</a></li>
                <li><a href="index.php?page=list_pro_ware">Danh sách nhập kho</a></li>
            </ul>
            </li>
            <li><a><i class="fa fa-upload"></i> Quản lý xuất kho <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="index.php?page=add_pro_export">Thêm mới xuất kho</a></li>
                <li><a href="index.php?page=list_pro_ex">Danh sách xuất kho</a></li>
            </ul>
            </li>
            <li><a><i class="fa fa-windows"></i> Quản lý website <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="index.php?page=banner">Quản lý ảnh bìa</a></li>
            </ul>
            </li>
        </ul>
        </div>
    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
        <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Settings">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="" data-original-title="FullScreen">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Lock">
        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="" href="index.php?page=logout" data-original-title="Đăng xuất">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
        </a>
    </div>
    <!-- /menu footer buttons -->
    </div>
</div>