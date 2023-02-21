<div class="col-md-12 col-sm-12  ">
<div class="x_panel">
    <div class="x_title">
    <!-- <h2>Danh sách sản phẩm</h2> -->
    <h2><a>Danh sách nhập kho</a></h2>
    <div class="clearfix"></div>
   
</div>
     
    <div class="x_content">
    <?php
        //Kiểm tra id trên url trường hợp xóa
        if(isset($_GET["id"]) && isset($_GET["del"])){
            $sqlDelete = "DELETE FROM product_warehouse WHERE pro_ware_id=".$_GET["id"];
            mysqli_query($conn,$sqlDelete) or die("Lỗi xóa bản ghi!!");
            header("location:index.php?page=list_pro_ware");
        }
    ?>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Mã đơn</th>
            <th>Nội dung</th>   
            <th>Nhân viên</th>
            <th>Ghi chú</th>
            <th>Trạng thái</th>
            <th>Ngày nhập</th>
            <th>Phiếu nhập</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $sqlSelectPro =" SELECT product_warehouse.*,`admin`.admin_name FROM product_warehouse INNER JOIN `admin` ON product_warehouse.admin_id=`admin`.admin_id";
            $resultSelectPro = mysqli_query($conn, $sqlSelectPro) or die("Lỗi truy vấn select!!");
            if(mysqli_num_rows($resultSelectPro) > 0) {
                while($row = mysqli_fetch_assoc($resultSelectPro)) {
        ?>
        <tr>
            <td><?php echo $row["pro_ware_id"]; ?></td>
            <td><?php echo $row["pro_ware_content"]; ?></td>
            <td><?php echo $row["admin_name"]; ?></td>
            <td><?php echo $row["pro_ware_note"]; ?></td>
            <td><?php echo ($row["pro_ware_status"])?"Đã nhập kho":"Chưa xác nhận"; ?></td>
            <td><?php echo $row["date_created"]; ?></td>
            <td>
                <a href="index.php?page=ware_printing&id=<?php echo $row["pro_ware_id"]; ?>">
                <i class="fa fa-list"></i> Xem đơn hàng</a>
            </td>
            <td>
                <a href="index.php?page=edit_pro_ware&id=<?php echo $row["pro_ware_id"] ?>&edit=1"><i class="fa fa-pencil-square-o"></i> Sửa </a>
            </td>
            <td>
                <a href="index.php?page=list_pro_ware&id=<?php echo $row["pro_ware_id"] ?>&del=1" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm  này?')"><i class="fa fa-trash-o"></i> Xóa</a>
            </td>
            
        </tr>
        <?php } } ?>
        </div>
        </tbody>
    </table>
    </div>
</div>
</div>