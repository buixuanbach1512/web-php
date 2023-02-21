<div class="col-md-12 col-sm-12  ">
<div class="x_panel">
    <div class="x_title">
    <!-- <h2>Danh sách sản phẩm</h2> -->
    <h2><a>Danh sách xuất kho</a></h2>
    <div class="clearfix"></div>
   
</div>
     
    <div class="x_content">
    <?php
        //Kiểm tra id trên url trường hợp xóa
        if(isset($_GET["id"]) && isset($_GET["del"])){
            $sqlDelete = "DELETE FROM product_export WHERE pro_ex_id=".$_GET["id"];
            mysqli_query($conn,$sqlDelete) or die("Lỗi xóa bản ghi!!");
            header("location:index.php?page=list_pro_ex");
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
            <th>Ngày xuất</th>
            <th>Xem chi tiết</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $sqlSelectPro =" SELECT product_export.*,`admin`.admin_name FROM product_export INNER JOIN `admin` ON product_export.admin_id=`admin`.admin_id";
            $resultSelectPro = mysqli_query($conn, $sqlSelectPro) or die("Lỗi truy vấn select!!");
            if(mysqli_num_rows($resultSelectPro) > 0) {
                while($row = mysqli_fetch_assoc($resultSelectPro)) {
        ?>
        <tr>
            <td><?php echo $row["pro_ex_id"]; ?></td>
            <td><?php echo $row["pro_ex_content"]; ?></td>
            <td><?php echo $row["admin_name"]; ?></td>
            <td><?php echo $row["pro_ex_note"]; ?></td>
            <td><?php echo ($row["pro_ex_status"])?"Đã xuất kho":"Chưa xác nhận"; ?></td>
            <td><?php echo $row["date_created"]; ?></td>
            <td>
                <a href="index.php?page=export_printing&id=<?php echo $row["pro_ex_id"]; ?>">
                <i class="fa fa-list"></i> Xem đơn hàng</a>
            </td>
            <td>
                <a href="index.php?page=edit_pro_ex&id=<?php echo $row["pro_ex_id"] ?>&edit=1"><i class="fa fa-pencil-square-o"></i> Sửa </a>
            </td>
            <td>
                <a href="index.php?page=list_pro_ex&id=<?php echo $row["pro_ex_id"] ?>&del=1" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm  này?')"><i class="fa fa-trash-o"></i> Xóa</a>
            </td>
        </tr>
        <?php } } ?>
        </div>
        </tbody>
    </table>
    </div>
</div>
</div>