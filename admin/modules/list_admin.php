<div class="col-md-12 col-sm-12  ">
<div class="x_panel">
    <div class="x_title">
    <h2>Danh Sách Khách Hàng</h2>
    <div class="clearfix"></div>
    </div>
    <div class="x_content">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Mã nhân viên</th>
            <th>Họ tên</th>  
            <th>Tài khoản</th>
            <th>Số Điện Thoại</th>
            <th>Địa Chỉ</th>
            <th>Phân quyền</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $sqlSelectPro = " SELECT `admin`.*, position.pos_name FROM `admin` INNER JOIN position ON `admin`.pos_id = position.pos_id" ;
            $resultSelectPro = mysqli_query($conn, $sqlSelectPro) or die("Lỗi truy vấn select!!");
            if(mysqli_num_rows($resultSelectPro) > 0) {
                $i = 0;
                while($row = mysqli_fetch_assoc($resultSelectPro)) {
                    $i++;
        ?>
        <tr>
            <td><?php echo $row["admin_id"]; ?></td>
            <td><?php echo $row["admin_name"]; ?></td>
            <td><?php echo $row["admin_username"]; ?></td>
            <td><?php echo $row["admin_phone"]; ?></td>
            <td><?php echo $row["admin_address"]; ?></td>
            <td><?php echo $row["pos_name"]; ?></td>
            <td>
            <a href="index.php?page=edit_admin&id=<?php echo $row["admin_id"]; ?>&edit=1">
                <i class="fa fa-pencil-square-o"></i> Sửa</a>
            </td>
            <td>
            <a href="index.php?page=list_admin&id=<?php echo $row["admin_id"]; ?>&del=1" onclick="return confirm('Bạn có chắc muốn xóa danh mục này?')"><i class="fa fa-trash-o"></i> Xóa</a>
            </td>
        </tr>
        <?php } } ?>
        </div>
        </tbody>
    </table>
    </div>
</div>
</div>