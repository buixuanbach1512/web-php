<?php include "partials/header.php"; ?>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="./assets/frontend/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Hồ sơ cá nhân</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="category-oder">
    <h3>Đơn hàng đã đặt</h3>
    <div style="margin-bottom: 30px;"></div>
    <form method="post">
        <table class="fl-table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã đơn hàng</th>
                    <th>Hóa đơn</th>
                    <th>Ngày đặt</th>
                    <th>Tình trạng</th>
                    <th>Hủy</th>
                </tr>
            </thead>
            <tbody>
                    <?php
                        $num = 0;
                        $sqlOrder = "SELECT * FROM orders WHERE cus_id=".$_GET["id"];
                        $resultOrder = mysqli_query($conn,$sqlOrder);
                        while($rowOrder = mysqli_fetch_assoc($resultOrder)){
                            $num++;
                    ?>
                    <tr>
                        <td><?php echo $num; ?></td>
                        <td><?php echo $rowOrder["order_id"]; ?></td>
                        <td><?php echo number_format($rowOrder["order_total"], 0, ",", "."); ?><sup>đ</sup></td>
                        <td><?php echo $rowOrder["date_created"]; ?></td>
                        <td>
                        <?php
                            if($rowOrder["order_status"]==1){
                                echo "Chưa xử lý";
                            }elseif($rowOrder["order_status"]==2){
                                echo "Đang xử lý";
                            }elseif($rowOrder["order_status"]==3){
                                echo "Đã xử lý";
                            }elseif($rowOrder["order_status"]==4){
                                echo "Đã hủy";
                            }
                        ?>
                        </td>
                        <td>
                            <?php 
                                if(isset($_GET["o_id"])&&isset($_GET["cancel"])){
                                    $sqlUpdate = "UPDATE orders SET order_status = 4 WHERE order_id = ".$_GET["o_id"];
                                    mysqli_query($conn,$sqlUpdate) or die("Error");
                                }
                            ?>
                            <a href="user.php?id=<?php echo $_SESSION["loginHome"][0]; ?>&o_id=<?php echo $rowOrder["order_id"]; ?>&cancel=1">Hủy</a>
                        </td>               
                    <?php
                        }
                    ?>
            </tbody>
        </table>
    </form>
</div>
<?php include "partials/footer.php"; ?>