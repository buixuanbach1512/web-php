<?php 
    $sqlChart = "SELECT category.*, COUNT(product.cat_id) AS number_cate FROM product 
    INNER JOIN category ON product.cat_id = category.cat_id GROUP BY product.cat_id ";

    $resultChart = mysqli_query($conn,$sqlChart);
    $data = [];
    while($rowChart = mysqli_fetch_array($resultChart)){
        $data[] = $rowChart; 
    }

?>
<style>
    .pro_name {
        display: block;
        display: -webkit-box;
        -webkit-line-clamp: 1;  /* số dòng hiển thị */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

</style>

<div class=" col-md-12 tile_count">
    <div class="col-md-3 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Số lượng khách hàng</span>
        <?php 
            $sqlCus = "SELECT COUNT(*) AS sl_cus FROM customer";
            $resultCus = mysqli_query($conn,$sqlCus);
            $rowCus = mysqli_fetch_assoc($resultCus);
        ?>
        <div class="count"><?php echo $rowCus["sl_cus"]; ?></div>
    </div>
    <div class="col-md-3  tile_stats_count">
        <?php 
            $sqlOrder = "SELECT COUNT(*) AS sl_order FROM orders";
            $resultOrder = mysqli_query($conn,$sqlOrder);
            $rowOrder = mysqli_fetch_assoc($resultOrder);
        ?>
        <span class="count_top"><i class="fa fa-shopping-cart"></i> Số lượng đơn hàng</span>
        <div class="count"><?php echo $rowOrder["sl_order"]; ?></div>
    </div>
    <div class="col-md-3  tile_stats_count">
        <?php 
            $sqlCus = "SELECT COUNT(*) AS sl_admin FROM admin";
            $resultCus = mysqli_query($conn,$sqlCus);
            $rowCus = mysqli_fetch_assoc($resultCus);
        ?>
        <span class="count_top"><i class="fa fa-user"></i> Số lượng nhân viên</span>
        <div class="count"><?php echo $rowCus["sl_admin"]; ?></div>
    </div>
    <div class="col-md-3  tile_stats_count">
        <?php 
            $sqlTotalOrder = "SELECT SUM(order_total) AS total_order FROM orders WHERE order_status = 3";
            $resultTotalOrder = mysqli_query($conn,$sqlTotalOrder);
            $rowTotalOrder = mysqli_fetch_assoc($resultTotalOrder);
        ?>
        <span class="count_top"><i class="fa fa-usd"></i> Doanh thu của shop</span>
        <div class="count"><?php echo number_format($rowTotalOrder["total_order"], 0, ",", "."); ?><sup>đ</sup></div>
    </div> 
</div>
<div class="col-md-8 col-sm-8 ">
    <div class="x_panel tile fixed_height_320 overflow_hidden">
        <div class="x_title">
            <h2>Thống kê sản phẩm</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <!-- <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Settings 1</a>
                        <a class="dropdown-item" href="#">Settings 2</a>
                    </div>
                </li> -->
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div id="piechart_3d" ></div>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="x_panel fixed_height_320 overflow_hidden">
    <div class="x_title">
        <h2>Sản phẩm xem nhiều</h2>
        <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a>
        </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <ul class="list-unstyled msg_list">
        <?php
            $sqlPro = "SELECT * FROM product ORDER BY pro_view DESC limit 5";
            $resultPro = mysqli_query($conn,$sqlPro);
            while($rowPro = mysqli_fetch_assoc($resultPro)){
        ?>
            <li>
                <a>
                <span class="image">
                    <img src="../<?php echo $rowPro["pro_image"]; ?>" alt="img">
                </span>
                <span>
                    <span class="pro_name"><?php echo $rowPro["pro_name"]; ?></span>
                    <span class="time">Lượt xem: <?php echo $rowPro["pro_view"]; ?></span>
                </span>
                </a>
            </li>
        <?php
            }
        ?>
        </ul>
    </div>
    </div>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['cat_name', 'number_cate'],
        <?php
        foreach($data as $key){
            echo "['".$key["cat_name"]."', ".$key["number_cate"]."],";
        }
        ?>
    ]);

    var options = {
        title: 'Thống kê các loại sản phẩm trong shop',
        is3D: true,
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
    chart.draw(data, options);
    }
</script>
