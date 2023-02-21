<?php
    //Kiểm tra id trên url trường hợp xóa
    if(isset($_GET["id"]) && isset($_GET["del"])){
        $sqlDelete = "DELETE FROM orders WHERE order_id=".$_GET["id"];
        mysqli_query($conn,$sqlDelete) or die("Lỗi xóa bản ghi!!");
        header("location:index.php?page=list_order");
    }

?>  
<div class="col-md-12 col-sm-12">
    <div class="x_panel">
        <div class="x_title">
        <h2>Quản lí đơn hàng</h2>
        <div class="clearfix"></div>
        </div>
    </div>
    <div class="x_content">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên người nhận</th>
                    <th>Địa chỉ</th>
                    <th>SĐT</th>
                    <th>Trạng thái đơn hàng</th>
                    <th>Ngày tạo</th>
                    <th>Xóa</th>
                    <th>Xem chi tiết</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    //Câu lệnh Select
                    $sqlSelect = "SELECT * FROM orders";
                    //Thực thi câu lệnh
                    $result = mysqli_query($conn, $sqlSelect) or die("Lỗi truy vấn select!!");
                    if(mysqli_num_rows($result) > 0) {
                        $i = 0;
                        while($row = mysqli_fetch_assoc($result)) {
                            $i++;
                ?>
                <tr>
                    <td><?php echo $row["order_id"]; ?></td>
                    <td><?php echo $row["order_name"]; ?></td>
                    <td><?php echo $row["order_address"]; ?></td>
                    <td><?php echo $row["order_phone"]; ?></td>
                    <td>
                        <?php
                            if($row["order_status"]==1){
                                echo "Chưa xử lý";
                            }elseif($row["order_status"]==2){
                                echo "Đang xử lý";
                            }elseif($row["order_status"]==3){
                                echo "Đã xử lý";
                            }elseif($row["order_status"]==4){
                                echo "Đã hủy";
                            }
                        ?>
                    </td>
                    <td><?php echo date("d-m-Y H:i:s",strtotime($row["date_created"]));?></td>
                    <td>
                    <a href="index.php?page=list_order&id=<?php echo $row["order_id"]; ?>&del=1" onclick="return confirm('Bạn có chắc muốn xóa đơn hàng này?')"><i class="fa fa-trash-o"></i> Xóa</a>
                    </td>
                    <td>
                    <a href="index.php?page=order_printing&id=<?php echo $row["order_id"]; ?>">
                        <i class="fa fa-list"></i> Xem đơn hàng</a>
                    </td>
                </tr>
                <?php } } ?>
            </tbody>
        </table>
    </div>
</div> 