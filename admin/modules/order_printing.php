<?php 
	$sqlOrder = "SELECT * FROM orders WHERE order_id =".$_GET["id"];
	$resultOrder = mysqli_query($conn,$sqlOrder);
	$rowOrder = mysqli_fetch_assoc($resultOrder);

    if(isset($_POST["order_status"]) && isset($_POST["edit"])){
        $status = $_POST["order_status"];
        $sqlStatus = "UPDATE orders SET order_status = '$status' WHERE order_id = ".$_GET["id"];
        $resultStatus = mysqli_query($conn, $sqlStatus);
        header("location: index.php?page=list_order");
    }
?>
<div class="col-md-12 col-sm-12  ">
    <div class="x_panel">
        <div class="x_title">
        <h2>Chi tiết đơn hàng - MDH : <?php echo $rowOrder["order_id"]; ?> </h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <h4 style="float: right;">Tổng tiền : <?php echo number_format($rowOrder["order_total"], 0, ",", "."); ?><sup>đ</sup></h4>
        <div style="clear: both;"></div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Tên Sản Phẩm</th>
                <th>Ảnh </th>
                <th>Số lượng </th>   
                <th>Giá Tiền</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $sqlOD = "SELECT orders.order_total, orders.order_status, order_detail.*, product.pro_name, product.pro_image
                FROM orders
                INNER JOIN order_detail ON orders.order_id=order_detail.order_id
                INNER JOIN product ON product.pro_id=order_detail.pro_id
                WHERE orders.order_id=". $_GET['id'];
                $resultOD = mysqli_query($conn,$sqlOD);
                if(mysqli_num_rows($resultOD) > 0) {
                    $i = 0;
                    while($rowOD = mysqli_fetch_assoc($resultOD)) {
                        $i++;
            ?>
            <tr>
                <th scope="row"><?php echo $i; ?></th>
                <td><?php echo $rowOD["pro_name"]; ?></td>
                <td><img src="../<?php echo $rowOD["pro_image"]; ?>" alt="" width="80"></td>
                <td><?php echo $rowOD["o_quantity"]; ?></td>
                <td><?php echo $rowOD["o_price"]; ?></td>
            </tr>
            <?php } } ?>
            
            </div>
            </tbody>
        </table>
        <h2>Cập nhật trạng thái đơn hàng</h2>
        <form method="post">
            <div class="radio">
                <label>
                    <input class="radio_order" type="radio" value="1" <?php echo ($rowOrder["order_status"]==1)?"checked":"" ?> id="optionsRadios1" name="order_status"> Chưa xử lý
                </label>
            </div>
            <div class="radio">
                <label>
                    <input class="radio_order" type="radio" value="2" <?php echo ($rowOrder["order_status"]==2)?"checked":"" ?> id="optionsRadios1" name="order_status"> Đang xử lý
                </label>
            </div>
            <div class="radio">
                <label>
                    <input class="radio_order" type="radio" value="3" <?php echo ($rowOrder["order_status"]==3)?"checked":"" ?> id="optionsRadios1" name="order_status"> Đã xử lý
                </label>
            </div>
            <div class="radio">
                <label>
                    <input class="radio_order" type="radio" value="4" <?php echo ($rowOrder["order_status"]==4)?"checked":"" ?> id="optionsRadios1" name="order_status"> Đã hủy
                </label>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success" name= "edit" >Cập nhật</button>
            </div>
        </form>
    </div>
</div>


        